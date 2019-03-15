<?php 
/**
 *      NavHandler Class
 */
class NavHandler
{
    // Public Vars
    public $header_one = '';
    public $header_two = '';
    public $header_three = '';
    public $header_four = '';
    public $header_five = '';
    public $header_six = '';
    public $header_seven = '';
    public $header_eight = '';
    public $header_nine = '';
    public $header_ten = '';

    // Constructor
    function __construct(){
        $this->_init();
    }

    // Initialize
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
                    <a href="#" class="topbanner-quickquote">%s</a>
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
        /**
         * 
         */

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

        // 1
        $format_header = '
            <header class="%s %s %s header" id="opt_header_one">
                <div>
                    <div>
                        %s
                        <span><a href="#" class="google-search-address">%s</a></span>
                        <span>
                            <a href="tel:%s"><span>Call Us Today:</span> %s</a>
                        </span>
                    </div>
                </div>
                <div>
                    <div>
                        <nav>
                            %s  
                        </nav>
                        %s
                    </div>
                </div>
            </header>
        ';
        $this->header_one = sprintf( 
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$content_logo
            ,$addr
            ,$num_href
            ,$num_display
            ,NavUtil::get_nav_links()
            ,$content_social_icons
        );

        // 2
        $format_header = '
            <header class="header %s %s %s" id="opt_header_two">
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

        // 3
        $format_header = '
            <header class="header %s %s %s" id="opt_header_three">
                <div>
                    %s
                    <div class="header-content">
                        %s
                        %s
                    </div>
                </div>
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
    
        // 4
        $format_header = '
            <header class="%s %s %s header" id="opt_header_four">
                <div>
                    %s
                    %s
                    <span>
                        <a href="tel:%s">%s</a>
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
            ,$content_logo
            ,$num_href
            ,$num_display
            ,NavUtil::get_nav_links()
        );

        // 5
        $format_header = '
            <header class="%s %s %s header" id="opt_header_five">
                <div>
                    %s
                    <div> 
                        <span>
                            <a href="javascript:;" class="google-search-address"><i class="fa fa-map-marker"></i> %s</a>
                        </span>
                        <span>
                            <a href="tel:%s"><i class="fa fa-phone"></i> %s</a>
                        </span>
                        <a href="#" class="topbanner-quickquote">Quote</a> 
                    </div>
                </div>
                <div>
                    %s
                    <nav>
                        %s
                    </nav>
                </div>
            </header>
        ';

        $this->header_five = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$content_social_icons
            ,$addr
            ,$num_href
            ,$num_display
            ,$content_logo
            ,NavUtil::get_nav_links()
        );
        
        // 6
        $format_header = '
            <header class="%s %s %s header" id="opt_header_six">
                <div>
                    <div> 
                        <div>
                            <span>
                                <a href="tel:%s"><i class="fa fa-phone"></i> %s</a>
                            </span>
                            <span>
                                <a href="#" class="google-search-address"><i class="fa fa-map-marker"></i> %s</a>
                            </span>
                        </div>
                        %s
                    </div>
                </div>
                <div>
                    <div>
                        %s
                        <div>
                            <nav>
                                %s
                            </nav>
                            <a href="#" class="topbanner-quickquote">Get A Quote</a>
                        </div> 
                    </div>
                </div>
            </header>
        ';
        $this->header_six = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$num_href 
            ,$num_display
            ,$addr
            ,$content_social_icons
            ,$content_logo
            ,NavUtil::get_nav_links()
        );
        
        // 7
        $format_header = '
            <header class="%s %s %s header" id="opt_header_seven">
                <div> 
                    <div>
                        <div>
                            %s
                        </div>
                        %s
                        <span>
                            <a href="tel:%s"><i class="fa fa-phone"></i> %s</a>
                        </span>
                    </div> 
                    <div>
                        <nav>
                            %s
                        </nav>
                    </div>
                </div>
            </header>
        ';
        $this->header_seven = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$content_social_icons
            ,$content_logo
            ,$num_href
            ,$num_display
            ,NavUtil::get_nav_links()
        ); 

        // 8
        $format_header = '
            <header class="%s %s %s header" id="opt_header_eight">
                <div>
                    <div>
                        %s
                    </div>
                    <div>
                        <nav>
                            %s
                        </nav>
                    </div>
                </div>
            </header>
        ';
        $this->header_eight = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$content_logo
            ,NavUtil::get_nav_links()
        );
        
        // 9
        $format_header = '
        <header class="%s %s %s header" id="opt_header_nine">
            <div>
                <div> 
                    <div>
                        <span>
                            <a href="tel:%s"><i class="fa fa-phone"></i> %s</a>
                        </span>
                        <span>
                            <a href="#" class="google-search-address"><i class="fa fa-map-marker"></i> %s</a>
                        </span>
                    </div>
                    %s
                </div>
            </div>
            <div>
                <div>
                    %s
                    <div>
                        <nav>
                            %s
                        </nav>
                        <a href="#" class="topbanner-quickquote">Get A Quote</a>
                    </div> 
                </div>
            </div>
        </header>
        ';
        $this->header_nine = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$num_href 
            ,$num_display
            ,$addr
            ,$content_social_icons
            ,$content_logo
            ,NavUtil::get_nav_links()
        );
        
        // 10
        $format_header = '
            <header class="%s %s %s header" id="opt_header_ten">
                <div> 
                    <div>
                        <div>
                            <!--<a href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i></a>-->
                            <a href="javascript:;">
                                <span></span>
                                <span></span>
                                <span></span> 
                            </a>
                        </div>
                        <div> 
                            %s
                        </div>
                        %s
                    </div>
                </div>
            </header>
        ';
        $this->header_ten = sprintf(
            $format_header
            ,$invertlogo
            ,$topbar_class
            ,$fadenav
            ,$content_logo
            ,$content_social_icons
            ,NavUtil::get_nav_links()
        ); 
        
    }
}

?>