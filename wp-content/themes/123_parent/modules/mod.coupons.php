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


    if( !empty($fields['featured_coupons']['coupons']) ){

        $heading = ( !empty( $fields['featured_coupons']['heading'] ) ? '<h4>'.$fields['featured_coupons']['heading'].'</h4>' : '');
        $details = ( !empty( $fields['featured_coupons']['details'] ) ? '<p>'.$fields['featured_coupons']['details'].'</p>' : '');
        
        $return_coupons = '
            <section class="mod__coupons-featuredcoupons">
                <div>
                    '.$heading.'
                    '.$details.'
                </div>
                <div class="site_grid"><ul>
        ';
        
        $format_coupon = '
            <li>
                <h5>%s</h5>
                <p>%s</p>
                <p>%s</p>
            </li>
        ';

        foreach( $fields['featured_coupons']['coupons'] as $coupon ){

            $coupon_fields = get_fields($coupon['coupon']->ID);
            
            if( $coupon_fields['status'] ){ 
                $return_coupons .= sprintf(
                    $format_coupon
                    ,$coupon['coupon']->post_title
                    ,date('M j, Y',$coupon_fields['expiration'])
                    ,$coupon_fields['code']
                );
            }
        }
        $return_coupons .= '</ul></div>';

        $return_coupons .= '
            <a href="javascript:;" title="View all coupons" class="site_button">View All Coupons</a>
            </section>
        ';
    }
    
 ?>
<section id="mod_coupons">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_coupons;
 ?>
</section>
<?php 
 ?>