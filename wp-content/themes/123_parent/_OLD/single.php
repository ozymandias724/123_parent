<?php 
if ( !Pagedata::is_active_page('blog') ) {
	header( "Location: " . site_url() . "/404.php" );
}
	get_header(); 

	$formatted_date = date('g:i A', strtotime(get_the_date()));
?>

<main class="single">
	<?php 
	/**
	 * 	Single Hero
	 */
	 ?>
	<section class="single-hero" style="background-image: url('<?php echo get_blog_image($post->ID); ?>');">
		
		<div class="single-hero-tint"></div>
	</section>

	<?php 
	/**
	 * 	Single Content
	 */
	 ?>
	<section class="single-single section">
		<h1 class="single-single-title h1"><?php the_title(); ?></h1>
		<p class="single-single-date"><?php echo 'Posted on: ' . date('n/j/Y', strtotime(get_the_date())) . ' at ' . $formatted_date0; ?></p>
		<div class="single-single-content"><?php echo apply_filters('the_content', $post->post_content); ?></div>

		<?php get_template_part('partials/navigation/blog', 'sidebar'); ?>
		
		<div class="single-single-socialcontainer"><?php include locate_template( 'modules/sub-modules/social-icons.php' ); ?></div>
	</section>
</main>
<?php get_footer(); ?>