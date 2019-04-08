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
        ,'pagename' => 'menu'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);
 ?>
<section id="mod_menu">
<?php 
    echo get_section_banner($res[0]->post_title);
 ?>
</section>
<?php 
 ?>