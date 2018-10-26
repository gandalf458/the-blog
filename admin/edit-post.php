<!DOCTYPE html>
<!--
  the:blog
  Admin: Edit a blog post.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>edit post | the:blog</title>
<link href="styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>
  <h1>the:blog Admin</h1>
  <h2>Edit Post</h2>
  <?php
  $dir = '../posts';
  if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) :
    $extn = $_POST['submit'] === 'Publish' ? '.md' : '.mdx';
    $file = '../posts/'.date('Y-m-d-H-i', time()).$extn;
    unlink($dir.'/'.$_POST['file']);
    if ( !isset($_POST['updatedate']) )
      $file = $_POST['file'];
    $message = $_POST['message'];
    file_put_contents($file, $message);
    echo '<p>Your post/draft has been updated.</p>', PHP_EOL;
  else :
    $file = $dir.'/'.$_GET['post'];
    $news = file_get_contents($file);
  ?>
  <p>To edit the post simply amend the text in the box below. You may publish the post or save it as a draft.</p>
  <form id="form1" name="form1" method="post">
    <div class="field">
      <textarea name="message" id="message" cols="100" rows="25" autofocus><?php echo $news; ?></textarea>
    </div>
    <div class="field">
      <label for="updatedate">Update post date</label>
        <input type="checkbox" id="updatedate" name="updatedate">
    </div>
    <input type="hidden" name="file" value="<?php echo $file; ?>">
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
