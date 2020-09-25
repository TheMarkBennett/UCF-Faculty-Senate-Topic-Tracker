<?php get_header(); ?>


<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">

	<div class=" content-area" id="primary">
	<!-- Searchbox -->

	<div class="search pb-3">
		<form method="GET">
			<div class="">
				<div class="row form-group">
					<div class="col-4">
						<input type="text" class="form-control" id="topic-search" placeholder="Search" name="s">
					</div>
					<div class="col-4">
						<select class="form-control">
						<?php if( have_rows('topic_tracker_status_update') ): ?>
							<?php while( have_rows('topic_tracker_status_update') ): the_row(); ?>
							<?php $field = get_sub_field_object('topic_tracker_status'); ?>
							<?php
								$choices = $field['choices'];		
								foreach( $field['choices'] as $value => $label ): ?>
								
									<option><?php echo $label; ?></option>

								<? endforeach; ?>
										
							<?php endwhile; ?>

						<?php endif; ?>
						</select>
					</div>
					<div class="col-2">
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
		</form>
	</div>
	<hr class="">
	<!-- end of search box -->		
		<table class="table table-hover">
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
				$last_row = $repeater;

				if (count($repeater) > 1) {
					$last_row = end($repeater);						
			}

			//var_dump($last_row);

			 //$last_row['topic_tracker_status'];
			 // $last_row['topic_tracker_status_date'];
				
				?>
				<tr>
					<td><a href="<?php the_permalink(); ?>"><?php the_field('topic_tracker_steering_number'); ?> </a> </td>
					<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </td>
					<td><?php echo $last_row['topic_tracker_status'];  ?></td>
					<td><?php  $last_row['topic_tracker_status_date'];  ?></td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
		
</div>

<?php get_footer(); ?>
