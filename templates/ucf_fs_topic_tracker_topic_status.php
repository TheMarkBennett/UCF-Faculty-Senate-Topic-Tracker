<?php
/*
* Topic status updates
*/
function ucf_fs_issue_template_topic_status() {

/*
* Reverse the our of the status repeater field on the front end
*/

$statusRepeater = get_field('topic_tracker_status_update'); 
$statusOrder = array_reverse($statusRepeater);

/*
*	Status update layout with ACF repater fields using foreach
*/

if( $statusOrder ): ?>
<section class="fs-topic-status-updates mt-4"> 
	<h2 class="mb-5 mt-3" >Status Updates</h2>
	<?php foreach( $statusOrder as $i => $row ): ?>
	<div class="card pb-3">
		<div class="card-block">
			<div class="row">
				<div class="col-md-2 issue-status-info">
					<div class=" result-label text-default-aw text-uppercase small">Status</div> 
					<div class=" "><?php echo esc_html($row['topic_tracker_status']['label']); ?></div> 
				</div>
				<div class="col-md-2 issue-status-info">
					<div class=" result-label text-default-aw text-uppercase small">Date</div> 
					<div class=" "><?php echo esc_html($row['topic_tracker_status_date']); ?></div> 
				</div>
				<div class="col-md-8 issue-status-info">
					<div class=" result-label text-default-aw text-uppercase small">Notes</div> 
					<div class=" "><?php echo esc_html($row['topic_tracker_status_note']); ?></div> 
				</div>				
			</div>
		</div>
		
		
		
		
		<?php
		/*
		*	Reverse comments order
		*/
		/*
		$commentsRepeater = $row['topic_tracker_comments_list']; 
		$commentsOrder = array_reverse($commentsRepeater); 
		
		?>
		<?php if( $commentsOrder ):?>
			
		<div class="pb-3 mx-3">
			<div><a href="#" class="btn btn-outline-secondary btn-sm" style="font-size: .8em;" aria-label="View comments" data-toggle="collapse" data-target="#accordion-<?php echo $i; ?>" aria-expanded="false">View Comments</a></div>
			<div class="m-0 mt-3  py-3 collapse" id="accordion-<?php echo $i; ?>" itemscope="" itemprop="acceptedAnswer">
				<h3 class="h5">Comments</h3>
				<ul class="list-unstyled ">
				
				<?php foreach( $commentsOrder as $i => $rows ): ?>
					<li>
						<p class="small"><strong><?php echo esc_html($rows['topic_tracker_commenter']); ?> (<?php echo esc_html($rows['topic_tracker_comment_date']); ?>) - </strong> <?php echo $rows['topic_tracker_comment']; ?></p>						
					</li>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; */ ?>
 



	</div>
	<?php endforeach; ?>
</section>
<?php endif; ?>	
<?
}