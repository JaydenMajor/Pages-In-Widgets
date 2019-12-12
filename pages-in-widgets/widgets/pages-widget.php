<?php
/* Pages Widget */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'widgets_init', 'pagesinwidgets_pages' );
function pagesinwidgets_pages() {
	register_widget( 'pagesinwidgets_page_section' );
}

class pagesinwidgets_page_section extends WP_Widget {

	function __construct(){
		parent::__construct(
		'pagesinwidgets_page_section',
		__( 'Pages In Widgets', 'pages-in-widgets' ),
			array(
				'description' => __( 'A general layout for page sections.', 'pages-in-widgets' ),
				'classname'   => 'pagesinwidgets_page_section'
			)
		);
	}
/*
* Output Type Selection
*/
	function form($instance){
		$currentInstance = $instance;
		$instance = wp_parse_args( (array) $instance, array('pageID' => '','titleEnable' => 'true') );
		if(isset($currentInstance['title']) == false){
			$currentInstance['title'] = "New Page";
		}
		$title = $currentInstance['title'];
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
		if(isset($currentInstance['outputcontent']) == false){
			$currentInstance['outputcontent'] = "content";
		}
		if(isset($currentInstance['imageposition']) == false){
			$currentInstance['imageposition'] = 'none';
		}
		if(isset($currentInstance['imagesize']) == false){
			$currentInstance['imagesize'] = 'thumbnail';
		}
		if(isset($currentInstance['titletype']) == false){
			$currentInstance['titletype'] = "h2";
		}
		?>
		<p style="font-style: italic;"><small><?php _e( 'Select the page here and then edit the page under the pages tab on the left.', 'pages-in-widgets' ); ?></small></p>
		<p><label for="<?php echo $this->get_field_id('pageID'); ?>"><span style="float:left; width:100%;"><?php _e( 'Page:', 'pages-in-widgets' ); ?></span>
		<select class="large-text" style="width:100%;" id="<?php echo $this->get_field_id('pageID'); ?>" name="<?php echo $this->get_field_name('pageID'); ?>">
			<?php
				$args = array( 'post_type' => 'page', 'post_status' => 'publish', 'posts_per_page' => -1 );
				$pageList = new WP_Query( $args );
				while ( $pageList->have_posts() ){
					$pageList->the_post();
					$pageid = get_the_ID();
				?>
					<option value="<?php echo $pageid; ?>" <?php if($pageid == intval($currentInstance['pageID']) && $currentInstance['pageID'] != null){echo 'selected="selected"';} ?>><?php echo the_title(); ?></option>
				<?php
				}
				wp_reset_postdata();
			?>
		</select>
		</label></p>
		<p><label for="<?php echo $this->get_field_id('titleEnable'); ?>-yes"><span style="width:100%; float:left;"><?php _e( 'Show Page Title:', 'pages-in-widgets' ); ?></span></label>

		<label for="<?php echo $this->get_field_id('titleEnable'); ?>-yes"><?php _e( 'Yes:', 'pages-in-widgets' ); ?> <input type="radio" value="true" name="<?php echo $this->get_field_name('titleEnable'); ?>" id="<?php echo $this->get_field_id('titleEnable'); ?>-yes" <?php if($currentInstance['titleEnable'] == 'true'){echo 'checked="checked"';} ?>/></label>
		<label for="<?php echo $this->get_field_id('titleEnable'); ?>-no"><?php _e( 'No:', 'pages-in-widgets' ); ?> <input type="radio" value="false" name="<?php echo $this->get_field_name('titleEnable'); ?>" id="<?php echo $this->get_field_id('titleEnable'); ?>-no" <?php if($currentInstance['titleEnable'] == 'false'){echo 'checked="checked"';} ?>/></label></p>

		<p>	<label for="<?php echo $this->get_field_id('titletype'); ?>"><?php _e( 'Title Type:', 'pages-in-widgets' ); ?></label><br/>
		<select class="large-text" id="<?php echo $this->get_field_id('titletype'); ?>" name="<?php echo $this->get_field_name('titletype'); ?>">
			<option value="h1" <?php if($currentInstance['titletype'] == 'h1'){echo 'selected';}?>>H1</option>
			<option value="h2" <?php if($currentInstance['titletype'] == 'h2'){echo 'selected';}?>>H2</option>
			<option value="h3" <?php if($currentInstance['titletype'] == 'h3'){echo 'selected';}?>>H3</option>
			<option value="h4" <?php if($currentInstance['titletype'] == 'h4'){echo 'selected';}?>>H4</option>
			<option value="h5" <?php if($currentInstance['titletype'] == 'h5'){echo 'selected';}?>>H5</option>
			<option value="h6" <?php if($currentInstance['titletype'] == 'h6'){echo 'selected';}?>>H6</option>
			<option value="p" <?php if($currentInstance['titletype'] == 'p'){echo 'selected';}?>>P</option>
		</select>
		</p>

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

		<p><label for="<?php echo $this->get_field_id('outputcontent'); ?>"><?php _e( 'Content:', 'pages-in-widgets' ); ?></label><br/>
			<select class="large-text" style="width:100%;" id="<?php echo $this->get_field_id('outputcontent'); ?>" name="<?php echo $this->get_field_name('outputcontent'); ?>">
				<option value="content" <?php if($currentInstance['outputcontent'] == "content"){echo 'selected=""';}?>><?php _e('Content', 'pages-in-widgets' ); ?></option>
				<option value="excerpt" <?php if($currentInstance['outputcontent'] == "excerpt"){echo 'selected=""';}?>><?php _e('Excerpt', 'pages-in-widgets' ); ?></option>
			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id('imageposition'); ?>"><?php _e( 'Image Position:', 'pages-in-widgets' ); ?></label><br/>
			<select class="large-text" style="width:100%;" id="<?php echo $this->get_field_id('imageposition'); ?>" name="<?php echo $this->get_field_name('imageposition'); ?>">
				<option value="none" <?php if($currentInstance['imageposition'] == "none"){echo 'selected=""';}?>><?php _e('None', 'pages-in-widgets' ); ?></option>
				<option value="above-title" <?php if($currentInstance['imageposition'] == "above-title"){echo 'selected=""';}?>><?php _e('Above Title', 'pages-in-widgets' ); ?></option>
				<option value="above-content" <?php if($currentInstance['imageposition'] == "above-content"){echo 'selected=""';}?>><?php _e('Above Content', 'pages-in-widgets' ); ?></option>
				<option value="below-content" <?php if($currentInstance['imageposition'] == "below-content"){echo 'selected=""';}?>><?php _e('Below Content', 'pages-in-widgets' ); ?></option>
			</select>
		</p>
		<?php
		global $_wp_additional_image_sizes;
		$image_sizes = array();
		$default_image_sizes = get_intermediate_image_sizes();
		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}
		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}
		?>
		<p><label for="<?php echo $this->get_field_id('imagesize'); ?>"><?php _e( 'Image Size:', 'pages-in-widgets' ); ?></label><br/>
			<select class="large-text" style="width:100%;" id="<?php echo $this->get_field_id('imagesize'); ?>" name="<?php echo $this->get_field_name('imagesize'); ?>">
				<?php foreach ( $image_sizes as $size_name => $size_atts ): ?>
				<option value="<?php echo $size_name; ?>" <?php if($currentInstance['imagesize'] == $size_name){echo 'selected=""';}?>><?php echo $size_name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
        <br/>
		<?php
	}

