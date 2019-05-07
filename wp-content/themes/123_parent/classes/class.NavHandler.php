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
        
        $popups = get_field('popups','options');
        
        // get header field group
        $header = get_field('header','options');

        // check if fade-in nav is enabled
        $fadenav = '';
        if( !empty($header['fade_background']) ){
            $fadenav = 'site__fadenav';
        }
        
        // look for a 'custom logo'
        $content_logo = '';
        // if we have a custom logo
        // if( !empty($header['logo']) ){
        if( !empty( get_theme_mod( 'custom_logo' ) ) ){
            // $logo_src = wp_get_attachment_image_src($header['logo']['id'])[0];
            // $logo_src = wp_get_attachment_image_src($header['logo']['id'])[0];
            $logo_srcset = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ));
            $logo_srcset = wp_get_attachment_image_srcset(get_theme_mod( 'custom_logo' ));
            $format_logo = '
                <a class="header-logo" href="%s" title="Logo button">
                    <img src="%s" srcset="%s" alt="%s">
                </a>
            ';
            $content_logo .= sprintf(
                $format_logo
                ,site_url()
                ,$logo_src
                ,$logo_srcset
                ,get_bloginfo('sitename')
            );
        }
        
        $hamburger_icon = '<a class="site__bars" href="javascript:;" title="3 Line menu icon button"><span></span><span></span><span></span></a>';

        // get company info field group
        $company_info = get_field('company_info','options');
        // get company info fields
        $location = ($company_info['location'] ? $company_info['location'] : '');
        $company_address = $location['address_street'] . ' ' . $location['address_street_2'] . '<br/>' . $location['address_city'] . ', ' . $location['address_state'] . ', ' . $location['address_postcode'] . '<br/>' . $location['address_country'];
        $phone_number_1 = ($company_info['phone_number_1'] ? $company_info['phone_number_1'] : '');
        $phone_number_2 = ($company_info['phone_number_2'] ? $company_info['phone_number_2'] : '');
        $company_email = ($company_info['email'] ? $company_info['email'] : '');
        
        // check for social media Icons
        $social_media = ($company_info['social_media'] ? $company_info['social_media'] : '');
        $content_social_icons = '';
        // if we have social media icons
        if( !empty($company_info['social_media']) ){
            $content_social_icons .= '<ul class="site__social-media">';
            $format_social_icons = '
                <li>
                    <a href="%s" title="Social icon button">
                        %s
                    </a>
                </li>
            ';
            foreach( $company_info['social_media'] as $social_icon ){
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
        }
        
        $site__iconlink_location = '';
        if( !empty($company_address) ){
            $site__iconlink_location .= '
                <a href="javascript:;" title="" class="site__iconlink site__iconlink-address">'.$company_address.'</a>
            ';
        }
        $site__iconlink_phone = ''; 
        if( !empty($phone_number_1) ){
            $site__iconlink_phone .= '
                <a href="javascript:;" title="" class="site__iconlink site__iconlink-phone">'.$phone_number_1.'</a>
            ';
        }

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

        $format_address_phone_number = '
            <span>
                %s
                %s
            </span>
        ';

        $content_address_phone_number = sprintf(
            $format_address_phone_number
            ,$site__iconlink_location
            ,$site__iconlink_phone
        );

        // theme3 pink social bar above header
        $format_socialtopbar = '
            <div id="opt__topbanner">
                <span>
                    <a href="#" alt="Address button"><i class="fas fa-map-marker-alt"></i>
                        <span>%s</span>
                    </a>
                    <a href="tel:%s" title="Phone number button">
                        <i class="fas fa-phone"></i>
                        <span>%s</span>
                    </a>
                </span>
                %s
            </div>
        ';
        $content_socialtopbar = sprintf(
            $format_socialtopbar,
            $company_address,
            $phone_number_1,
            $phone_number_1,
            $content_quotebtn
        );

        // phone iconLink
        $desktop_social = '<a href="tel:'.$phone_number_1.'" title=""><i class="fas fa-phone"></i> '.$phone_number_1.'</a>';
        
        // header popup button
        $quickquote = '';
        if( $popups['header']['status'] ){
            $quickquote = '<a href="javascript:;" class="site__button-quote" title="Get a quote button">' . $popups['header']['button_text'] . '</a>';
        }

        // banner popup
        if( $popups['banner']['status'] ){
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
         * 
         * Start Header Style 1
         * 
         */
        $format_header = '
            <header class="%s header" id="opt_header_one">
                <div>
                    %s
                    %s
                    %s
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
            ,$fadenav
            ,$content_logo
            ,$site__iconlink_location
            ,$site__iconlink_phone
            ,_get_site_nav()
            ,$content_social_icons
        );
        /**
         * 
         * End Header Style 1
         * 
         */

         
        /**
         * 
         * Start Header Style 2
         * 
         */
        $format_header = '
            <header class="header %s" id="opt_header_two">
                <div class="header-tint">  
                    %s
                    <div>
                        %s
                        <nav>
                            %s
                        </nav>
                    </div>
                    %s
                </div>
            </header>
        ';
        $this->header_two = sprintf(
            $format_header
            ,$fadenav
            ,get_custom_logo()
            ,$desktop_social
            ,_get_site_nav()
            ,$quickquote
        );
        /**
         * 
         * End Header Style 2
         * 
         */

        /**
         * 
         * Start Header Style 3
         * 
         */
        $format_header = '
            <header class="header %s" id="opt_header_three">   
                <div> 
                    %s
                    %s
                </div>
                <div class="header-content">
                    %s
                    %s
                </div>
            </header>
        ';
        $this->header_three = sprintf(
            $format_header
            ,$fadenav
            ,$content_address_phone_number
            ,$quickquote
            ,get_custom_logo()
            ,_get_site_nav()
        );
        /**
         * End Header Style 3
         */
    
        /**
         * Start Header Style 4
         */
        $format_header = '
            <header class="%s %s header" id="opt_header_four">
                <div>
                    %s
                    %s
                    %s
                </div>
                <nav>
                    %s
                </nav>
            </header>
        ';
        $this->header_four = sprintf(
            $format_header
            ,$invertlogo
            ,$fadenav
            ,$content_social_icons
            ,get_custom_logo()
            ,$site__iconlink_phone
            ,_get_site_nav()
        );
        /**
         * 
         * End Header Style 4
         * 
         */

        /**
         * 
         * Start Header Style 5
         * 
         */
        $format_header = '
            <header class="%s header" id="opt_header_five">
                <div>
                    %s
                    %s
                    %s
                    %s
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
            ,$fadenav
            ,$content_social_icons
            ,$site__iconlink_location
            ,$site__iconlink_phone
            ,$quickquote
            ,get_custom_logo()
            ,_get_site_nav()
        );
        /**
         * 
         * End Header Style 5
         * 
         */
        
        /**
         * 
         * Start Header Style 6
         * 
         */
        $format_header = '
            <header class="%s header" id="opt_header_six">
                <div> 
                    %s
                    %s
                    %s
                </div>
                <div>
                    %s
                    <nav>
                        %s
                    </nav>
                    %s
                </div>
            </header>
        ';
        $this->header_six = sprintf(
            $format_header
            ,$fadenav
            ,$site__iconlink_phone
            ,$site__iconlink_location
            ,$content_social_icons
            ,get_custom_logo()
            ,_get_site_nav()
            ,$quickquote
        );
        /**
         * 
         * End Header Style 6
         * 
         */
        
        /**
         * 
         * Start Header Style 7
         * 
         */
        $format_header = '
            <header class="%s header" id="opt_header_seven">
                <div>
                    %s
                    %s
                    %s
                </div> 
                <nav>
                    %s
                </nav>
            </header>
        ';
        $this->header_seven = sprintf(
            $format_header
            ,$fadenav
            ,$content_social_icons
            ,get_custom_logo()
            ,$site__iconlink_phone
            ,_get_site_nav()
        ); 
        /**
         * 
         * End Header Style 7
         * 
         */

        /**
         * 
         * Start Header Style 8
         * 
         */
        $format_header = '
            <header class="%s header" id="opt_header_eight">
                <div>
                    %s
                    <nav>
                        %s
                    </nav>
                </div>
            </header>
        ';
        $this->header_eight = sprintf(
            $format_header
            ,$fadenav
            ,get_custom_logo()
            ,_get_site_nav()
        );
        /**
         * 
         * End Header Style 8
         * 
         */
        
        /**
         * 
         * Start Header Style 9
         * 
         */
        $format_header = '
        <header class="%s header" id="opt_header_nine">
            <div>
                %s
                %s
                %s
            </div>
            <div>
                %s
                <nav>
                    %s
                </nav>
                %s
            </div>
        </header>
        ';
        $this->header_nine = sprintf(
            $format_header
            ,$fadenav
            ,$site__iconlink_phone
            ,$site__iconlink_location
            ,$content_social_icons
            ,get_custom_logo()
            ,_get_site_nav()
            ,$quickquote
        );
        /**
         * 
         * End Header Style 9
         * 
         */
        
        /**
         * 
         * Start Header Style 10
         * 
         */
        $format_header = '
            <header class="%s header" id="opt_header_ten">
                <div> 
                    %s
                    %s
                    %s
                </div>
                <div class="header_10_sidebar_menu"> 
                    <nav>
                        %s
                        %s
                    </nav>
                </div>
            </header>
        ';
        $this->header_ten = sprintf(
            $format_header
            ,$fadenav
            ,$hamburger_icon
            ,get_custom_logo()
            ,$content_social_icons
            ,_get_site_nav()
            ,$site__iconlink_phone
        ); 
        /**
         * 
         * End Header Style 10
         * 
         */
    }
}
?>