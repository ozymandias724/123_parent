<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */
    // get the gallery page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'locations'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);


    $args = array(
        'post_type' => 'areas-served'
        ,'posts_per_page' => -1
    );
    $locations = get_posts($args);

    foreach( $locations as $location){

        $location_fields = get_fields($location);

    }

    
 ?>
<section id="mod_locations">
<?php 
    echo get_section_banner($res[0]->post_title);
 ?>
</section>
<?php 
 ?>