<!DOCTYPE html>
<!--
  the:blog
  Admin: Upload an image.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>upload image | the:blog</title>
<link href="styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>
  <h1>the:blog Admin</h1>
  <h2>Upload Image</h2>
  <?php
  function return_bytes($size_str) {
    switch ( substr($size_str, -1) ) {
      case 'M': case 'm': return (int)$size_str * 1048576;
      case 'K': case 'k': return (int)$size_str * 1024;
      case 'G': case 'g': return (int)$size_str * 1073741824;
      default: return $size_str;
    }
  }

  $maxbytes = return_bytes(ini_get('upload_max_filesize'));

  if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $filetype = $_FILES['uppfile']['type'];
    $filename = $_FILES['uppfile']['name'];
    $filename = stripslashes($filename);
    $filesize = $_FILES['uppfile']['size'];

    // check image type
    $allowed = array('jpeg', 'jpg', 'png');
    $extn = pathinfo($filename, PATHINFO_EXTENSION);
    $extn = strtolower($extn);
    if ( !in_array($extn, $allowed) ) {
      echo '<p class="error">File ', $filename, ' is not of the correct type.</p>';
      die();
    }

    if ( $filename !== '' ) {
      $destdir  = '../images';
      if ( !is_dir($destdir) )
        mkdir($destdir, 0755);  // create directory if it doesn't exist
      $tempdir  = '../temp';
      if ( !is_dir($tempdir) )
        mkdir($tempdir, 0755);  // create directory if it doesn't exist
      $image    = time()-1520323720;
      $newfile  = (string)$image.'.'.$extn;
      $destpath = $destdir.'/'.$newfile;
      $tempfile = $tempdir.'/'.$image;
      $tmp_name = $_FILES['uppfile']['tmp_name'];
      $size     = getimagesize($tmp_name);
      $width    = 360;          // this probably needs to be a constant!
      $height   = $size[1] / $size[0] * $width;
      $height   = (int)($height + .5);
      if ( $size[0] < $width )
        echo '<p class="error">Image ', $filename, ' is too small but will be resized and uploaded anyway.</p>', PHP_EOL;

      // image is the right size, just save it
      if ( $size[0] === $width ) {
        if ( is_uploaded_file($tmp_name) && move_uploaded_file($tmp_name, $destpath) ) {
          echo '<p>File <strong>', $filename, '</strong> has been uploaded successfully as <strong>', $newfile, '</strong>.</p>', PHP_EOL;
          echo '<p>To include this image in a post, copy the following and insert it in your post changing "alt text" as required:</p>', PHP_EOL;
          echo '<strong>![alt text](images/', $newfile, ')</strong></p>', PHP_EOL;
        } else {
          echo '<p class="error">Image ', $filename, ' could not be uploaded.</p>', PHP_EOL;
        }
      // image is not the right size, save it to a temporary area and then resize it
      } else {
        $oldWidth  = $size[0];
        $oldHeight = $size[1];
        if ( !(is_uploaded_file($tmp_name) && move_uploaded_file($tmp_name, $tempfile)) ) {
          echo '<p class="error">Image ', $filename, ' could not be uploaded.</p>', PHP_EOL;
        } else {
          // jpeg
          if ( $extn == 'jpg' or $extn == 'jpeg' ) {
            $srcfile = imagecreatefromjpeg($tempfile);
            // rotate image if necessary
            $exif = exif_read_data($tempfile);
            if ( isset($exif['Orientation']) ) {
              switch ( $exif['Orientation'] ) {
                case 3:
                  $srcfile = imagerotate($srcfile, 180, 0);
                  break;
                case 6:
                  $srcfile = imagerotate($srcfile, -90, 0);
#                  list($height, $width) = array($width, $height);
                  $wsave  = $width;
                  $height = $wsave / $height * $wsave;
                  $width  = $wsave;
                  list($oldHeight, $oldWidth) = array($oldWidth, $oldHeight);
                  break;
                case 8:
                  $srcfile = imagerotate($srcfile, 90, 0);
#                  list($height, $width) = array($width, $height);
                  $wsave  = $width;
                  $height = $wsave / $height * $wsave;
                  $width  = $wsave;
                  list($oldHeight, $oldWidth) = array($oldWidth, $oldHeight);
                  break;
              }
            }
            $resized = imagecreatetruecolor($width, $height);
            imagecopyresampled($resized, $srcfile, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);
            imagejpeg($resized, $destpath); // default quality
          // png
          } elseif ( $extn == 'png' ) {
            $srcfile = imagecreatefrompng($tempfile);
            $resized = imagecreatetruecolor($width, $height);
            imagecopyresampled($resized, $srcfile, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);
            imagepng($resized, $destpath, 7);
          }
          imagedestroy($resized);
          imagedestroy($srcfile);
          unlink($tempfile);
          echo '<p>File <strong>', $filename, '</strong> has been uploaded successfully as <strong>', $newfile, '</strong>.</p>', PHP_EOL;
          echo '<p>To include this image in a post, copy the following and insert it in your post, changing "alt text" as required:</p>', PHP_EOL;
          echo '<strong>![alt text](images/', $newfile, ')</strong></p>', PHP_EOL;
        }
      }
    }

  } else {

  ?>
  <p>Select a jpeg or png file to upload. Images may be portrait or landscape and must be wider than 360px otherwise they will appear pixilated when displayed; they are resized to 360px when uploaded. The maximum size file you may upload is <?php echo number_format($maxbytes); ?> bytes.</p>
  <form id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="field">
      <label for="uppfile">File to upload:</label>
      <input type="file" name="uppfile" id="uppfile" required accept="image/jpeg,image/png">
    </div>
    <input type="submit" name="gandalf" value="Upload">
  </form>
  <?php
  }
  include 'footer.inc.php'
  ?>
</main>
</body>
</html>
