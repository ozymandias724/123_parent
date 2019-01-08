<?php 
/**
 * Desktop Nav
 * 	
 */

	$invert_toggle_class = get_field('general-theme-invert-headerfooter-logo-colors', 'option') ? ' invertlogo' : '';
 ?>
<header class="header<?php echo $invert_toggle_class; echo get_field('nav-fadein-toggle', 'option') ? ' removefadein' : ''; ?>">
	
	<!-- socials logo phonenumber -->
	<div class="header-clientinfo">
		<div class="header-clientinfo--wrapper">
			<div class="header-clientinfo-sociallinks">
				<?php include locate_template( 'modules/sub-modules/social-icons.php' ); ?>
			</div>

			<a href="<?php echo site_url(); ?>" class="header-clientinfo-logo">
				<img alt="<?php echo bloginfo('sitename') ?>" src="<?php echo get_logo(); ?>" class="header-clientinfo-logo-image">
			</a>
			
			<a class="header-clientinfo-phone" href="tel:<?php echo get_the_phone('tel'); ?>"><?php echo get_the_phone(); ?></a>
		</div>
		
	</div>


	<!-- pages -->
	<nav class="header-pagesmenu">
		<?php NavUtil::render_nav_links('header-pagesmenu-pagelinks'); ?>
	</nav>
</header>