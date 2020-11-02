<?php


/*
* Shorcode to display topics form the topics tracker
*/

// Add Shortcode
function UCF_fs_topic_tracker_shortcode( $atts ) {



	// Attributes
	$atts = shortcode_atts(
		array(
			'status' => '',
			'order' => 'ASC',
			'orderby' => '',
			'posts_per_page' => '5',
			'committee'  => '',
		),
		$atts,
		'topic-tracker'
	);

	// Extract shortcode atributes
	extract( $atts );

	// Define query
	$query_args = array(
		'post_type'      => 'ucf_fs_topic_tracker', 
		'posts_per_page' => $posts_per_page,
		
		
	);

	// Add a committee to the query
	if(!empty($committee)){
	$query_args['meta_query'] = array(
		'relation' => 'AND', 
		 array('key' => 'topic_tracker_committee_assignment_copy', 
			   'value' => $committee, 
			   'compare' => '==', 
			   'type' => 'NUMERIC'
			   )
		 );

	}

	$output ="";
	// Query posts
	$custom_query = new WP_Query( $query_args );

	// Add content if we found posts via our query
	if ( $custom_query->have_posts() ) {

		// Open div wrapper around loop
		$output .= '<div class="topic-tracker-shortcode table-responsive">
					<table class="table table-striped">
					<thead class="">
						<tr>
							<th scope="col">Topic</th>
							<th scope="col">Status</th>
							<th scope="col">Last Updated</th>
							
						</tr>
					</thead>
					';

		// Loop through posts
		while ( $custom_query->have_posts() ) {

			// Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
			$custom_query->the_post();

			// This is the output for your entry so what you want to do for each post.
			$output .='
					<tr>
						<td><a href="' . get_permalink() . '" class="text-secondary">' . get_the_title() . '</a></td>';

			//Get the repeater fields for the latest status
			$repeater = get_field('topic_tracker_status_update');
		

			if(isset($repeater)): //check if the repeater field is set
				$last_row = array_pop($repeater);	// get the last row of the repeater
					
			endif;

			/*
			* Out put the tracker status and date if avaliable
			*/
				$output .='			
							<td>'; 
							if(isset($last_row)){ $output .= $last_row['topic_tracker_status']['label'];} 
				$output .='</td>
							<td>';
							if(isset($last_row)){ $output .= $last_row['topic_tracker_status_date'];} 
				$output .='</td>
						</tr>';
			
			
		}

		// Close div wrapper around loop
		$output .= '</table>
		</div>';

		// Restore data
		wp_reset_postdata();

	}

	// Return your shortcode output
	return $output;

}
add_shortcode( 'topic-tracker', 'UCF_fs_topic_tracker_shortcode' );