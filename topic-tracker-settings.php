<?php





//remove theme redirects set by the UCF theme
function remove_redirects() {
    remove_action( 'template_redirect', 'ucfwp_kill_unused_templates' );
}
add_action( 'after_setup_theme', 'remove_redirects');



/*
* Template for Topic Tracker single page layout
*/
function ucf_fs_topic_single_template( $template ) {

	if ( is_singular( 'ucf_fs_topic_tracker' ) ) {
		$template = plugin_dir_path( __FILE__ ) . 'templates/ucf_fs_topic_tracker.php';
	}
	
	return $template;
}

add_filter( 'single_template', 'ucf_fs_topic_single_template', 50, 1 );


/*
*  Template for Topic Tracker Archieve Page
*/
function ucf_fs_topic_archieve_template($tpl){
	if ( is_post_type_archive ( 'ucf_fs_topic_tracker' ) ) {
	  $template = plugin_dir_path( __FILE__  ) . 'templates\ucf_fs_topic_tracker_archive.php';
	}
	return $template;
  }
  
  add_filter( 'archive_template', 'ucf_fs_topic_archieve_template' ) ;



    //archive page search


  /*
  *  Change the queries on the topics archieve paged
  * based on the search filters entered
  */
  function ucf_fs_topic_tracker_alter_search($query ) {
    if ( !is_post_type_archive('ucf_fs_topic_tracker' )  || !$query->is_main_query() ) {
      // Do nothing if not on Topic Tracker
      return;                   
    }
    

    $query->set( 'posts_per_page', '20' );

    $meta_query = array();
 


    if ( isset( $_GET['s'] ) ) { //filter by search term
      $query->set( 's', $_GET['s'] );
    }


  if ( isset( $_GET['committee']) && ! empty($_GET['committee'])  ) { // filter by committee post type
         $meta_query[] = array(
        array(
            'key' => 'topic_tracker_committee_assignment_copy',
            'value' => $_GET['committee'],
            //'type' => 'DATE',
            'compare' => '='
        )
    );
  }


  if ( isset( $_GET['status']) && ! empty($_GET['status'])  ) { // filter by topic status
    $meta_query[] = array(
   array(
       'key' => 'topic_tracker_current_status',
       'value' => $_GET['status'],
       //'type' => 'DATE',
       'compare' => '='
   )
);
}



  $meta_query['relation'] = 'AND';

    $query->set('meta_query',$meta_query);

    
  }
 

  add_action('pre_get_posts','ucf_fs_topic_tracker_alter_search');