<?php 
/**
 * 	
 */
 ?>
<header class="header<?php 
		echo get_field('general-theme-invert-headerfooter-logo-colors', 'option') ? ' invertlogo' : ''; 
		echo get_field('nav-fadein-toggle', 'option') ? ' removefadein' : ''; ?>"
>	
<?php 
/**
 * 
 */
 ?>
<div class="superheader">
	<div class="superheader-grid">
		<div class="superheader-grid-item">
			<i class="superheader-grid-item-icon fa fa-map-marker"></i>
			<div class="superheader-grid-item-content"><?php echo get_the_address(); ?></div>
		</div>
		<div class="superheader-grid-item">
			<i class="superheader-grid-item-icon fa fa-phone"></i>
			<a href="<?php echo get_the_phone('tel') ?>" class="superheader-grid-item-content"><?php echo get_the_phone(); ?></a>
		</div>

		<?php if( !get_field('quickquote-disable', 'option') ) : ?>
			<div class="superheader-grid-item" id="quickquoteC2A">
				<div class="superheader-grid-item-button button-quote estimate-toggle">
					<span><?php the_field('quickquote-button-text', 'option') ?></span><i class="fa fa-angle-right"></i>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php 
/**
 * 	If the "click for a free estimate" topbar is not disabled, render it
 */
// if( !get_field('remove-topbar', 'option') ) :
 ?>
<!-- <div class="header-topbar">
	<a href="#" class="header-topbar-link"><?php // echo get_field('header-bar-text', 'option'); ?></a>
</div> -->
<?php 
// endif;
 ?>

<div class="header-content">
	<a href="<?php echo site_url(); ?>" class="header-content-logo">
		<?php 
			if( get_field('add_extra_theme_colors_header-logotoggle', 'option') ){
				$toggle_css_filter = "filter: none; -webkit-filter: none;";
			} else {
				$toggle_css_filter = "";
			}
		 ?>
		<img
			<?php if( !empty($toggle_css_filter)) : ?>
				style="<?php echo $toggle_css_filter; ?>"
			<?php endif; ?>
			alt="<?php echo bloginfo('sitename') ?>" 
			src="<?php echo get_logo(); ?>" 
			class="header-content-logo-image"
		>
	</a>
	
	<?php NavUtil::render_nav_links('header-content-pages'); ?>
	
	<?php 
	/**
	 * 	If the QuickQuote (header / estimate pop up)
	 */
		if( get_field('quickquote-disable', 'option') == true ): 
			$quickquote_desktop = '<a href="#" class="header-content-quickquote estimate-toggle">' . get_field('quickquote-button-text', 'option') . '</a>';
		endif; 
	?>
	<!-- Fading Tint -->
	<div class="header-tint<?php echo get_field('remove-topbar', 'option') ? ' topbar-removed' : ''; ?>"></div>
</div>
	
</header>

<?php do_action('123_after_desktop_nav') ?>