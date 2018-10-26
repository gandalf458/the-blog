<?php
/*
 * the:blog
 *
 * Script to display all blog posts, latest first and paginated.
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
require 'Parsedown.php';
$dir  = 'posts';
$docs = scandir($dir, SCANDIR_SORT_DESCENDING);
$pno  = 0;                 // current post #
$ppp  = PPP;               // posts per page
// count number of posts
$nnn = 0;
foreach ( $docs as $doc ) {
  $pathinfo = pathinfo($doc);
  if ( $pathinfo['extension'] === 'md' )
    $nnn++;
}
foreach ( $docs as $doc ) {
  if ( $pno-$n > $ppp )
    break;
  $pathinfo = pathinfo($doc);
  if ( $pathinfo['extension'] === 'md' ) {
    if ( $pno >= $n && $pno-$n <= $ppp-1 ) {
      echo '<div class="post">', PHP_EOL;
      $text = file_get_contents($dir.'/'.$doc);
      $Parsedown = new Parsedown();
      echo $Parsedown->text($text);
      echo PHP_EOL;
      $date = explode('-', $pathinfo['filename']);
      echo '  <p class="pdate">Posted on ', $date[2], '-', $date[1], '-', $date[0], ' at ', $date[3], ':', $date[4], '</p>', PHP_EOL;
      echo '</div>', PHP_EOL;
    }
    $pno++;
  }
}
if ( $n > 0 || $n+$ppp < $nnn )
  echo '<p>';
if ( $n > 0 )
  echo '<a href=".">Blog home page</a>';
if ( $n > 0 && $n+$ppp < $nnn )
  echo ' | ';
if ( $n+$ppp < $nnn )
  echo '<a href="?n=', $n+$ppp,'">Earlier posts</a>';
if ( $n > 0 || $n+$ppp < $nnn )
  echo '</p>', PHP_EOL;
