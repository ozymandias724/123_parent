<?php 

	/**
	 * Optional - i.e. - opt__classname
	 */
	$addr = get_master_address(); // supposedly easy to format (test plz)
	$addr = str_replace('<br>', ' - ', $addr);
	$gmap_query = '#'; // simple href to search for the addr
	$num_display = get_the_phone();
	$num_href = get_the_phone('tel');

	$content_quotebtn = '';
	if (!get_field('quickquote-disable', 'option')) {
		$format_quotebtn = '
				<a href="#" class="topbanner-quickquote">
					<span>%s</span>
					<i class="fa fa-angle-right"></i>
				</a>
			';
		$content_quotebtn = sprintf(
			$format_quotebtn,
			get_field('quickquote-button-text', 'option')
		);
	}
	$format_socialtopbar = '
			<div id="opt__topbanner">
				<a href="%s" alt=""><i class="fa fa-map-marker"></i>
					<span>%s</span>
				</a>
				<a href="%s">
					<i class="fa fa-phone"></i>
					<span>%s</span>
				</a>
				%s
			</div>
		';
	$content_socialtopbar = sprintf(
		$format_socialtopbar,
		$gmap_query,
		$addr,
		$num_href,
		$num_display,
		$content_quotebtn
	);

	/**
	 * Phone Num above nav links
	 */
	$desktop_social = '
		<a href="tel:' . get_the_phone('tel') . '" class="header-content-menus-social-menu-item-link">' . get_the_phone() . '</a>
	';

	if (!get_field('quickquote-disable', 'option')) :
		$quickquote_desktop = '<a href="#" data-scroll-ignore class="header-content-quickquote estimate-toggle button-quote">' . get_field('quickquote-button-text', 'option') . '</a>';
	endif;
	
	/**
	 * Header Classes
	 */
	$invertlogo = ( get_field('general-theme-invert-headerfooter-logo-colors', 'option') ) ? ' invertlogo' : '';
	$fadenav = ( get_field('nav-fadein-toggle', 'option') ) ? ' removefadein' : '';
	
	/**
	 * Optional "Top Bar" (click here for free estimate)
	 */
	$remove_topbar = get_field('remove-topbar', 'option');
	$topbar_class = get_field('remove-topbar', 'option') ? ' topbar-removed' : '';
	if(!get_field('remove-topbar', 'option') && !empty( get_field('header-bar-text', 'option') ) ){
		$topbar_text = get_field('header-bar-text', 'option');
		$format_topbar = '
			<div class="opt__estimatebar">
				<a href="">%s</a>
			</div>
		';
		$content_topbar = sprintf(
			$format_topbar
			,$topbar_text
		);
	}
	/**
	 * Logo
	 */
	$format_logo = '
		<a class="header-content-logo" href="%s">
			<img src="%s" alt="%s" class="header-content-logo-image">
		</a>
	';
	$content_logo = sprintf(
		$format_logo
		,site_url()
		,get_logo()
		,get_bloginfo('sitename')
	);



	/**
	 * check which style header to display
	 */
	$headerstyle = get_field('enable-choose-header', 'options');

	if( !empty($headerstyle) ){
		if( $headerstyle == 'one' ){}
		
		
		if( $headerstyle == 'two' ){
	
		}
		if( $headerstyle == 'three' ){}
	}
	
	/**
	 * Final Header
	 */
	$format_header = '
		<header class="header %s %s">
			%s
			<div class="header-content">
				%s
				<div>
					<div>
						%s
						<nav>
							%s
						</nav>
					</div>
					%s
				</div>
			</div>
			<div class="header-tint %s"></div>
		</header>
	';
	$content_header = sprintf(
		$format_header
		,$invertlogo
		,$fadenav
		,$content_topbar
		,$content_logo
		,$desktop_social
		,NavUtil::get_nav_links('header-content-menus-pages-menu')
		,$quickquote_desktop
		,$topbar_class
	);

	// Print
	echo $content_header;
?>