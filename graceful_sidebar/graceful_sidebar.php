<?php
/*
Plugin Name: A Graceful Sidebar Plugin
Plugin URI: http://mlynn.org/graceful-sidebar-plugin
Tags: custom sidebar, pages sidebar, custom sidebar
Description: Creates a custom sidebar widget to display a custom field from a page.  Create a page or post, enable the widget in your sidebar and add content. Create custom fields called graceful_title and graceful_content.  <br><a href="plugins.php?page=graceful_sidebar/graceful_sidebar.php">Settings</a> | <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=KKFYUAMPCQHXQ">Donate</a>

Version: 1.0.2
Author: Michael Lynn
Author URI: http://www.mlynn.org/
*/

add_action("init", "gs_widget_init");

function gs_widget_init() {

  register_sidebar_widget('Graceful Sidebar Widget', 'gs_widget');
  register_widget_control('Graceful Sidebar Widget', 'gs_widget_control', '500', '500');

}

///////////////////////////////////////////////////////////////
// gs_widget
// abstract: Displays widget content for current post or page 
// args    : 
// returns :
// globals : $post
///////////////////////////////////////////////////////////////
function gs_widget($args) {

	global $post;
	if (is_single() || is_page()) {
		extract($args);
		$gs_widget_options = unserialize(get_option('gs_widget_options'));
		echo $before_widget;
		echo $before_title;

		$title = get_post_meta($post->ID, 'graceful_title', true);
		if($title) {
			echo $title;
		}

		echo $after_title;

		$content = get_post_meta($post->ID, 'graceful_content', true);
		if($content) {
			echo $content;
		}
		echo $after_widget;
	}
}

///////////////////////////////////////////////////////////////
// gs_widget_control
// abstract: Displays control panel item for widget 
// args    : 
// returns : 
// globals : 
///////////////////////////////////////////////////////////////
function gs_widget_control() {
	if(!get_option('custom_widget_options')) {
		add_option('gs_widget_options', serialize(array('title'=>'Graceful Sidebar', 'text'=>'')));
	}
	  echo 'Nothing here to configure.';
}  

