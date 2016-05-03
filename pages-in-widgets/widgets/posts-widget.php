<?php
/* Posts Widget */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'widgets_init', 'postsinwidgets_posts' );
function postsinwidgets_posts() {
	register_widget( 'pagesinwidgets_post_section' );
}

class pagesinwidgets_post_section extends WP_Widget {

	function __construct(){
		parent::__construct('pagesinwidgets_post_section',__( 'Posts In Widgets', 'pages-in-widgets' ),
			array(
				'description' => __( 'A general layout for post sections.', 'pages-in-widgets' ),
				'classname'   => 'pagesinwidgets_post_section'
			)
		);
	}
/*
* Output Type Selection
*/
	function form($instance){
		$currentInstance = $instance;
		$instance = wp_parse_args( (array) $instance, array('postID' => '','titleEnable' => 'true') );
		if(isset($currentInstance['title']) == false){
			$currentInstance['title'] = "";
		}
		if(isset($currentInstance['postID']) == false){
			$currentInstance['postID'] = 1;
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
		<p style="font-style: italic;"><small><?php _e( 'Select the post here and then edit the post under the posts tab on the left.', 'pages-in-widgets' ); ?></small></p>
		<p><label for="<?php echo $this->get_field_id('postID'); ?>"><span style="float:left; width:100%;"><?php _e( 'post:', 'pages-in-widgets' ); ?></span>
		<select class="large-text" style="width:100%;" id="<?php echo $this->get_field_id('postID'); ?>" name="<?php echo $this->get_field_name('postID'); ?>">
			<?php
				$args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_post' => -1 );
				$postList = new WP_Query( $args );
				while ( $postList->have_posts() ){
					$postList->the_post();
					$postid = get_the_ID();
				?>
					<option value="<?php echo $postid; ?>" <?php if($postid == intval($currentInstance['postID']) && $currentInstance['postID'] != null){echo 'selected="selected"';} ?>><?php echo the_title(); ?></option>
				<?php
				}
				wp_reset_postdata();
			?>
		</select>
		</label></p>	
		<p><label for="<?php echo $this->get_field_id('titleEnable'); ?>-yes"><span style="width:100%; float:left;"><?php _e( 'Show post Title:', 'pages-in-widgets' ); ?></span></label>
		
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

/*
* Update Widget
*/
	function update($new_instance, $old_instance){
   		$instance = $old_instance;
    	$instance['postID'] = $new_instance['postID'];
		$instance['titleEnable'] = $new_instance['titleEnable'];
		$instance['customCssClass'] = $new_instance['customCssClass'];
		$instance['outputtype'] = $new_instance['outputtype'];
    	return $instance;
    }

/*
* Output Widget
*/
	function widget($args, $instance){
		extract($args, EXTR_SKIP);
		$postID = $instance['postID'];
		$titleEnable = $instance['titleEnable'];
		$customCssClass = $instance['customCssClass'];
		$outputType = $instance['outputtype'];
    	echo $before_widget;
		$args = array( 'p' => $postID );
		$post = new WP_Query( $args );
		$post = $post->the_post();
		if($titleEnable == 'true'){ ?>
		<h4 class="widget-title widgettitle"><?php echo the_title(); ?></h4>
		<?php } ?>
		<div class="<?php echo (($customCssClass)?$customCssClass:'homepost_section'); ?>">
			<?php 
			if($outputType == 'plaintext'){
				echo strip_tags($post['post_content']);
			}
			else if($outputType == 'forceptags'){
				$content = the_content();
				$rsp = array("\r\n&nbsp;\r\n","\n&nbsp;\n","\r&nbsp;\r");
				$content = str_replace($rsp,"</p><p>",$content);
				$rsp2 = array("\r\n\r\n&nbsp;\r\n\r\n","\r\r&nbsp;\r\r","\n\n&nbsp;\n\n");
				$content = str_replace($rsp,"</p><br/><p>",$content);
				echo do_shortcode(apply_filters('the_content',"<p>"+$content+"</p>"));
			}
			else{
				echo do_shortcode(apply_filters('the_content',$post['post_content']));
			}
			?>
			</div>
		<?php
   		echo $after_widget;
   		wp_reset_postdata();
	}

}