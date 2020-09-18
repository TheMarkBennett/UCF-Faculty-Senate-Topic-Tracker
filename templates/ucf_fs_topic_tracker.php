<?php get_header(); the_post(); ?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">
	
		<?php the_content(); ?>
		<?php ucf_fs_issue_template_topic_info(); ?>
		<?php ucf_fs_issue_template_topic_status(); ?>		
	</div>
</article>

<?php get_footer(); ?>
