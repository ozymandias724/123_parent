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
        ,'pagename' => 'about'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);

    // 
    // 
    // 

    $format_staff_member = '<li><div class="image" style="background-image:url(%s);" /></li>';
    
    $return_staff_grid = '<div><ul>';
    
    // foreach( $fields['staff_members'] as $rec ){

    //     $rec_fields = get_fields($rec['staff_member']->ID);
        
    //     $return_staff_grid .= sprintf(
    //         $format_staff_member
    //         ,$rec_fields['image']['url']
    //     );

    // }

    $return_staff_grid .= '</ul></div>';
    
 ?>
<section id="mod_about">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_staff_grid;
    
 ?>
</section>
<?php 
 ?>