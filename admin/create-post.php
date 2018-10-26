<!DOCTYPE html>
<!--
  the:blog
  Admin: Create a blog post.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>create post | the:blog</title>
<link href="styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>
  <h1>the:blog Admin</h1>
  <h2>Create Post</h2>
  <?php
  if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) :
    $extn = $_POST['submit'] === 'Publish' ? '.md' : '.mdx';
    $file = '../posts/'.date('Y-m-d-H-i', time()).$extn;
    $message = $_POST['message'];
    file_put_contents($file, $message);
    echo '<p>Your post has been ';
    if ( $_POST['submit'] === 'Publish' )
      echo 'published';
    else
      echo 'saved as draft';
    echo '.</p>', PHP_EOL;
  else :
  ?>
  <p>To create a post simply type into the box below. You may publish the post or save it as a draft for further work. To include an image in a post, you’ll need to <a href="upload-image.php" target="_blank">upload</a> it first (this link opens in a new tab).</p>
  <form id="form1" name="form1" method="post">
    <div class="field">
      <textarea name="message" id="message" cols="100" rows="25" autofocus></textarea>
    </div>
    <input type="submit" name="submit" value="Publish">
    <input type="submit" name="submit" value="Save draft">
  </form>
  <?php
  endif;
  include 'footer.inc.php'
  ?>
</main>
</body>
</html>
