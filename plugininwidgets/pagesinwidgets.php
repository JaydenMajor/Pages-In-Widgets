<?php
/*
Plugin Name: Pages In Widgets
Plugin URI:  https://jaydenmajor.com/plugins
Description: This plugin inserts the content of a page into a widget.
Version:     1.3
Author:      Jayden Major
Author URI:  https://jaydenmajor.com/
Tags:        Jayden major, widgets, custom home page, pages on widgets, page, page editor
Text Domain: pagesinwidgets
Licence:     GNU General Public License (GPL) version 2 (#GPLv2)
Licence URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/



/*
 * Prevent direct access to the file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/*
 * Register Sidebar Widget
 */
add_action( 'widgets_init', 'pagesinwidgets' );
function pagesinwidgets() {
	register_widget( 'pagesinwidgets_page_section' );
}

class pagesinwidgets_page_section extends WP_Widget {

	function __construct(){

		parent::__construct(
			'pagesinwidgets_page_section',
			__( 'Pages In Widgets', 'pagesinwidgets' ),
			array(
				'description' => __( 'A general layout for page sections.', 'pagesinwidgets' ),
				'classname'   => 'pagesinwidgets_page_section'
			)
		);

	}

	function form($instance){
		$currentInstance = $instance;
		$instance = wp_parse_args( (array) $instance, array('pageID' => '','titleEnable' => 'true') );
		?>
		<p style="font-style: italic;"><small><?php _e( 'Select the page here and then edit the page under the pages tab on the left.', 'pagesinwidgets' ); ?></small></p>
		<p><label for="<?php echo $this->get_field_id('pageID'); ?>"><span style="float:left; width:100%;"><?php _e( 'Page:', 'pagesinwidgets' ); ?></span>
		<select id="<?php echo $this->get_field_id('pageID'); ?>" name="<?php echo $this->get_field_name('pageID'); ?>">
			<?php
				global $wpdb;
				$pageList = $wpdb->get_results("SELECT * FROM `". $wpdb->prefix ."posts` WHERE `post_status` = 'publish' AND `post_type` = 'page'");
				foreach($pageList as $page){
					global $instance,$currentID;
					?>
					<option value="<?php echo $page->ID; ?>" <?php if($page->ID == intval($currentInstance['pageID']) && $currentInstance['pageID'] != null){echo 'selected="selected"';} ?>><?php echo $page->post_title; ?></option>
					<?php
				}
			?>
		</select>
		</label></p>	
		<p><label for="<?php echo $this->get_field_id('titleEnable'); ?>-yes"><span style="width:100%; float:left;"><?php _e( 'Show Page Title:', 'pagesinwidgets' ); ?></span></label>
		
		<label for="<?php echo $this->get_field_id('titleEnable'); ?>-yes"><?php _e( 'Yes:', 'pagesinwidgets' ); ?> <input type="radio" value="true" name="<?php echo $this->get_field_name('titleEnable'); ?>" id="<?php echo $this->get_field_id('titleEnable'); ?>-yes" <?php if($currentInstance['titleEnable'] == 'true'){echo 'checked="checked"';} ?>/></label>
		<label for="<?php echo $this->get_field_id('titleEnable'); ?>-no"><?php _e( 'No:', 'pagesinwidgets' ); ?> <input type="radio" value="false" name="<?php echo $this->get_field_name('titleEnable'); ?>" id="<?php echo $this->get_field_id('titleEnable'); ?>-no" <?php if($currentInstance['titleEnable'] == 'false'){echo 'checked="checked"';} ?>/></label></p>
		
		
		<?php
	}

	function update($new_instance, $old_instance){
   		$instance = $old_instance;
    	$instance['pageID'] = $new_instance['pageID'];
		$instance['titleEnable'] = $new_instance['titleEnable'];
    	return $instance;
    }

	function widget($args, $instance){
		extract($args, EXTR_SKIP);
		$pageID = $instance['pageID'];
		$titleEnable = $instance['titleEnable'];
    	echo $before_widget;
		global $wpdb;
		$page = $wpdb->get_results("SELECT * FROM `". $wpdb->prefix ."posts` WHERE `ID` = ".$pageID.';',ARRAY_A);
		$page = $page[0];
		if($instance['titleEnable'] == 'true'){ ?>
		<h4 class="widget-title widgettitle"><?php echo $page['post_title']; ?></h4>
		<?php } ?>
		<div class="homepage_section"><?php echo do_shortcode($page['post_content']); ?></div>
		<?php
   		echo $after_widget;
	}

}
?>
