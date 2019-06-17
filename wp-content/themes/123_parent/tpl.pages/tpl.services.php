<?php 
/**
* Template Name: Services
*/
    $fields_page = get_fields(get_the_ID());

    $args = array(
        'post_type' => 'services'
        ,'posts_per_page' => -1
    );
    $services = get_posts($args);

    foreach( $services as $service ){

        $fields = get_fields($service->ID);

    }
    
    get_header();
?>
<main id="page_services">
<?php 
    include( get_template_directory() . '/parts/part.hero.php'); 

?>
<?php 
    get_footer();
 ?>