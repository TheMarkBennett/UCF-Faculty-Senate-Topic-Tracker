<?php

// Add Shortcode
function UCF_fs_topic_tracker_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'status' => '',
			'order' => 'ASC',
			'orderby' => '',
			'posts_per_page' => '-1',
		),
		$atts,
		'topic-tracker'
	);

	// Extract shortcode atributes
	extract( $atts );

	// Define query
	$query_args = array(
		'post_type'      => 'ucf_fs_topic_tracker', // Change this to the type of post you want to show
		'posts_per_page' => $posts_per_page,
		/*
		'meta_query'	=> array(
			'relation'		=> 'AND',
			array(
				'key'		=> 'location',
				'value'		=> 'Melbourne',
				'compare'	=> '='
			),
			array(
				'key'		=> 'attendees',
				'value'		=> 100,
				'type'		=> 'NUMERIC',
				'compare'	=> '>'
				)
		)

		*/
	);

	// Query posts
	$custom_query = new WP_Query( $query_args );

	// Add content if we found posts via our query
	if ( $custom_query->have_posts() ) {

		// Open div wrapper around loop
		$output .= '<div class="topic-tracker table-responsive">
					<table class="table table-hover">
					<thead class="thead-inverse">
						<tr>
							<th scope="col">Topic</th>
							<th scope="col">Staus</th>
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
						<td>' . get_the_title() .'</td>';

			//Get the repeater fields for the latest status
			$repeater = get_field('topic_tracker_status_update');
			$last_row = end($repeater);						

			$output .='			
						<td>'. $last_row['topic_tracker_status'] .'</td>
						<td>'. $last_row['topic_tracker_status_date'] .'</td>
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