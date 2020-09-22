<?php
/*
Plugin Name: UCF Faculty Senate Topic Tracker
Description: Provides an issue tracker for faculty senate.
Version: 1.0.01
Author: Mark Bennett
License: GPL3
GitHub Plugin URI:  TheMarkBennett/UCF-Faculty-Senate-Topic-Tracker
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

//topic tracker post type
require_once 'includes/topic-tracker-post-type.php';

require_once 'templates/ucf_fs_topic_tracker_topic_info.php';

require_once 'templates/ucf_fs_topic_tracker_topic_status.php';

require_once 'shortcode/topic-tracker-shortcode.php';




function ucf_fs_topic_single_template( $template ) {

	if ( is_singular( 'ucf_fs_topic_tracker' ) ) {
		$template = plugin_dir_path( __FILE__ ) . 'templates/ucf_fs_topic_tracker.php';
	}
	
	return $template;
}

add_filter( 'single_template', 'ucf_fs_topic_single_template', 50, 1 );



function ucf_fs_topic_tracker_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'topic-tracker-sidebar',
            'name'          => __( 'Topic Tracker Sidebar' ),
            'description'   => __( 'This is the sidebar on the topic tracker.' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s p-3 mb-4">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title heading-underline h6">',
            'after_title'   => '</h3>',
        )
    );
    
}
add_action( 'widgets_init', 'ucf_fs_topic_tracker_register_sidebars' );