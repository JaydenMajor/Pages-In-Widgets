<?php
/*
Plugin Name: Pages In Widgets
Plugin URI:  https://jaydenmajor.com
Description: This plugin inserts the content of a page or post into a widget.
Version:     1.9.4
Author:      Jayden Major
Author URI:  https://jaydenmajor.com/
Tags:        Jayden major, widgets, custom home page, pages on widgets, page, page editor, one page section, page in widget section
Text Domain: pages-in-widgets
Licence:     GNU General Public License (GPL) version 3 (#GPLv3)
Licence URI: http://www.gnu.org/licenses/gpl.html
*/

$dir = plugin_dir_path( __DIR__ );
include('general/init.php');
include('widgets/pages-widget.php');
include('widgets/posts-widget.php');
