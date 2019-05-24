<?php 
/**
 * Template Name: Home Page
 */

    $fields = get_fields($post->ID);
    
    get_header();
    include( get_template_directory() . '/parts/part.popups.php');
 ?>
<main id="page_home">
<?php 
    include( get_template_directory() . '/parts/part.hero.php'); 

    if( !empty($fields['long_scroll']) && !empty($fields['sections']) ){
        foreach ($fields['sections'] as $section) {

            $name = $section['section']->post_name;
            
            include(  get_template_directory() . '/modules/mod.'.$name.'.php' );
        }
    }
    else {
        // do stuff for the static home page
    }

 ?>
</main>
<?php 
    
    get_footer();
 ?>