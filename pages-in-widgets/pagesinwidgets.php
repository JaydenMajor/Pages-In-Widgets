<?php
/*
Plugin Name: Pages In Widgets
Plugin URI:  https://jaydenmajor.com/plugins
Description: This plugin inserts the content of a page or post into a widget.
Version:     1.7
Author:      Jayden Major
Author URI:  https://jaydenmajor.com/
Tags:        Jayden major, widgets, custom home page, pages on widgets, page, page editor, one page section, page in widget section
Text Domain: pages-in-widgets
Licence:     GNU General Public License (GPL) version 3 (#GPLv3)
Licence URI: http://www.gnu.org/licenses/gpl.html
*/

define('pagesinwidgets_PATH', plugin_dir_path( __FILE__ ));
define('pagesinwidgets_URL',plugin_dir_url( __FILE__ ));
define('pagesinwidgets_FILE',__FILE__);
require pagesinwidgets_PATH.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.'init.php';
require pagesinwidgets_PATH.DIRECTORY_SEPARATOR.'widgets'.DIRECTORY_SEPARATOR.'pages-widget.php';
require pagesinwidgets_PATH.DIRECTORY_SEPARATOR.'widgets'.DIRECTORY_SEPARATOR.'posts-widget.php';