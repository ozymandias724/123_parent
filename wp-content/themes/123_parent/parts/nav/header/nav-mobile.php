<?php 

    $num_display = get_the_phone();
    $num_href = get_the_phone('tel');

    // $field_social_icons = get_field('field_akan8a8sskshb', 'options');
    $company_info = get_field('company_info','options');

    $phone_number_1 = ($company_info['phone_number_1'] ? $company_info['phone_number_1'] : '');

    $site__iconlink_phone = ''; 
    if( !empty($phone_number_1) ){
        $site__iconlink_phone .= '
            <a href="javascript:;" title="" class="site__iconlink site__iconlink-phone">'.$phone_number_1.'</a>
        ';
    }

    $hamburger_icon = '<a href="javascript:;" title="3 Line menu icon button"><span></span><span></span><span></span></a>';
    
    $field_social_icons = $company_info['social_media'];
    if( !empty($field_social_icons) ){
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
    }

    $format_nav_mobile = '
        <header class="%s %s mobileheader" id="theme_name_maybe">
            <div>
                %s
            </div>
            <div class="mobile_header_sidebar">
                <nav>
                    %s
                    %s 
                    %s
                </nav>
            </div> 
        </header>
    ';
    
    $content_nav_mobile = sprintf(
        $format_nav_mobile
        ,$fadenav
        ,$invertlogo
        ,$hamburger_icon
        ,get_site_nav()
        ,$site__iconlink_phone
        ,$content_social_icons
    );

    echo $content_nav_mobile;    
 ?>