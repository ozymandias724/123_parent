<?php 
/**
 * Template Name: Home Page
 */

    $res = get_fields($post->ID);


    get_header();
 ?>
<main id="page_home">
<?php 

    include( get_template_directory() . '/parts/part.hero.php');

    foreach ($res['modules'] as $rec) {
        if( !empty($rec) ){
            include(  get_template_directory() . '/modules/mod.'.$rec.'.php' );
        }
    }

 ?>
</main>
<?php 
    get_footer();
 ?>