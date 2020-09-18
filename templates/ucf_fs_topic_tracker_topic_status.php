<?php
/*
* Topic status updates
*/
function ucf_fs_issue_template_topic_status() {
?>

<?php if( have_rows('topic_tracker_status_update') ):?>
<section class="fs-topic-status-updates mt-4"> 
	<h2 class="mb-5 mt-3" >Status Updates</h2>
	<?php while( have_rows('topic_tracker_status_update') ) : the_row();	?>
	<div class="card pb-3">
		<div class="card-block">
			<div class="row">
				<div class="col-md-2 issue-status-info">
					<div class=" result-label text-default-aw text-uppercase small">Status</div> 
					<div class=" "><?php the_sub_field('topic_tracker_status'); ?></div> 
				</div>
				<div class="col-md-2 issue-status-info">
					<div class=" result-label text-default-aw text-uppercase small">Date</div> 
					<div class=" "><?php the_sub_field('topic_tracker_status_date'); ?></div> 
				</div>
				<div class="col-md-8 issue-status-info">
					<div class=" result-label text-default-aw text-uppercase small">Notes</div> 
					<div class=" "><?php the_sub_field('topic_tracker_status_note'); ?></div> 
				</div>				
			</div>
		</div>
		<?php if( have_rows('topic_tracker_comments_list') ):?>
		<div class="pb-3 mx-3">
			<div><a href="#" class="btn btn-outline-secondary btn-sm" style="font-size: .8em;" aria-label="View comments" data-toggle="collapse" data-target="#accordion-<?php echo get_row_index(); ?>" aria-expanded="false">View Comments</a></div>
			<div class="m-0 mt-3  py-3 collapse" id="accordion-<?php echo get_row_index(); ?>" itemscope="" itemprop="acceptedAnswer">
				<h3 class="h5">Comments</h3>
				<ul class="list-unstyled ">
				<?php while( have_rows('topic_tracker_comments_list') ) : the_row();	?>
					<li>
						<p class="small"><strong><?php the_sub_field('topic_tracker_commenter'); ?> (<?php the_sub_field('topic_tracker_comment_date'); ?>) - </strong> <?php the_sub_field('topic_tracker_comment', false); ?></p>						
					</li>
					<?php endwhile; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php endwhile; ?>
</section>
<?php endif; ?>	
<?
}