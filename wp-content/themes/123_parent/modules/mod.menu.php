<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */
    // get the menu page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'menu'
    );
    $res = get_posts($args);

    // get the menu page fields
    $fields = get_fields($res[0]);
 ?>
<section id="mod_menu">

<?php 
    echo get_section_banner($res[0]->post_title);
?>

<?php
    $menu_tabs = 'menu_tabs_pills';  
    $menu_type = 'menu_two';
?>
    
</section> 