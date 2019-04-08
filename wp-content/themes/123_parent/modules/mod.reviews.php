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
        ,'pagename' => 'reviews'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);


    $format_review = '<li><div class="image" style="background-image:url(%s);"></div></li>';
    
    $return_review_grid = '<div><ul>';
    
    $args = array(
        'post_type' => 'testimonials'
        ,'posts_per_page' => -1
    );
    $reviews = get_posts($args);

    foreach( $reviews as $review ){

        $review_fields = get_fields($review->ID);
        
        $return_review_grid .= sprintf(
            $format_review
            ,$review_fields['image']['url']
        );

    }

    $return_review_grid .= '</ul></div>';
    
 ?>
<section id="mod_reviews">
<?php 
    echo get_section_banner($res[0]->post_title);

    echo $return_review_grid;
    
 ?>
</section>
<?php 
 ?>