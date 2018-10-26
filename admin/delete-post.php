<!DOCTYPE html>
<!--
  the:blog
  Admin: Delete a blog post.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>delete post | the:blog</title>
<link href="styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>
  <h1>the:blog Admin</h1>
  <h2>Delete Post</h2>
  <?php
  $dir = '../posts';
  if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) :
    $file = $dir.'/'.$_POST['file'];
    $deldir = '../deleted';
    if ( !is_dir($deldir) )
      mkdir($deldir, 0755);    // create directory if it doesn't exist
    $delfile = str_replace($dir, $deldir, $file);
    rename($file, $delfile);   // save the file just in case
    unlink($file);
    echo '<p>Your post has been deleted.</p>', PHP_EOL;
  else :
    $file = $dir.'/'.$_GET['post'];
    $news = file_get_contents($file);
  ?>
  <p>Are you sure you wish to delete this post? <strong>This action cannot be undone!</strong></p>
  <form id="form1" name="form1" method="post">
    <input type="hidden" name="file" value="<?php echo $file; ?>">
    <input type="submit" name="submit" value="Delete">
  </form>
  <?php
  endif;
  include 'footer.inc.php'
  ?>
</main>
</body>
</html>
