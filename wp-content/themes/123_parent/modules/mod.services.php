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
        ,'pagename' => 'services'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);

    $format_service = '<li><div class="image" style="background-image:url(%s);"></div></li>';
    
    $return_services_grid = '<div class="site_grid"><ul>';
    

    $args = array(
        'post_type' => 'services'
        ,'posts_per_page' => -1
    );
    $services = get_posts($args);
    foreach( $services as $service ){

        $rec_fields = get_fields($service->ID);
        
        $return_services_grid .= sprintf(
            $format_service
            ,$rec_fields['image']['url']
        );

    }

    $return_services_grid .= '</ul></div>';
    
 ?>
<section id="mod_services">
<?php 
    echo get_section_banner($res[0]->post_title);

    echo $return_services_grid;
 ?>
</section>
<?php 
 ?>