<!DOCTYPE html>
<!--
  the:blog
  Basic blog home page. Amend as required.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>the:blog</title>
<link href="blog.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="wrapper">
  <h2>Recent Posts</h2>
  <?php
  define('PPP', 5);  // number of posts per page; change as required
  include 'blog.inc.php';
  ?>
</div>
</body>
</html>
