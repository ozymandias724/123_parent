<?php get_header(); ?>

<main class="page404">
	<section class="page404-hero" style="background-image: url('<?php echo get_field('general-404-bg', 'option'); ?>');">
		<div class="page404-hero-text">
			<h1 class="page404-hero-text-header">404</h1>
			<div class="page404-hero-text-description">The requested page is not available. Click <a href="<?php echo site_url(); ?>">here</a> to return home.</div>	
		</div>
		<div class="page404-hero-tint"></div>
	</section>
</main>				

<?php get_footer(); ?>