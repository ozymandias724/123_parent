<?php 

class NavHandler
{

    
    
    public $header_one = '';
    public $header_two = '';
    public $header_three = '';
    public $header_four = '';


    function __construct(){
        $this->_init();
    }
    function _init(){
        $gmap_query = '#'; // simple href to search for the addr // IDK
        $addr = get_master_address(); // supposedly easy to format (test plz)
        $addr = str_replace('<br>', ' - ', $addr);
        $num_display = get_the_phone();
        $num_href = get_the_phone('tel');
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
        // theme3 pink social bar above header
        $format_socialtopbar = '
            <div id="opt__topbanner">
                <span>
                    <a href="%s" alt=""><i class="fa fa-map-marker"></i>
                        <span>%s</span>
                    </a>
                    <a href="%s">
                        <i class="fa fa-phone"></i>
                        <span>%s</span>
                    </a>
                </span>
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
        $desktop_social = '<a href="tel:'.$num_href.'" class="header-content-menus-social-menu-item-link">'.$num_display.'</a>';
        if( !empty($quotebtn_txt) ){
            $quickquote = '<a href="#" class="site__button-quote">' . $quotebtn_txt . '</a>';
        }
        // 
        // 
        $invertlogo = ( get_field('general-theme-invert-headerfooter-logo-colors', 'option') ) ? ' invertlogo' : '';
        $fadenav = ( get_field('nav-fadein-toggle', 'option') ) ? ' removefadein' : '';


        // if the topbar is disabled, set the 'topbar-removed' class
        $topbar_class = get_field('remove-topbar', 'option') ? ' topbar-removed' : '';
        // Text that appears in the 'topbar'
        $topbar_text = get_field('header-bar-text', 'option');
        // if we dont the topbar removed class, and we do have text, create the topbar
        if( empty($topbar_class && !empty($topbar_text) ) ){
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
            <a class="header-logo" href="%s">
                <img src="%s" alt="%s">
            </a>
        ';
        $content_logo = sprintf(
            $format_logo
            ,site_url()
            ,get_logo()
            ,get_bloginfo('sitename')
        );

        $enabled_theme = wp_get_theme()->Name;
        $use_custom_header = get_field('enable-choose-header', 'options');
        $selected_header = get_field('choose-header-style', 'options');
        $content_header = '';
        $format_header = '';


        $field_social_icons = get_field('field_akan8a8sskshb', 'options');
        $content_social_icons = '<ul>';
        $format_social_icons = '
            <li>
                <a href="%s">
                    %s
                </a>
            </li>
        ';
        foreach( $field_social_icons as $social_icon ){
            $url = $social_icon['url'] ;
            $img = $social_icon['image'];
            $fa = $social_icon['fonticon'];
            $custom_png_url = '';
            // we have a preconfigured URL
            if( strpos($url, 'booksy') ){
                $custom_png_url = get_template_directory_uri() . '/library/img/social_icons/booksy.png';
            }
            if( strpos($url, 'groupon') ){
                $custom_png_url = get_template_directory_uri() . '/library/img/social_icons/groupon.png';
            }
            if( strpos($url, 'pinterest') ){
                $custom_png_url = get_template_directory_uri() . '/library/img/social_icons/pinterest.png';
            }
            if( !empty($custom_png_url) ){
                $icon_url = $custom_png_url;
            } else {
                // we have img
                if( !empty($img) ){
                    $icon_url = $img;
                }
                // img is empty, we have fa
                else if( !empty($fa) ){
                    $icon_url = '';
                    $fa_icon = '<i class="fa '.$fa.'"></i>';
                }
                // img and fa are empty
                // something went wrong...
                else {
                    $icon_url = '';
                }
            }
            if( !empty($url) ){
                $content_social_icons .= sprintf(
                    $format_social_icons
                    ,$url
                    ,( !empty($icon_url) ) ? '<img src="'.$icon_url.'">' : $fa_icon
                );
            }
        }
        $content_social_icons .= '</ul>';
        $enabled_theme = wp_get_theme()->Name;
        $use_custom_header = get_field('enable-choose-header', 'options');
        $selected_header = get_field('choose-header-style', 'options');


        $format_header = '
            <header class="header %s %s %s" id="opt_header_onetwo">
                %s
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
                <span class="header-tint %s"></span>
            </header>
        ';

        $this->header_two = sprintf(
            $format_header
            ,$invertlogo
            ,$fadenav
            ,$topbar_class
            ,$content_topbar
            ,$content_logo
            ,$desktop_social
            ,NavUtil::get_nav_links()
            ,$quickquote
            ,$topbar_class // NOPE
        );


        $format_header = '
            <header class="header %s %s %s" id="opt_header_three">
                %s
                <div class="header-content">
                    %s
                    %s
                </div>
                <span class="header-tint %s"></span>
            </header>
        ';
        $this->header_three = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$content_socialtopbar
            ,$content_logo
            ,NavUtil::get_nav_links()
            ,$topbar_class // NOPE
        );
    

        $format_header = '
            <header class="%s %s %s header" id="opt_header_four">
                <div>
                    %s
                    <span>
                        <a href="%s"><img src="%s" alt="%s"></a>
                    </span>
                    <span>
                        <a href="%s">%s</a>
                    </span>
                </div>
                <nav>
                    %s
                </nav>
            </header>
        ';
        $this->header_four = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$content_social_icons
            ,site_url()
            ,get_logo()
            ,get_bloginfo('sitename')
            ,$num_href
            ,$num_display
            ,NavUtil::get_nav_links()
        );


        $format_header = '
            <header class="%s %s %s header" id="opt_header_one">
                <div>
                    <a href="%s"><img src="%s" alt="%s"></a>
                    <span>
                        %s
                    </span>
                    <span>
                        <a href="%s">%s</a>
                    </span>
                </div>
                <div>
                    <nav>
                        %s
                    </nav>
                    %s
                </div>
            </header>
        ';
        $this->header_one = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,site_url()
            ,get_logo()
            ,get_bloginfo('sitename')
            ,$addr
            ,$num_href
            ,$num_display
            ,NavUtil::get_nav_links()
            ,$content_social_icons
        );
        
        
    }
}

?>