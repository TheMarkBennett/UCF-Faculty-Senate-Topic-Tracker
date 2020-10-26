<?php get_header(); ?>


<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">

	<div class=" content-area" id="primary">
	<!-- Searchbox -->
	
	<div class="search pb-3">
		<form  role="search"  id="searchform" action="<?php echo esc_url( get_post_type_archive_link( 'ucf_fs_topic_tracker' ) );  ?>">
			<div class="">
				<div class="row form-group">
					<div class="col-12">						
						<input type="text" class="form-control" id="topic-search" placeholder="Search" name="s">
					</div>										
				</div>
				<div class="row form-group">
				<div class="col-4">
					
					<select class="form-control topic-tracker-status1"  name="status">

					<option value="">All Status</option>

						<?php if( have_rows('topic_tracker_status_update') ): ?>
							<?php while( have_rows('topic_tracker_status_update') ): the_row(); ?>
								<?php 

								// Get the sub field called "select".
								$select = get_sub_field_object('topic_tracker_status');								

								?>							
								
									<?php foreach( $select['choices'] as $k => $v ): ?>
										<option value="<?php echo esc_attr($k) ?>"> <?php echo esc_html($v); ?> </option>
									<?php endforeach; ?>

								<?php break; ?>	
							<?php endwhile; ?>
						<?php endif; ?>						
						</select>
					</div>										
					<div class="col-6">
						<select class="form-control" name="committee">
						<option value="">All committees</option>
						<?php 

							$args = array(
								'post_type' => 'ucf_fs_committees',
								'posts_per_page' => -1,
								'orderby' => 'title', 
        						'order' => 'ASC',  
								
							);
							$query = new WP_Query( $args );
							while ( $query->have_posts() ) : $query->the_post(); ?>
							<option value="<?php echo esc_attr(get_the_ID()); ?>"><?php the_title(); ?></option> 
						<?php endwhile;
						wp_reset_postdata(); 
						?>						
						</select>
					</div>					
					<div class="col-2 text-right">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div><strong class="align-baseline"><?php echo $wp_query->found_posts ?> topics found</strong></div>
					</div>
				</div>				
			</div>
		</form>
	</div>
	
	<hr class="mt-0">
	<!-- end of search box -->	
	<?php if ( have_posts() ): ?>
		<table class="table table table-striped table-sm1 topic-tracker-archive">
			<thead class="">
				<tr>
					<th scope="col" >Steering #</th>				
					<th scope="col" >topic</th>
					<th scope="col" >Status</th>
					<th scope="col" >Last Updated</th>						
				</tr>
			</thead>
			<tbody>
			
				<?php while ( have_posts() ) : the_post(); ?>
				
				<?php
				
				$repeater = get_field('topic_tracker_status_update');				
				$last_row = NULL;
				if($repeater){
				
					if (count($repeater) > 1) {
						$last_row = end($repeater);	
						//var_dump($last_row['topic_tracker_status']);					
					}elseif(count($repeater) == 1){
						$last_row = $repeater[0];
						//var_dump($last_row[0]['topic_tracker_status']);	
					}
				}

			
			 if(! $last_row == NULL)
			 {
			$status = $last_row['topic_tracker_status']['label'];
			 $lastUpdated = $last_row['topic_tracker_status_date'];
			 
			 }
				
				?>
				<tr>
					<td><a href="<?php the_permalink(); ?>"><?php the_field('topic_tracker_steering_number'); ?> </a> </td>
					<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </td>
					<td><?php  if(isset($status)){ echo $status; } ?></td>
					<td><?php if(isset($lastUpdated)){ echo $lastUpdated; } ?></td>
				</tr>
				<?php endwhile ?>		
				
			</tbody>
		</table>
		<?php ucfwp_the_posts_pagination(); ?>
		<?php else: ?>
					<p>No results found.</p>
				<?php endif; ?>
	</div>
		
</div>

<?php get_footer(); ?>
