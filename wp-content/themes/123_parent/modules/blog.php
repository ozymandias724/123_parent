<?php 
/**
 * 	Render Blog Module if Active
 */
if (Pagedata::is_active_page('blog')) :
?>
<main class="blog main" id="blog">
	
    <?php include( get_template_directory() . '/partials/banner.php'); ?>

    
	<section class="fade fade-in  blog-blog">
		<?php 
		$the_query = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => 1,
		));
		if($the_query->have_posts()) : ?>
		<div class="blog-blog-grid">
			<?php while($the_query->have_posts()): $the_query->the_post();  ?>
			<div class="blog-blog-grid-item">
				<div class="blog-blog-grid-item-textcontainer">
					<a href="<?php echo get_permalink(); ?>" class="blog-blog-grid-item-textcontainer-header"><?php echo $post->post_title; ?></a>
					<div class="blog-blog-grid-item-textcontainer-date"><?php echo 'Posted on: ' . date('M jS Y', strtotime($post->post_date)); ?></div>
					
					<div class="blog-blog-grid-item-textcontainer-description">
						<?php echo get_the_excerpt( $post->ID ); ?>
					</div>
					
					<div class="blog-blog-grid-item-socialcontainer">
						<h3 class="blog-blog-grid-item-socialcontainer-header">Share:</h3>
						<?php
							include locate_template( 'modules/sub-modules/social-icons.php' );
					 	 ?>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		
		<?php get_template_part('partials/navigation/blog', 'sidebar'); ?>

		<?php endif; ?>
		<a href="<?php echo site_url('blog'); ?>" class="blog-blog-seemore global-recentposts-viewall button-viewall">View All</a>
	</section>
	
</main>
<?php endif; ?>