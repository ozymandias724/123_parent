<?php do_action('123_before_desktop_nav') ?>

<header class="header <?php 
		echo get_field('general-theme-invert-headerfooter-logo-colors', 'option') ? ' invertlogo' : ''; 
		echo get_field('nav-fadein-toggle', 'option') ? ' removefadein' : ''; ?>">
	

	<?php if(!get_field('remove-topbar', 'option')): ?>
		<div class="header-topbar">
			<a href="#" class="header-topbar-link"><?php echo get_field('header-bar-text', 'option'); ?></a>
		</div>
	<?php endif; ?>


	<div class="header-content">

		<a href="<?php echo site_url(); ?>" class="header-content-logo">
			<img alt="<?php echo bloginfo('sitename') ?>" src="<?php echo get_logo(); ?>" class="header-content-logo-image">
		</a>
		
		<div class="header-content-rightwrap">
			<?php 
				$desktop_social = '<nav class="header-content-menus-social">
					<ul class="header-content-menus-social-menu">
						<li class="header-content-menus-social-menu-item">
							<a href="tel:' . get_the_phone('tel') . '" class="header-content-menus-social-menu-item-link">' . get_the_phone() . '</a>
						</li>
					</ul>
				</nav>';
			 ?>
			<div class="header-content-menus">
				<?php 
					echo apply_filters( '123_social_menus_desktop_nav', $desktop_social );
				 ?>
				<nav class="header-content-menus-pages">
					<?php render_active_pages_menu('header-content-menus-pages-menu'); ?>
				</nav>
			</div>
		
			<?php 
				if( !get_field('quickquote-disable', 'option') ): 
					$quickquote_desktop = '<a href="#" data-scroll-ignore class="header-content-quickquote estimate-toggle button-quote">' . get_field('quickquote-button-text', 'option') . '</a>';
					echo apply_filters( '123_quickquote_desktop_nav', $quickquote_desktop );
				endif; 
			?>
		</div>
	</div>
	<div class="header-tint<?php echo get_field('remove-topbar', 'option') ? ' topbar-removed' : ''; ?>"></div>
</header>
<?php do_action('123_after_desktop_nav') ?>