<?php 
	do_action( '123_before_mobile_nav' );
 ?>
<header class="mobileheader <?php echo get_field('general-theme-invert-headerfooter-logo-colors', 'option') ? ' invertlogo' : ''; echo get_field('nav-fadein-toggle', 'option') ? ' removefadein' : ''; ?>">
	
	<div class="mobileheader-bar">
		<a href="<?php echo site_url(); ?>" class="mobileheader-bar-logo">
			<img src="<?php echo get_logo(); ?>" class="mobileheader-bar-logo-image">
		</a>
		<a class="mobileheader-bar-menutoggle">
			<i class="mobileheader-bar-menutoggle-icon fa fa-bars"></i>
		</a>
	</div>
	<div class="mobileheader-menus">
		<nav class="mobileheader-menus-pages">
			<?php NavUtil::render_nav_links('mobileheader-menus-pages-menu'); ?>
		</nav>
		<nav class="mobileheader-menus-contact">
			<a href="tel:<?php echo get_the_phone('tel'); ?>" class="mobileheader-menus-contact-phone"><?php echo get_the_phone(); ?></a>
		</nav>
		<nav class="mobileheader-menus-social">
			<?php include locate_template( 'modules/sub-modules/social-icons.php' ); ?>
		</nav>
	</div>
	
	<!-- Background -->
	<div class="mobileheader-bar-tint"></div>
	<!-- Overlay -->
	<div class="mobileheader-tint"></div>
</header>
<?php do_action( '123_after_mobile_nav' ); ?>