<?php
/*
 * the:blog
 *
 * Script to display a single blog post.
 * This script can be included without modification in all blogs.
 *
 * If the script is changed then the name should also be changed
 * otherwise it will be overwritten when a new version is released.
 *
 * Revision 0.1
 * Copyright, Graham R Irwin, 2018
 */
$doc = isset($_GET['doc']) ? $_GET['doc'] : '';
$doc = preg_replace("/[^a-z0-9_\- ]/", '', $doc);
$doc .= '.md';
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
