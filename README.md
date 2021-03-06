# the:blog

**the:blog** is a simple, lightweight, easy to use blogging platform. It can easily be integrated into an existing website, giving the blog the same look and feel as the rest of the site. No database is required as posts are stored as MarkDown documents.

**the:blog** comprises:

* admin routines in the admin sub-directory
* various scripts and include files in the main directory as follows:

    - blog.inc.php - displays the most recent blog posts in full
    - bloglist.inc.php - lists the titles of the most recent blog posts
    - blogpost.inc.php - to display a single post
    - preview.php - used by the admin routines to preview a post
    - README.md - this file

    None of the above files should be changed as they will be overwritten by a new version of **the:blog**. If changes are required then the files should be renamed and/or relocated.

    Also included are:

    - index.php - blog home page; simply displays blog posts as required
    - blog.css - basic CSS
    - listposts.php - example page to list blogs
    - showpost.php - example page to display a single post

    When updating, these routines should NOT be replaced with the new version in case any changes have been made. The version of Parsedown should be updated from time to time as necessary.

    A copy of Parsedown.php is also required; this is not included in the package - see http://parsedown.org/ for details and to download.

The admin routines should not be changed and will be replaced with any new release.

An `.htaccess` and `.htpasswd` file will be needed to protect the admin directory.

Documentation is given at http://gandalf458.co.uk/theblog/

The scripts are being released despite being a bit rough round the edges. Contributions from other developers would be welcome.

_Last updated: 2018-10-19._
