<!DOCTYPE html>
<!--
  the:blog
  Basic page to display a single blog post. Amend as required.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>the:blog : show post</title>
<link href="blog.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="wrapper">
  <h2>Show Post</h2>
  <?php
  include 'blogpost.inc.php';
  ?>
  <p><a href=".">Blog home page</a></p>
</div>
</body>
</html>
