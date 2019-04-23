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
        $gmap_query = '';
        $addr = get_master_address(); // supposedly easy to format (test plz)
        $addr = str_replace('<br>', ' - ', $addr);
        $num_display = get_the_phone();
        $num_href = get_the_phone('tel');
        $popups = get_field('popups','options');
        $footer = get_field('footer','options');
        $header = get_field('header','options');
        $company_info = get_field('company_info','options');
        $fadenav = $header['fade_background'];
        
        // needsfix
        $quotebtn_txt = $popups['banner']['bar_text'];
        if( !empty($quotebtn_txt) ){
            $format_quotebtn = '
                <a href="#" class="topbanner-quickquote" title="Get a quote button">
                    <span>%s</span>
                    <i class="fas fa-angle-right"></i>
                </a>
            ';
            $content_quotebtn = sprintf(
                $format_quotebtn
                ,$quotebtn_txt
            );
        }
        // /needsfix

        // theme3 pink social bar above header
        $format_socialtopbar = '
            <div id="opt__topbanner">
                <span>
                    <a href="%s" alt="Address button"><i class="fas fa-map-marker-alt"></i>
                        <span>%s</span>
                    </a>
                    <a href="%s" title="Phone number button">
                        <i class="fas fa-phone"></i>
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


        // phone iconLink
        $desktop_social = '<a href="tel:'.$num_href.'" title=""><i class="fas fa-phone"></i> '.$num_display.'</a>';
        
        // header popup button
        $quickquote = '';
        if( $popups['header']['status'] ){
            $quickquote = '<a href="#" class="site__button-quote" title="Get a quote button">' . $popups['header']['button_text'] . '</a>';

        }

        // banner popup
        $topbar_class = 'topbar-removed';
        if( $popups['banner']['status'] ){
            $topbar_class = '';
            $topbar_text = $popups['banner']['bar_text'];
            $format_topbar = '
                <div class="opt__estimatebar">
                    <a href="#" class="topbanner-quickquote" title="Get a quote button">%s</a>
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
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_img = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        $format_logo = '
            <a class="header-logo" href="%s" title="Logo button">
                <img src="%s" alt="%s">
            </a>
        ';
        $content_logo = sprintf(
            $format_logo
            ,site_url()
            ,$logo_img
            ,get_bloginfo('sitename')
        );

        /**
         * 
         */

        // $field_social_icons = get_field('field_akan8a8sskshb', 'options');
        $field_social_icons = $company_info['social_media'];
        $content_social_icons = '<ul>';
        $format_social_icons = '
            <li>
                <a href="%s" title="Social icon button">
                    %s
                </a>
            </li>
        ';
        foreach( $field_social_icons as $social_icon ){
            $url = $social_icon['url'] ;
            $img = $social_icon['image'];
            $fa = $social_icon['icon'];
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
                    $fa_icon = '<i class="fab '.$fa.'"></i>';
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
            <header class="%s %s header" id="opt_header_one">
                <div>
                    <div>
                        %s
                        <span><a href="javascript:;" class="google-address" title="Address button">%s</a></span>
                        <span>
                            <a href="tel:%s" title="Phone number button"><span>Call Us Today:</span> %s</a>
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
            ,$topbar_class
            ,$fadenav
            ,get_custom_logo()
            ,$addr
            ,$num_href
            ,$num_display
            ,_get_site_nav()
            ,$content_social_icons
        );

        // 2
        $format_header = '
            <header class="header %s %s %s" id="opt_header_two">
                %s
                <div> 
                    <div class="header-tint">  
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
                </div>
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
            ,_get_site_nav()
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
            ,_get_site_nav()
            ,$topbar_class // NOPE
        );
    
        // 4
        $format_header = '
            <header class="%s %s %s header" id="opt_header_four">
                <div>
                    <div>
                        %s
                        %s
                        <span>
                            <a href="tel:%s" title="Phone number button">%s</a>
                        </span>
                    </div>
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
            ,_get_site_nav()
        );

        // 5
        $format_header = '
            <header class="%s %s %s header" id="opt_header_five">
                <div>
                    <div>
                        %s
                        <div>  
                            <span>
                                <a href="javascript:;" class="google-address" title="Address button"><i class="fas fa-map-marker-alt"></i> %s</a>
                            </span>
                            <span>
                                <a href="tel:%s" title="Phone number button"><i class="fas fa-phone"></i> %s</a>
                            </span>
                            <a href="#" class="topbanner-quickquote" title="Get a quote button">Quote</a> 
                        </div>
                    </div>
                </div>
                <div> 
                    <div> 
                        %s
                        <nav>
                            %s
                        </nav>
                    </div>
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
            ,_get_site_nav()
        );
        
        // 6
        $format_header = '
            <header class="%s %s %s header" id="opt_header_six">
                <div>
                    <div> 
                        <div>
                            <span>
                                <a href="tel:%s"><i class="fas fa-phone" title="Phone number button"></i> %s</a>
                            </span>
                            <span>
                                <a href="javascript:;" class="google-address" title="Address button"><i class="fa fa-map-marker-alt"></i> %s</a>
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
                            <a href="#" class="topbanner-quickquote" title="Get a quote button">Get A Quote</a>
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
            ,_get_site_nav()
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
                            <a href="tel:%s"><i class="fas fa-phone" title="Phone number button"></i> %s</a>
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
            ,_get_site_nav()
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
            ,_get_site_nav()
        );
        
        // 9
        $format_header = '
        <header class="%s %s %s header" id="opt_header_nine">
            <div>
                <div> 
                    <div>
                        <span>
                            <a href="tel:%s"><i class="fas fa-phone" title="Phone number button"></i> %s</a>
                        </span>
                        <span>
                            <a href="javascript:;" class="google-address" title="Address button"><i class="fas fa-map-marker-alt"></i> %s</a>
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
                        <a href="#" class="topbanner-quickquote" title="Get a quote button">Get A Quote</a>
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
            ,_get_site_nav()
        );
        
        // 10
        $format_header = '
            <header class="%s %s %s header" id="opt_header_ten">
                <div> 
                    <div>
                        <div>
                            <a href="javascript:;" title="3 Line menu icon button">
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
                <div class="header_sidebar_menu_1">
					<div>
						<nav>
							%s
						</nav>
						<div> 
							<a href="tel:%s" title="Phone number button">%s</a>
						</div>
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
            ,_get_site_nav()
            ,$num_href
            ,$num_display 
        ); 
        
    }
}

?>