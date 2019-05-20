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
                    <p>%s</p>
                </a>
            </li>
        ';

        foreach( $fields['content']['locations'] as $location ){

            $location_fields = get_fields($location['location']->ID);
            
            $return_locations .= sprintf(
                $format_location
                ,get_permalink($location['location']->ID)
                ,$location_fields['content']['image']['url']
                ,$location_fields['content']['heading']
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