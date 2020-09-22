<?php get_header(); the_post(); ?>


<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">
	<div class="row">
		<div class="col-md-9 content-area" id="primary">
			<article class="<?php echo $post->post_status; ?> post-list-item">
				
					<?php the_content(); ?>
					<?php ucf_fs_issue_template_topic_info(); ?>
					<?php ucf_fs_issue_template_topic_status(); ?>		
				
			</article>
		</div>
		<div class="col-md-3 widget-area sidebar" id="right-sidebar" role="complementary">
		<?php if ( is_active_sidebar( 'topic-tracker-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'topic-tracker-sidebar' ); ?>
		<?php endif; ?>			
		</div>	
	</div>
</div>

<?php get_footer(); ?>
