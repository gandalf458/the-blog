<!DOCTYPE html>
<!--
  the:blog
  Admin: list all images.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>list images | the:blog</title>
<link href="styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>
  <h1>the:blog Admin</h1>
  <h2>List Images</h2>
  <?php
  $i    = 0;
  $dir  = '../images';
  if ( is_dir($dir) ) {
    $imgs = scandir($dir);
    foreach ( $imgs as $img ) {
      if ( $img !== '.' && $img !== '..' ) {
        echo '  <p class="imgList"><img src="../images/', $img,'" width="120"> ', $img, ' - to use this image in a post, copy the following and insert it into your post, changing "alt text" as required:<br><strong>![alt text](images/', $img, ')</strong></p>', PHP_EOL;
        $i++;
      }
    }
  }
  if ( $i > 0 )
    echo '<p class="imgList">Total ', $i, ' images.', PHP_EOL;
  else
    echo '<p class="imgList">No images.', PHP_EOL;
  include 'footer.inc.php'
  ?>
</main>
</body>
</html>
