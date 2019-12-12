<?php
/* INIT */
/*
 * Security check
 * Prevent direct access to the file.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Plugin textdomain
 * Load plugin textdomain.
 */
function pagesinwidgets_load_textdomain() {
	load_plugin_textdomain( 'pages-in-widgets' );
}
add_action( 'plugins_loaded', 'pagesinwidgets_load_textdomain' );
