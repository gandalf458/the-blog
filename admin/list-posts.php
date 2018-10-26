<!DOCTYPE html>
<!--
  the:blog
  Admin: list all posts.

  Revision 0.1
  Copyright, Graham R Irwin
  For full information, see the license.txt file that was distributed
  with this software.
-->
<html>
<head>
<meta charset="utf-8">
<title>list posts | the:blog</title>
<link href="styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>
  <h1>the:blog Admin</h1>
  <h2>List Posts</h2>
  <p>From this list, you may select a post to preview, edit or delete. Note that preview opens in a new tab and is only a partial preview (it is not completely formatted as per the:blog page). With edit post you can change the draft/published status of a post. When a post is edited, the date published is automatically updated.</p>
  <?php
  $dir  = '../posts';
  $docs = scandir($dir, SCANDIR_SORT_DESCENDING);
  $i    = 0;
  foreach ( $docs as $doc ) {
    if ( $doc !== '.' && $doc !== '..' ) {
      $fh   = fopen($dir.'/'.$doc, 'r');
      $line = fgets($fh);
      $line = str_replace('###', '', $line);
      $line = trim($line);
      fclose($fh);
      $info = pathinfo($doc);
      $extn = $info['extension'];
      $file = $info['filename'];
      echo '  <p>', $line;
      if ( $extn === 'mdx' )
        echo ' - DRAFT';
      echo '<br>', $file, ' - <a href="../preview.php?doc=',$doc,'" target="_blank">preview</a> / <a href="edit-post.php?post=', $doc, '">edit</a> / <a href="delete-post.php?post=', $doc, '">delete</a></p>', PHP_EOL;
      $i++;
    }
  }
  echo '<p>Total ', $i, ' posts.', PHP_EOL;
  include 'footer.inc.php'
  ?>
</main>
</body>
</html>
