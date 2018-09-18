<?php 
	if( get_field('navs-bg-toggle', 'option') ):
		$color = get_field('navs-bg', 'option');
		?>
		<style type="text/css">
			header.light .header-tint,
			header .header-tint,
			header.light .mobileheader-bar-tint, 
			header.light .mobileheader-tint,
			header .mobileheader-bar-tint, 
			header .mobileheader-tint,
			footer.mobilefooter.light,
			footer.mobilefooter,
			footer.footer.light,
			footer.footer,
			.footer-copyright{
				background-color: <?php echo $color ?>;
			}

			.header-pagesmenu-pagelinks,
			.header-pagesmenu-pagelinks:before,
			.header-pagesmenu-pagelinks:after {
				background-color: <?php echo $color ?> !important;
			}

		</style>
		<?php
	endif;

	if( get_field('navs-text-toggle', 'option') ):
		$color = get_field('navs-text', 'option');
		?>
		<style type="text/css">
			.footer-contactlinks-email, 
			.footer-contactlinks-address,
			.footer-contactlinks-fax, 
			.footer-contactlinks-phone,
			.footer-pagelinks-item-link,
			.footer-pagelinks:before, 
			.footer-pagelinks:after,
			.footer-webxlink div,
			.header-content-menus-pages-menu-item-link,
			.header-content-menus-social-menu-item-link,
			.header-content-menus-social-menu-item:last-of-type 
			.header-content-menus-social-menu-item-link,
			.mobilefooter-contactlinks-address,
			.mobilefooter-contactlinks-email, 
			.mobilefooter-contactlinks-fax, 
			.mobilefooter-contactlinks-phone,
			.mobilefooter-pagelinks-item-link,
			.mobilefooter-copyright,
			.footer-copyright,
			.mobilefooter-copyright a,
			.mobileheader-menus-pages-menu-item-link,
			.mobileheader-menus-contact-email, 
			.mobileheader-menus-contact-phone,
			.footer-section-heading,
			.footer-section-heading:after,
			.mobileheader-menus-social-menu-item-link-icon
			{ 
				border-color: <?php echo $color; ?>;
				color: <?php echo $color; ?>;
			}
			
			/* Theme 4 */
			.footer-contactlinks-phone,
			.footer-contactlinks-fax,
			.footer-contactlinks-address,
			.footer-pagelinks-item-link,
			.header-pagesmenu-pagelinks-item-link {
				color: <?php echo $color; ?> !important;
			}
			

		</style>
		<?php
	endif;

	if( get_field('buttons-underlines-toggle', 'option') ):
		$color = get_field('buttons-underlines', 'option');
		?>	
			<style type="text/css">
				.main .hero-text-header:after,
				.header-content-quickquote,
				a.blog-blog-sidebar-quickquote,
				.global-recentposts-viewall,
				.sociallink,
				.contact-contact-left-locations-header:after,
				.gform_footer input[type='submit'],
				.footer-sociallinks-item,
				.mobilefooter-sociallinks-item,
				.company-employees-grid-item-socialcontainer-link,
				.home-hero-text-button,
				.global-contact-content-button,
				.home-services-viewall,
				.home-testimonials-viewall
				{
					border-color: <?php echo $color; ?>;
					background-color: <?php echo $color; ?>;
				}

				.blog-blog-sidebar-recentposts-header, 
				.blog-blog-sidebar-archive-header, 
				.global-recentposts-header,
				.section-header,
				.section-header:after,
				.global-recentposts-grid-item-header:after,
				.blog-blog-sidebar-categories-header{
					border-color: <?php echo $color; ?>;	
				}
				/* Accent as the Hover for Buttons */
				.footer-sociallinks-item:hover,
				.sociallink:hover,
				.blog-blog-grid-item-socialcontainer-link.sociallink:hover,
				.company-employees-grid-item-socialcontainer-link:hover {
					background-color: <?php echo $color; ?>;
				}
				/* read more (hover was pink)*/
				.global-recentposts-grid-item-link:hover {
					color: <?php echo $color; ?>;
				}
				/* ... */
				.superheader,
				.home-quickquote-wrapper-right-button,
				.gform_footer input[type='submit'],
				.mobileheaderquote {
					background-color: <?php echo $color; ?>;
				}
				.section-header:after,
				.global-recentposts-grid-item-header:before,
				.services-services-grid-item-header:after,
				.contact-contact-left-locations-header:after,
				.blog-blog-grid-item-textcontainer-header:after,
				.blog-blog-sidebar-archive-header:after,
				.blog-blog-sidebar-categories-header:after,
				.blog-blog-sidebar-recentposts-header:after,
				.gallery-galleries-gallery-header:after {
					border-bottom: 6px solid <?php echo $color; ?>;
				}
				.home-testimonials-grid-item-quotemark,
				.global-recentposts-grid-item-link:after,
				.global-recentposts-viewall:after,
				.global-contact-content-button:after,
				.testimonials-testimonials-grid-item-quotemark,
				/*'angle-right' w/ default accent color */
				.home-areasserved-map-learnmore i,
				div.superheader-grid-item-button i,
				.home-areasserved-map-learnmore i,
				.home-services-viewall i,
				.home-testimonials-viewall i,
				.home-cover-content-button i,
				.mobileheaderquote-wrapper-button i {
					color: <?php echo $color; ?>;
				}
				
				/* Theme 4 */
				.button-viewall,
				.gform_button,
				.estimate-toggle {
					background-color: <?php echo $color; ?> !important;
				}
				/* Theme 4 (social icons are 'buttons/links') */
				.sociallinks-item {
					background-color: <?php echo $color; ?> !important;
				}
				/* Theme 4 other misc. 'buttons/links' for consistency */
				.coupons-coupons-grid-item-textcontainer-print,
				.contact-contact-left-locations-location-getdirections {
					background-color: <?php echo $color; ?> !important;
				}
				.blog-blog-sidebar-list-item-link:hover,
				.blog-blog-sidebar-header {
					border-color:  <?php echo $color; ?> !important;
				}
			</style>
		<?php
	endif;

	/**
	 *	"Section Header Text"
	 */
	if( get_field('bold-title-text-toggle', 'option') ):
		$color = get_field('bold-title-text', 'option');?>

		<style type="text/css">
			.section-header{
				color: <?php echo $color ?>;
			}
			.hero-text-header:not(.home-hero-text-header) {
				color: <?php echo $color ?> !important;
			}
			<?php if( wp_get_theme()->get('Name') == '123 - Parent' ): ?>
				.hero-text-header{
					color: <?php echo $color ?> !important;
					
				}
				.hero-text-header:after {
					border-color: <?php echo $color ?> !important;
					
				}
			<?php endif; ?>

	

			/* Theme 4 */
			.footer-section-heading{
				color: <?php echo $color ?> !important;
			}
			.footer-section-heading:after {
				border-color:  <?php echo $color; ?> !important;
			}




		</style>

	<?php
	endif;



	if( get_field('sidebar-coupon-areasserved-bg-toggle', 'option') ):
		$color = get_field('sidebar-coupon-areasserved-bg', 'option'); ?>
			<style type="text/css">
				.blog-blog-sidebar,
				.coupons-coupons-grid-item,
				.areas-served-areas-grid-imagecontainer-citystate{
					background-color: <?php echo $color; ?>;
				}
				/* New Field */
				.home-areasserved-map-learnmore,
				.mobileheaderquote-wrapper-button,
				.global-contact-content-button,
				.gform_footer input[type='submit'],
				 a.global-recentposts-viewall,
				 div.superheader-grid-item-button,
				 a.blog-blog-sidebar-quickquote,
				.home-cover-content-button,
				.footer-sociallinks-item,
				.blog-blog-grid-item-socialcontainer-link.sociallink,
				.mobilefooter-sociallinks-item,
				.company-employees-grid-item-socialcontainer-link {
					background-color: <?php echo $color; ?>;
				}
				.superheader-grid-item-icon,
				.mobileheaderinfo-grid-item-left,
				.mobileheader-menus-social-menu-item-link i,
				.mobileheader-bar-menutoggle-icon {
					color: <?php echo $color; ?>;
				}
				/* Hack Harder...*/
				.home-services-viewall,
				.home-testimonials-viewall {
					background-color: <?php echo $color; ?> !important;
				}
			</style>
		<?php
	endif;

	if( get_field('top-bottom-bg-toggle', 'option') ) :
		$color = get_field('top-bottom-bg', 'option');?>
			<style type="text/css">
				.header-topbar,
				.footer-copyright{
					background-color: <?php echo $color ?>;
				}
			</style>
		<?php
	endif;

	if (get_field('add_extra_theme_colors_button-texttoggle', 'option') ) : 
		$color = get_field('add_extra_theme_colors_button-textpicker', 'option');
		?>
		<style type="text/css">
			/* All the 'Button Background' elements should have 'Button Color' here*/
			.superheader-grid-item-content,
			.home-areasserved-map-learnmore,
			.home-quickquote-wrapper-right-button,
			.mobileheaderquote-wrapper-button,
			.home-services-viewall,
			.home-testimonials-viewall,
			.global-contact-content-button,
			.gform_footer input[type='submit'],
			 a.global-recentposts-viewall,
			 div.superheader-grid-item-button,
			 a.blog-blog-sidebar-quickquote,
			.home-cover-content-button.estimate-toggle,
			.home-areasserved-map-learnmore,
			.home-areasserved-map-learnmore i {
				color: <?php echo $color; ?>;
			}
			/* FontAwesome Icons*/
			.footer-sociallinks-item-link-icon,
			.company-employees-grid-item-socialcontainer-link-icon,
			.footer-sociallinks-item-link-icon:before,
			.mobilefooter-sociallinks-item-link-icon,
			.mobilefooter-sociallinks-item-link-icon:before,
			.sociallink-icon {
				color: <?php echo $color; ?>;
			}
			/* New Field */

			.mobilefooter-logo-text,
			.mobilefooter-copyright p,
			.mobilefooter-contactlinks-phone,
			.mobilefooter-contactlinks-address,
			.mobilefooter-contactlinks-fax,
			.mobilefooter-copyright-tclink,
			.mobilefooter-copyright a,
			.mobilefooter-copyright span,
			.mobilefooter-pagelinks-item-link,
			/*desktop*/
			.footer-copyright,
			.footer-copyright a,
			.footer-copyright span,
			.footer-contactlinks-address,
			.footer-contactlinks-phone,
			.footer-contactlinks-fax,
			.footer-pagelinks-item-link,
			.mobilefooter-contactlinks-phone,
			.mobilefooter-copyright-tclink,
			.footer-pagelinks-item-link,
			.footer-contactlinks-phone {
				color: <?php echo $color; ?>;
			}
			/* Target new ChildTheme elements*/
			.mobile-footer-logo-text,
			.footer-logo-text {
				color: <?php echo $color; ?>;
			}
		</style>
		<?php
	endif;

	if (get_field('add_extra_theme_colors_footer-headerstoggle', 'option') ) : 
		$color = get_field('add_extra_theme_colors_footer-headerspicker', 'option');
		?>
		<style type="text/css">
			.mobilefooter-section-heading {
				color: <?php echo $color; ?>;
			}
			h2.mobilefooter-section-heading:after{
				border-color:<?php echo $color; ?>;
			}
			.mobilefooter-section-heading {
				color: <?php echo $color; ?>;
			}
			h2.mobilefooter-section-heading:after{
				border-color:<?php echo $color; ?>;
			}
		</style>
		<?php
	endif;