/*
* Update Widget
*/
	function update($new_instance, $old_instance){
   		$instance = $old_instance;
		
		//,$output = 'ARRAY_A' ,$output = 'ARRAY_A'
		$postI = get_post(intval($new_instance['pageID']));
		$instance['title'] = $postI->post_title;
		
    	$instance['pageID'] = $new_instance['pageID'];
		$instance['titleEnable'] = $new_instance['titleEnable'];
		$instance['customCssClass'] = $new_instance['customCssClass'];
		$instance['outputtype'] = $new_instance['outputtype'];
		$instance['outputcontent'] = $new_instance['outputcontent'];
		$instance['imageposition'] = $new_instance['imageposition'];
		$instance['imagesize'] = $new_instance['imagesize'];
		$instance['titletype'] = $new_instance['titletype'];
    	return $instance;
    }

/*
* Output Widget
*/
	function widget($args, $instance){
		extract($args, EXTR_SKIP);
		$pageID = $instance['pageID'];
		$titleEnable = $instance['titleEnable'];
		$customCssClass = $instance['customCssClass'];
		$outputType = $instance['outputtype'];
		if(isset($instance['outputcontent']) == false){
			$instance['outputcontent'] = 'excerpt';
		}
		$outputContent = $instance['outputcontent'];
		if(isset($instance['imageposition']) == false){
			$instance['imageposition'] = 'none';
		}
		$imagePosition = $instance['imageposition'];
		if(isset($instance['imagesize']) == false){
			$instance['imagesize'] = 'thumbnail';
		}
		$imageSize = $instance['imagesize'];
		
		if(isset($instance['titletype']) == false){
			$instance['titletype'] = 'h2';
		}
		$titletype = $instance['titletype'];
    	echo $before_widget;
		$args = array( 'page_id' => $pageID );
		$page = new WP_Query( $args );
		if($page->have_posts()) : $page->the_post();
			if($imagePosition == 'above-title'){
				echo apply_filters('pagesinwidgets_image',get_the_post_thumbnail($pageID,$imageSize));
			}
			if($titleEnable == 'true'){
				echo '<'.$titletype . ' class="widget-title widgettitle">' . get_the_title() .'</'.$titletype.'>';
			}
			?>
			<div class="<?php echo (($customCssClass)?$customCssClass:'homepage_section'); ?>">
				<?php
				if($imagePosition == 'above-content'){
					echo apply_filters('pagesinwidgets_image',get_the_post_thumbnail($pageID,$imageSize));
				}
				if($outputContent == 'excerpt'){
					$content = apply_filters('pagesinwidgets_content',get_the_excerpt());
				}else{
					$content = apply_filters('pagesinwidgets_content',get_the_content());
				}
				if($outputType == 'plaintext'){
					echo strip_tags($content);
				}
				else if($outputType == 'forceptags'){
					$rsp = array("\r\n&nbsp;\r\n","\n&nbsp;\n","\r&nbsp;\r");
					$content = str_replace($rsp,"</p><p>",$content);
					$rsp2 = array("\r\n\r\n&nbsp;\r\n\r\n","\r\r&nbsp;\r\r","\n\n&nbsp;\n\n");
					$content = str_replace($rsp,"</p><br/><p>",$content);
					echo do_shortcode(apply_filters('the_content',"<p>"+$content+"</p>"));
				}
				else{
					echo do_shortcode(apply_filters('the_content',$content));
				}
				if($imagePosition == 'below-content'){
					echo apply_filters('pagesinwidgets_image',get_the_post_thumbnail($pageID,$imageSize));
				}
				?>
				</div>
			<?php
		endif;
		echo $after_widget;
		wp_reset_postdata();
	}

}
