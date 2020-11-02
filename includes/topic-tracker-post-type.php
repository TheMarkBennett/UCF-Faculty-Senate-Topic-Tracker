<?php

/*
*	Topics tracker custom postype
*/

function cptui_register_my_cpts_ucf_fs_topic_tracker() {

	/**
	 * Post Type: Topics Tracker.
	 */

	$labels = [
		"name" => __( "Topics Tracker", "custom-post-type-ui" ),
		"singular_name" => __( "Topic Tracker", "custom-post-type-ui" ),
		"menu_name" => __( "Topic Tracker", "custom-post-type-ui" ),
		"all_items" => __( "All Topics", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Topic", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Topic", "custom-post-type-ui" ),
		"new_item" => __( "New Topic", "custom-post-type-ui" ),
		"view_item" => __( "View Topic", "custom-post-type-ui" ),
		"view_items" => __( "View Topics", "custom-post-type-ui" ),
		"search_items" => __( "Search Topics", "custom-post-type-ui" ),
		"not_found" => __( "No Topics found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "NoTopics found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Issue:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image", "custom-post-type-ui" ),
		"archives" => __( "Topic archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Topic", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Topic", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Topics list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Topics list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Topics list", "custom-post-type-ui" ),
		"attributes" => __( "Topics attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Topic Tracker", "custom-post-type-ui" ),
		"item_published" => __( "Topic published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Topic published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Topic reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Topic scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Topic updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Issue:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Topics Tracker", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "Topic Tracker",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "topic", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-clipboard",
		"supports" => [ "title", "editor", "revisions" ],
	];

	register_post_type( "ucf_fs_topic_tracker", $args );
}

add_action( 'init', 'cptui_register_my_cpts_ucf_fs_topic_tracker' );
	


/*
*  Add sidebar
*/


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




/*
* Update date the status field based on the repeater field
*/

function ucf_acf_save_status( $post_id ) {
    
	// get repeater field value
	  $repeater = get_field('topic_tracker_status_update');
  
	if($repeater){
	  
	  // get last row in repeater field
	  $row = array_pop($repeater);
	 
	  $value = $row['topic_tracker_status' ]['value'];
	
	}
  
	//update current status field with the last field of the repeater
	update_field('topic_tracker_current_status', $value);
	
  }
  
  add_action('acf/save_post', 'ucf_acf_save_status', 20);
  







