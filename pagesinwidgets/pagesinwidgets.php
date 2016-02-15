<?php
/*
Plugin Name: Pages In Widgets
Plugin URI:  https://jaydenmajor.com/plugins
Description: Pages In Widgets is a simple plugin that allows you to insert a the content of a page/post created in the normal WordPress pages interface into a widget. Allowing for a faster and easier websit for both the devloper and the other publishers.
Version:     1.7
Author:      Jayden Major
Author URI:  https://jaydenmajor.com/
Tags:        Jayden major, widgets, custom home page, pages on widgets, page, page editor, one page section, page in widget section, post in widget, posts on widgets, website sections, post, post editor, post in widget section
Text Domain: pages-in-widgets
Licence:     GNU General Public License (GPL) version 3 (#GPLv3)
Licence URI: http://www.gnu.org/licenses/gpl.html
Donate link: https://jaydenmajor.com/donate
*/


/*
 * Security check
 * Prevent direct access to the file.
 *
 * @since 1.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Plugin textdomain
 * Load plugin textdomain.
 *
 * @since 1.5
 */
function pagesinwidgets_load_textdomain() {
	load_plugin_textdomain( 'pages-in-widgets' );
}
add_action( 'plugins_loaded', 'pagesinwidgets_load_textdomain' );


/*
 * Register Sidebar Widget
 *
 */
add_action( 'widgets_init', 'pagesinwidgets' );

function pagesinwidgets() {
	register_widget( 'pagesinwidgets_page_section' );
	register_widget( 'pagesinwidgets_post_section' );
}

/*
*  Pages In Widget - Widget
*/
class pagesinwidgets_page_section extends WP_Widget {

	function __construct(){

		parent::__construct('pagesinwidgets_page_section',__( 'Pages In Widgets', 'pages-in-widgets' ),
			array(
				'description' => __( 'A general layout for page sections.', 'pages-in-widgets' ),
				'classname'   => 'pagesinwidgets_page_section'
			)
		);

	}

	function form($instance){
		pagesinwidgets_widgetform($instance);
	}

	function update($new_instance, $old_instance){
   		$instance = $old_instance;
   		$instance['title'] = $new_instance['title'];
    	$instance['pageID'] = $new_instance['pageID'];
		$instance['titleEnable'] = $new_instance['titleEnable'];
		$instance['customCssClass'] = $new_instance['customCssClass'];
		$instance['outputtype'] = $new_instance['outputtype'];
    	return $instance;
    }

	function widget($args, $instance){
		pagesinwidgets_widgetoutput($args, $instance);
	}

}
/*
*  Posts In Widget - Widget
*/
class pagesinwidgets_post_section extends WP_Widget {
	function __construct(){

		parent::__construct('pagesinwidgets_post_section',__( 'Posts In Widgets', 'pages-in-widgets' ),
			array(
				'description' => __( 'A general layout for posts sections.', 'pages-in-widgets' ),
				'classname'   => 'pagesinwidgets_post_section'
			)
		);

	}
	function form($instance){
		pagesinwidgets_widgetform($instance);
	}

	function update($new_instance, $old_instance){
   		$instance = $old_instance;
   		$instance['title'] = $new_instance['title'];
    	$instance['pageID'] = $new_instance['pageID'];
		$instance['titleEnable'] = $new_instance['titleEnable'];
		$instance['customCssClass'] = $new_instance['customCssClass'];
		$instance['outputtype'] = $new_instance['outputtype'];
    	return $instance;
    }

	function widget($args, $instance){
		pagesinwidgets_widgetoutput($args, $instance);
	}
}

/*
* Common Functions For Both Pages And Post Widgets.
*/
function pagesinwidgets_widgetoutput($args, $instance){
	extract($args, EXTR_SKIP);
	$title = $instance['title'];
	$pageID = $instance['pageID'];
	$titleEnable = $instance['titleEnable'];
	$customCssClass = $instance['customCssClass'];
	$outputType = $instance['outputtype'];
   	echo $before_widget;
	global $wpdb;
	$page = $wpdb->get_results("SELECT * FROM `". $wpdb->prefix ."posts` WHERE `ID` = ".$pageID.';',ARRAY_A);
	$page = $page[0];
	if($titleEnable == 'true'){ ?>
	<h4 class="widget-title widgettitle"><?php if(!empty($title)){echo $title;}else{echo $page['post_title'];} ?></h4>
	<?php } ?>
	<div class="<?php echo (($customCssClass)?$customCssClass:'homepage_section'); ?>">
		<?php 
		if($outputType == 'plaintext'){
			echo strip_tags($page['post_content']);
		}
		else if($outputType == 'forceptags'){
			$content = $page['post_content'];
			$rsp = array("\r\n&nbsp;\r\n","\n&nbsp;\n","\r&nbsp;\r");
			$content = str_replace($rsp,"</p><p>",$content);
			$rsp2 = array("\r\n\r\n&nbsp;\r\n\r\n","\r\r&nbsp;\r\r","\n\n&nbsp;\n\n");
			$content = str_replace($rsp,"</p><br/><p>",$content);
			echo do_shortcode(apply_filters('the_content',"<p>"+$content+"</p>"));
		}
		else{
			echo do_shortcode(apply_filters('the_content',$page['post_content']));
		}
		?>
	</div>
	<?php
   	echo $after_widget;
}

