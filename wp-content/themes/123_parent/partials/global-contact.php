<?php 
	if ( Pagedata::is_active_page('contact') ) :
 ?>
<section class="global-contact section" style="background-image: url('<?php echo get_field('contact-bg', 'option'); ?>')">
	<div class="global-contact-content">
		<h2 class="global-contact-content-header"><?php echo get_field('general-contact-slogan', 'option'); ?></h2>	
		<a href="<?php echo site_url(); ?>/contact" class="global-contact-content-button">Contact</a>
	</div>
	<div class="global-contact-tint"></div>
</section>
<?php endif; ?>