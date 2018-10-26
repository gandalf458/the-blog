<!DOCTYPE html>
<!--
  the:blog
  Admin: Page to preview a post.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>post preview | the:blog</title>
<link href="blog.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="wrapper">
  <h2>Post Preview</h2>
  <?php
  $doc = isset($_GET['doc']) ? $_GET['doc'] : 0;  // post #
  require 'Parsedown.php';
  $dir  = 'posts';
  $pathinfo = pathinfo($doc);
  echo '<div class="post">', PHP_EOL;
  $file = $dir.'/'.$doc;
  if ( !file_exists($file) ) die();
  $text = file_get_contents($file);
  $Parsedown = new Parsedown();
  echo $Parsedown->text($text);
  echo PHP_EOL;
  $date = explode('-', $pathinfo['filename']);
  echo '  <p class="pdate">Posted on ', $date[2], '-', $date[1], '-', $date[0], ' at ', $date[3], ':', $date[4], '</p>', PHP_EOL;
  echo '</div>', PHP_EOL;
  ?>
</div>
</body>
</html>