function pagesinwidgets_widgetform($instance,$type = "page"){
	$currentInstance = $instance;
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'pageID' => '','titleEnable' => 'true') );
		if(isset($currentInstance['title']) == false){
			$currentInstance['title'] = "";
		}
		if(isset($currentInstance['pageID']) == false){
			$currentInstance['pageID'] = 1;
		}
		if(isset($currentInstance['titleEnable']) == false){
			$currentInstance['titleEnable'] = 'true';
		}
		if(isset($currentInstance['customCssClass']) == false){
			$currentInstance['customCssClass'] = '';
		}
		if(isset($currentInstance['outputtype']) == false){
			$currentInstance['outputtype'] = "normal";
		}
		?>
		<p style="font-style: italic;"><small><?php _e( 'Select the page here and then edit the page under the pages tab on the left.', 'pages-in-widgets' ); ?></small></p>
		<p><label for="<?php echo $this->get_field_id('pageID'); ?>"><span style="float:left; width:100%;"><?php if($type == 'post'){_e( 'Post:', 'pages-in-widgets' );}else{_e('Page:','pages-in-widgets');} ?></span>
		<select class="large-text" style="width:100%;" id="<?php echo $this->get_field_id('pageID'); ?>" name="<?php echo $this->get_field_name('pageID'); ?>">
			<?php
				global $wpdb;
				$pageList = $wpdb->get_results("SELECT * FROM `". $wpdb->prefix ."posts` WHERE `post_status` = 'publish' AND `post_type` = 'post'");
				foreach($pageList as $page){
					global $instance,$currentID;
					?>
					<option value="<?php echo $page->ID; ?>" <?php if($page->ID == intval($currentInstance['pageID']) && $currentInstance['pageID'] != null){echo 'selected="selected"';} ?>><?php echo $page->post_title; ?></option>
					<?php
				}
			?>
		</select>
		</label></p>
		<p><label for="<?php echo $this->get_field_id('title');?>"><?phpif($type == 'post'){_e( 'Custom Post Title:', 'pages-in-widgets' );}else{_e( 'Custom Page Title:', 'pages-in-widgets' );} ?><input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $currentInstance['title']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('titleEnable'); ?>-yes"><span style="width:100%; float:left;"><?php if($type == 'post'){_e( 'Show Post Title:', 'pages-in-widgets' );}else{_e( 'Show Page Title:', 'pages-in-widgets' );} ?></span></label>
		<label for="<?php echo $this->get_field_id('titleEnable'); ?>-yes"><?php _e( 'Yes:', 'pages-in-widgets' ); ?> <input type="radio" value="true" name="<?php echo $this->get_field_name('titleEnable'); ?>" id="<?php echo $this->get_field_id('titleEnable'); ?>-yes" <?php if($currentInstance['titleEnable'] == 'true'){echo 'checked="checked"';} ?>/></label>
		<label for="<?php echo $this->get_field_id('titleEnable'); ?>-no"><?php _e( 'No:', 'pages-in-widgets' ); ?> <input type="radio" value="false" name="<?php echo $this->get_field_name('titleEnable'); ?>" id="<?php echo $this->get_field_id('titleEnable'); ?>-no" <?php if($currentInstance['titleEnable'] == 'false'){echo 'checked="checked"';} ?>/></label></p>
		
		<p>	<label for="<?php echo $this->get_field_id('customCssClass'); ?>"><?php _e( 'CSS Class:', 'pages-in-widgets' ); ?></label><br/>
        <input class="large-text" id="<?php echo $this->get_field_id('customCssClass'); ?>" name="<?php echo $this->get_field_name('customCssClass'); ?>" value="<?php echo $currentInstance['customCssClass']; ?>">
        </p>

        <p><label for="<?php echo $this->get_field_id('outputtype'); ?>"><?php _e( 'Output Type:', 'pages-in-widgets' ); ?></label><br/>
        	<select class="large-text" style="width:100%;" id="<?php echo $this->get_field_id('outputtype'); ?>" name="<?php echo $this->get_field_name('outputtype'); ?>">
        		<option value="normal" <?php if($currentInstance['outputtype'] == "normal"){echo 'selected=""';}?>><?php _e('Normal', 'pages-in-widgets' ); ?></option>
        		<option value="plaintext" <?php if($currentInstance['outputtype'] == "plaintext"){echo 'selected=""';}?>><?php _e('Plain Text', 'pages-in-widgets' ); ?></option>
        		<option value="forceptag" <?php if($currentInstance['outputtype'] == "forceptag"){echo 'selected=""';}?>><?php _e('Force P Tags', 'pages-in-widgets' ); ?></option>
        	</select>
        </p>
        <br/>
		<?php
}
