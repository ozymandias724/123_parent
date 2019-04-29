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

    if( !empty($fields['locations']) ){
        $return_maps = '';    
        foreach( $fields['locations'] as $location ){    
            $lo_fields = get_fields($location['location']->ID);
            
            $lat = $lo_fields['open_street_map']['center_lat'];
            $lng = $lo_fields['open_street_map']['center_lng'];

            $return_maps .= '<div id="mapid" style="height: 400px;" data-lat="'.$lat.'" data-lng="'.$lng.'"></div>';

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