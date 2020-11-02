<?php
/*
Plugin Name: UCF Faculty Senate Topic Tracker
Description: Provides an issue tracker for faculty senate.
Version: 1.0.04
Author: Mark Bennett
License: GPL3
GitHub Plugin URI:  TheMarkBennett/UCF-Faculty-Senate-Topic-Tracker
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

//topic tracker post type
require_once 'includes/topic-tracker-post-type.php';

// template settings, remove ucf redirects, and search
require_once 'topic-tracker-settings.php';



require_once 'templates/ucf_fs_topic_tracker_topic_info.php';

require_once 'templates/ucf_fs_topic_tracker_topic_status.php';

require_once 'shortcode/topic-tracker-shortcode.php';




















