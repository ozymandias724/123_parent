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
        foreach( $fields['locations'] as $location ){
    
            $lo_fields = get_fields($location['location']->ID);
    
            print_r($lo_fields);
        }
    }
 ?>
<section id="mod_locations">
<?php 
    echo get_section_banner($res[0]->post_title);


    
 ?>
</section>
<?php 
 ?>