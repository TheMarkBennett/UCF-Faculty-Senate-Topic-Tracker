<?php
/*
Plugin Name: UCF Faculty Senate Topic Tracker
Description: Provides an issue tracker for faculty senate.
Version: 1.0.00
Author: Mark Bennett
License: GPL3
GitHub Plugin URI:  TheMarkBennett/UCF-Faculty-Senate-Topic-Tracker
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once 'includes/topic-tracker-post-type.php';

require_once 'templates/ucf_fs_topic_tracker_topic_info.php';

require_once 'templates/ucf_fs_topic_tracker_topic_status.php';


function ucf_fs_topic_single_template( $template ) {

	if ( is_singular( 'ucf_fs_topic_tracker' ) ) {
		$template = plugin_dir_path( __FILE__ ) . 'templates\ucf_fs_topic_tracker.php';
	}
	
	return $template;
}

add_filter( 'single_template', 'ucf_fs_topic_single_template', 50, 1 );
