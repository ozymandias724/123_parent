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
        ,'pagename' => 'blog'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);
 ?>
<section id="mod_blog">
<?php 
    echo '<h2>'.$res[0]->post_title.'</h2>';
 ?>
</section>
<?php 
 ?>