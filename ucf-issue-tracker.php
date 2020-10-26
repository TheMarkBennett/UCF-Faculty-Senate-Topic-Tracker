<?php
/*
Plugin Name: UCF Faculty Senate Topic Tracker
Description: Provides an issue tracker for faculty senate.
Version: 1.0.03
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


function my_plugin_assets() {

  if( !is_post_type_archive('ucf_fs_topic_tracker') || is_singular( 'ucf_fs_topic_tracker' ) ){
    return;
  }
    wp_enqueue_style( 'topic-tracker-css', plugins_url( '/src/css/fs-topic-tracker.css' , __FILE__ ) );
    wp_enqueue_style( 'select-2-css', plugins_url( '/src/css/select2.min.css' , __FILE__ ) );
    wp_enqueue_style( 'select-2-bootstrap-css', plugins_url( '/src/css/select2-bootstrap4.min.css' , __FILE__ ) );
  
    wp_enqueue_script( 'select-2-js', plugins_url( '/src/js/select2.min.js' , __FILE__ ) );
    wp_enqueue_script( 'topic-select-2-js', plugins_url( '/src/js/topicform.js' , __FILE__ ) );
    
}
add_action( 'wp_enqueue_scripts', 'my_plugin_assets' );

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


function use_custom_template($tpl){
	if ( is_post_type_archive ( 'ucf_fs_topic_tracker' ) ) {
	  $tpl = plugin_dir_path( __FILE__ ) . '/templates/ucf_fs_topic_tracker_archive.php';
	}
	return $tpl;
  }
  
  add_filter( 'archive_template', 'use_custom_template' ) ;




//*query variables */
add_action('init','add_get_val');
function add_get_val() {
    global $wp;
 
    // array of filters (field key => field name)
    $GLOBALS['my_query_filters'] = array( 
      'field_5f452b73d4bf7'	=> 'topic_tracker_status', 
     // 'ville'	    => 'ville', 
     // 'date'	    => 'date'
  );
}


  //archive page search

  function alter_search_ppp_wpse_107154($query ) {
    if ( !is_post_type_archive('ucf_fs_topic_tracker' ) ) {
      // Do nothing if not on Topic Tracker
      return;                   
    }
    $query->set( 'posts_per_page', '20' );

    if ( isset( $_GET['s'] ) ) {
      $query->set( 's', $_GET['s'] );
    }

    
  if ( get_query_var('status') ) {
      $meta_query = array(
        array(
            'key' => 'topic_tracker_status',
            'value' => array('Completed'),
            //'type' => 'DATE',
            'compare' => '='
        )
    );
  }


    $query->set('meta_query',$meta_query);

    
  }
 

  add_action('pre_get_posts','alter_search_ppp_wpse_107154');




  function remove_redirects() {
    remove_action( 'template_redirect', 'ucfwp_kill_unused_templates' );
}
add_action( 'after_setup_theme', 'remove_redirects');

