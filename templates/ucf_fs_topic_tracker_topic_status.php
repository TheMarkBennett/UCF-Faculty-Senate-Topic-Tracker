<?php
/*
* Topic status updates
*/
function ucf_fs_issue_template_topic_status() {

/*
* Reverse the our of the status repeater field on the front end
*/

$statusRepeater = get_field('topic_tracker_status_update'); 
if($statusRepeater){
$statusOrder = array_reverse($statusRepeater);
}

/*
*	Status update layout with ACF repater fields using foreach
*/

if( isset($statusOrder) ): ?>
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
		


	</div>
	<?php endforeach; ?>
</section>
<?php endif; ?>	
<?
}