<?php
/*
 * the:blog
 *
 * Script to list the titles of recent blog posts.
 * It needs PPP to be defined before being included.
 * This script can be included without modification in all blogs.
 *
 * If the script is changed then the name should also be changed
 * otherwise it will be overwritten when a new version is released.
 *
 * Revision 0.1
 * Copyright, Graham R Irwin
 * For full information, see the license.txt file that was distributed
 * with this software.
 */
$n = isset($_GET['n']) ? (int)$_GET['n'] : 0;  // start post #
$dir  = 'posts';
$docs = scandir($dir, SCANDIR_SORT_DESCENDING);
$pno  = 0;                 // current post #
$ppp  = SPP;               // items per page
// count number of posts
$nnn = 0;
foreach ( $docs as $doc ) {
  $pathinfo = pathinfo($doc);
  if ( $pathinfo['extension'] === 'md' )
    $nnn++;
}
echo '<ul class="postlist">', PHP_EOL;
foreach ( $docs as $doc ) {
  if ( $pno-$n > $ppp )
    break;
  $pathinfo = pathinfo($doc);
  if ( $pathinfo['extension'] === 'md' ) {
    if ( $pno >= $n && $pno-$n <= $ppp-1 ) {
      $fh   = fopen($dir.'/'.$doc, 'r');
      $line = fgets($fh);
      $line = str_replace('###', '', $line);
      $line = trim($line);
      fclose($fh);
      // Comment out ONE of the two following echo statements; if you use the second you 
      // will need a rewrite rule in your .htaccess file along the lines of 
      // RewriteRule ^blog/showpost-([0-9-]+)? blog/showpost.php?doc=$1 [PT,L]
      #echo '  <li><a href="showpost.php?doc=', $pathinfo['filename'], '">', $line, '</a></li>', PHP_EOL;
      echo '  <li><a href="showpost-', $pathinfo['filename'], '">', $line, '</a></li>', PHP_EOL;
    }
    $pno++;
  }
}
echo '</ul>', PHP_EOL;
