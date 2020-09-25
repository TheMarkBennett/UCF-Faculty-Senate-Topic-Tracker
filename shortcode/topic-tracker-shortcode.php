<?php

// Add Shortcode
function UCF_fs_topic_tracker_shortcode( $atts ) {


	$output .='<form method="GET">
		<div class="">
			<div class="row form-group">
				<div class="col-4">
					<input type="text" class="form-control" id="topic-search" placeholder="Search" name="s">
				</div>
				<div class="col-3">
					<select class="form-control">
						<option>Mustard</option>
						<option>Ketchup</option>
						<option>Relish</option>
					</select>
				</div>
				<div class="col-3">
					<select class="form-control">
						<option>2020</option>
						<option>2019</option>
						<option>2018</option>
					</select>
				</div>
				<div class="col-2">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>			
		</div>
	</form>';

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
						<td><a href="' . get_permalink() . '">' . get_the_title() . '</a></td>';

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