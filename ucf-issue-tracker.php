<?php
/*
Plugin Name: UCF Faculty Senate Issue Tracker
Description: Provides an issue tracker for faculty senate.
Version: 1.0.00
Author: Mark Bennett
License: GPL3
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}




add_action( 'plugins_loaded', function() {

	//define( 'UCF_ISSUE_Tracker__PLUGIN_FILE', __FILE__ );
	//define( 'UCF_ISSUE_TRACKER', plugin_dir_path( __FILE__ ) );

	//require_once 'layouts/layout-square.php';
	//require_once 'layouts/layout-horizontal.php';
	//require_once 'layouts/layout-vertical.php';
	//require_once 'includes/ucf-spotlight-common.php';
	//require_once 'includes/ucf-spotlight-posttype.php';
	//require_once 'shortcodes/ucf-spotlight-shortcode.php';

	//require_once( UCF_ISSUE_TRACKER . 'layout/admin-page.php');

	//add_filter( 'single_template', 'ucf_fs_issue_single_template', 50, 1 );


} );

require_once 'includes/topic-tracker-post-type.php';








require_once 'templates/ucf_fs_topic_tracker_topic_info.php';

require_once 'templates/ucf_fs_topic_tracker_topic_status.php';

