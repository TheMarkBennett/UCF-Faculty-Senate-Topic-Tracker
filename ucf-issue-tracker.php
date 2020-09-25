<?php
/*
Plugin Name: UCF Faculty Senate Topic Tracker
Description: Provides an issue tracker for faculty senate.
Version: 1.0.02
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



// Add a filter to 'template_include' hook
//add_filter( 'template_include', 'wpse_force_template' );
function wpse_force_template( $template ) {
    // If the current url is an archive of any kind
    if( is_archive() ) {
        // Set this to the template file inside your plugin folder
        $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/archive.php';
    }
    // Always return, even if we didn't change anything
    return $template;
}

//add_filter('template_include', 'lessons_template');

function lessons_template( $template ) {
  if ( is_post_type_archive('my_plugin_lesson') ) {
    $theme_files = array('archive-my_plugin_lesson.php', 'myplugin/archive-lesson.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return plugin_dir_path(__FILE__) . 'archive-lesson.php';
    }
  }
  return $template;
}


function use_custom_template($tpl){
	if ( is_post_type_archive ( 'ucf_fs_topic_tracker' ) ) {
	  $tpl = plugin_dir_path( __FILE__ ) . '/templates/ucf_fs_topic_tracker_archive.php';
	}
	return $tpl;
  }
  
  add_filter( 'archive_template', 'use_custom_template' ) ;





