<?php 
/**
 * Template Name: Service
 * Template Post Type: services
 */

    $fields = get_fields($post->ID);  

    $return_service = '
        <section class="mod__services-featuredservice mod__featured_grid"> 
            <div class="container">
                <div class="site__fade site__fade-up">
    ';
      
    $format_service = '
        <div><div class="block" style="background-image:url(%s);"></div></div>
        <div>
            <h5>%s</h5>
            %s
            <p class="service_price">%s</p>
        </div>
    ';
          
    if( $fields['status'] ){ 
        $return_service .= sprintf(
            $format_service
            ,(!empty($fields['image']['url']) ? $fields['image']['url'] : '')
            ,$post->post_title 
            ,(!empty($fields['details']) ? $fields['details'] : '')
            ,(!empty($fields['price']) ? '$'.$fields['price'] : '')
        );
    }

    $return_service .= '</div></div></section>';

    get_header();
?>
<main id="single_service">
<?php 
    echo $return_service;
    get_footer();
 ?>