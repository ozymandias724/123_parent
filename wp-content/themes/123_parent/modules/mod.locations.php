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
    if( !empty($fields['locations']) ){
        
        $return_maps = '';    

        foreach( $fields['locations'] as $location ){    
            // get fields of this areas-served post
            $lo_fields = get_fields($location['location']->ID);            
            $lat = $lo_fields['open_street_map']['center_lat'];
            $lng = $lo_fields['open_street_map']['center_lng'];
            $title = $location['location']->post_title;
            $rad = $lo_fields['radius'];
            
            $return_maps .= '
                <div class="mod_locations-location">
                    <h3>'.$title.'</h3>
                    <div id="mapid" data-rad="'.$rad.'" data-lat="'.$lat.'" data-lng="'.$lng.'"></div>
                </div>
            ';
        }
    }
 ?>
<section id="mod_locations">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_maps;
?>
</section>
<?php 
 ?>