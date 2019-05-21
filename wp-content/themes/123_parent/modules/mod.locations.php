<?php 
/**
 * Module: Areas Served (Locations)
 * 
 * Description:
 * 
 */
    // get the page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'locations'
    );
    $res = get_posts($args);

    // get the fields
    $fields = get_fields($res[0]);

    function _get_social_media($ID){

        $return = '<ul class="site__social-media">';
        $format = '
            <li>
                <a href="%s" title="%s">
                    %s
                </a>
            </li>
        ';
        
        $location_content = get_fields($ID);
        $social_icons = $location_content['content']['social_media'];

        if(!empty($social_icons))
        {
            foreach($social_icons['icons'] as $social_icon)
            {
                $link = (!empty($social_icon['link']) ? $social_icon['link']['url'] : '');
                $title = (!empty($social_icon['link']) ? $social_icon['link']['title'] : '');

                if(!empty($social_icon['icon']))
                {
                    $icon = (!empty($social_icon['icon']) ? $social_icon['icon'] : '');
                    $return .= sprintf(
                        $format
                        ,$link
                        ,$title
                        ,$icon
                    );
                }
                else if(!empty($social_icon['image']))
                {
                    $image = (!empty($social_icon['image']) ? '<div class="location_social_image" style="background-image:url('.$social_icon['image']['url'].');"></div>' : '');
                    $return .= sprintf(
                        $format
                        ,$link
                        ,$title
                        ,$image
                    );
                }
            }
        }
        
        $return .= '</ul>';

        return $return;
    }

    function _get_address($ID)
    {
        $return = '';
        $location_content = get_fields($ID);
        $address = (!empty($location_content['content']['address']) ? $location_content['content']['address'] : '');
        if(!empty($address))
        {
            $postal = '';
            if(!empty($address['address_is_postal']))
            {
                $is_postal = $address['address_is_postal'];
                if($is_postal)
                {
                    $postal = '<p>This is a postal address.</p>';
                }
            }  
            $street_1 = (!empty($address['address_street']) ? $address['address_street'] : '');
            $street_2 = (!empty($address['address_street_2']) ? $address['address_street_2'] : '');
            $city = (!empty($address['address_city']) ? $address['address_city'] : '');
            $state = (!empty($address['address_state']) ? $address['address_state'] : '');
            $postcode = (!empty($address['address_postcode']) ? $address['address_postcode'] : '');

            $format = '
                <div class="location_address">
                    %s
                    <p>%s %s</p> 
                    <p>%s, %s %s</p>
                </div>'; 
            $return = sprintf(
                $format
                ,$postal
                ,$street_1
                ,$street_2
                ,$city
                ,$state
                ,$postcode
            );
        }
        
        return $return; 
    }
    
    // if we have locations
    if( !empty($fields['content']['locations']) ){
        $apikey = get_gmaps_api_key();
        
        $heading = ( !empty( $fields['content']['heading'] ) ? '<h2 class="site__fade site__fade-up">'.$fields['content']['heading'].'</h2>' : '');
        $details = ( !empty( $fields['content']['details'] ) ? '<div class="site__fade site__fade-up">'.$fields['content']['details'].'</div>' : '');
        
        $return_locations = '
            <section class="mod__featured_grid">
                <div class="container">
                '.$heading.'
                '.$details.'
                <div class="site__grid"><ul>
        ';
        
        $format_location = '
            <li class="site__fade site__fade-up">
                <a href="%s">
                    <div class="site__bgimg image"><div class="site__bgimg_img" style="background-image: url(%s)"></div></div>
                </a>
                <div>
                    <a class="location_heading" href="%s">
                        <p>%s</p>
                    </a>
                    %s
                    <a href="%s">
                        %s
                    </a>
                </div>
            </li>
        '; 

        foreach( $fields['content']['locations'] as $location ){

            $location_fields = get_fields($location['location']->ID);
            
            $return_locations .= sprintf(
                $format_location
                ,get_permalink($location['location']->ID)
                ,$location_fields['content']['image']['url']
                ,get_permalink($location['location']->ID)
                ,$location_fields['content']['heading']
                ,_get_social_media($location['location']->ID)
                ,get_permalink($location['location']->ID)
                ,_get_address($location['location']->ID)
            );
        }
        $return_locations .= '</ul></div>';

        $return_locations .= '
                    <a href="'.get_permalink($res[0]->ID).'" title="View all locations" class="site__button site__fade site__fade-up">View All Locations</a>
                </div>
            </section>
        ';
    }
 ?>
<section id="mod_locations">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_locations;
?>
</section>
<?php 
 ?>