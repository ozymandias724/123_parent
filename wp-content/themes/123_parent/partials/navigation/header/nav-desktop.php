<?php 
/**
 * Desktop Nav
 * 
 * Setup Stuff...
 */
    $addr = get_master_address(); // supposedly easy to format (test plz)
	$addr = str_replace('<br>', ' - ', $addr);
    $gmap_query = '#'; // simple href to search for the addr // IDK
	$num_display = get_the_phone();
    $num_href = get_the_phone('tel');
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
    // 
    // 
    $quotebtn_txt = get_field('quickquote-button-text', 'option');
    if( !empty($quotebtn_txt) ){
        $format_quotebtn = '
			<a href="#" class="topbanner-quickquote">
				<span>%s</span>
				<i class="fa fa-angle-right"></i>
			</a>
		';
		$content_quotebtn = sprintf(
			$format_quotebtn
			,$quotebtn_txt
		);
    }
    // 
    // 
    $desktop_social = '<a href="tel:'.$num_href.'" class="header-content-menus-social-menu-item-link">'.$num_display.'</a>';
    if( !empty($quotebtn_txt) ){
        $quickquote = '<a href="#" data-scroll-ignore class="header-content-quickquote estimate-toggle button-quote">' . $quotebtn_txt . '</a>';
    }
    // 
    // 
    $invertlogo = ( get_field('general-theme-invert-headerfooter-logo-colors', 'option') ) ? ' invertlogo' : '';
    $fadenav = ( get_field('nav-fadein-toggle', 'option') ) ? ' removefadein' : '';
    $topbar_class = get_field('remove-topbar', 'option') ? ' topbar-removed' : '';
    $headbar_txt = get_field('header-bar-text', 'option');
    if( !empty($topbar_class && !empty($headbar_txt) ) ){
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
    // 
    // 
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
 *  Do stuff...
 */
    // 
    // 
    $enabled_theme = wp_get_theme()->Name;
    $selected_header = get_field('choose-header-style', 'options');
    // 
    // 
    $content_header = '';

    // a custom header has been selected
    if( !empty($selected_header) )
    {

        if( $selected_header === 'one' ){
        }
        if( $selected_header === 'two' ){

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
                ,$quickquote
                ,$topbar_class
            );
        }
        if( $selected_header === 'three' ){
            $format_header = '
                <header class="header %s %s">
                    %s
                    <div>
                        <div>
                        </div>
                    </div>
                </header>
            ';
            
            $content_header = sprintf(
                $format_header
                ,$invertlogo
                ,$fadenav
                ,$content_socialtopbar
                ,$content_logo
                
            );
        }
        if( $selected_header === 'four' ){}
    }
    // no custom header is selected
    else
    {

        if( $enabled_theme === "123_parent"){}
        if( $enabled_theme === "123_one"){}
        if( $enabled_theme === "123_two"){}
        if( $enabled_theme === "123_three"){}
        if( $enabled_theme === "123_four"){}
    }


    
    echo $content_header;


    
    die();
 ?>