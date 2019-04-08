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
        ,'pagename' => 'coupons'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);


    $format_coupon = '<li><div class="image">%s</div></li>';
    
    $return_coupons_grid = '<div class="site_grid"><ul>';
    

    $args = array(
        'post_type' => 'coupon'
        ,'posts_per_page' => -1
    );
    $coupons = get_posts($args);
    foreach( $coupons as $coupon ){

        $rec_fields = get_fields($coupon->ID);
        
        $return_coupons_grid .= sprintf(
            $format_coupon
            ,$coupon->post_title
        );

    }

    $return_coupons_grid .= '</ul></div>';
    
 ?>
<section id="mod_coupons">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_coupons_grid;
 ?>
</section>
<?php 
 ?>