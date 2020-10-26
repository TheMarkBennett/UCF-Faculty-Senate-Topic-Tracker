<?php
/*
* Topic information template
*/



function ucf_fs_issue_template_topic_info() {
?>
<div class="jumbotron mt-5">
			<h2 class="mb-5">Topic Information</h2>
			<div class="row">
				<div class="col-md-4">					
					<div class="topic-info-item mb-4">
						<div class="h6 mb-0">Current Status:</div>
						<div>
							<?php
								$repeater = get_field('topic_tracker_status_update');
								$last_row = end($repeater);
								echo $last_row['topic_tracker_status']['label'];
							?>
						</div>
					</div>
					<div class="topic-info-item mb-4">
						<div class="h6 mb-0">Date of last status:</div>
						<div class="">
							<?php
								$repeater = get_field('topic_tracker_status_update');
								$last_row = end($repeater);
								echo $last_row['topic_tracker_status_date'];
							?>
						</div>						
					</div>
				</div>
				<div class="col-md-4">
					<div class="topic-info-item mb-4">
						<div class="h6 mb-0">Sterring Number</div>
						<div><?php the_field('topic_tracker_steering_number'); ?></div>
					</div>
					<div class="topic-info-item mb-4">
						<div class="h6 mb-0">Date Created:</div>
						<div><?php the_field('topic_tracker_date'); ?></div>
					</div>					
				</div>
				<div class="col-md-4">
					<div class="topic-info-item mb-4">
						<div class="h6 mb-0">Committee Assignment</div>
						<div><?php the_field('topic_tracker_committee_assignment'); ?></div>
					</div>
					<div class="topic-info-item mb-4">
						<div class="h6 mb-0">Referred By:</div>
						<div class=""><?php the_field('topic_tracker_referred_by'); ?></div>							
					</div>
				</div>
			</div>
		</div>
		<!-- End of Topic Information template -->

<?
}