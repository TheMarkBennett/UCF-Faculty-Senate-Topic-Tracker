<?php get_header(); ?>


<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">

	<div class=" content-area" id="primary">
	<!-- Searchbox -->
	
	<div class="search pb-3">
		<form  role="search"  id="searchform" action="<?php echo esc_url( get_post_type_archive_link( 'ucf_fs_topic_tracker' ) );  ?>">
			<div class="">
				<div class="row form-group">
					<div class="col-12">						
						<input type="text" class="form-control" value=" <?php echo get_search_query() ?>" class="topic-search" id="topic-search" placeholder="Search" name="s">
					</div>										
				</div>
				<div class="row form-group">
				<div class="col-4">
					
					<select class="form-control topic-tracker-status"  name="status">
					<?php if(!isset($_GET['status'])){$_GET['status'] = ""; } ?>
					<option value="">All Status</option>
					<option value="completed" <?php selected($_GET['status'], 'completed' ); ?>  > Completed </option>
					<option value="in_progress" <?php  selected($_GET['status'], 'in_progress' ); ?> > In Progress </option>
					<option value="committee_monitoring" <?php selected($_GET['status'], 'committee_monitoring' ); ?> > Committee monitoring </option>
					<option value="not_addressed" <?php  selected($_GET['status'], 'not_addressed' ); ?> > Not addressed </option>
					<option value="pending" <?php  selected($_GET['status'], 'pending' ); ?> > Pending </option>
					<option value="closed" <?php  selected($_GET['status'], 'closed' ); ?> > Closed </option>			

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
							<option value="<?php echo esc_attr(get_the_ID()); ?>" <?php if(isset($_GET['committee'])){echo selected($_GET['committee'], get_the_ID() );} ?> ><?php the_title(); ?></option> 
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
				

			$rows = get_field( 'topic_tracker_status_update', get_the_ID() ); // get all the rows from and page ID
			if($rows):
								
					$end_row = end( $rows ); // get the end row

					
				
			endif;

			if(isset($end_row)):	
			$status = $end_row['topic_tracker_status' ]['value']; // get the sub field value 
			$lastUpdated = $end_row['topic_tracker_status_date' ]; // get the sub field value
			endif;
			
			//var_dump($status); 
			
				
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





