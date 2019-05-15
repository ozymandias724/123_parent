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

        $heading = ( !empty( $fields['featured_coupons']['heading'] ) ? '<h2>'.$fields['featured_coupons']['heading'].'</h2>' : '');
        $details = ( !empty( $fields['featured_coupons']['details'] ) ? '<div>'.$fields['featured_coupons']['details'].'</div>' : '');
        
        $return_coupons = '
            <section class="mod__coupons-featuredcoupons mod__featured_grid">
                <div class="container">
                '.$heading.'
                '.$details.'
                <div class="site_grid"><ul>
        ';
        
        $format_coupon = '
            <li>
                <div class="block">
                    <h5>%s</h5>
                    <p class="coupon_expiration">Expiration: %s</p>
                    <p class="coupon_code">%s</p>
                </div>
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
                    <a href="'.get_permalink($res[0]->ID).'" title="View all coupons" class="site__button">View All Coupons</a>
                </div>
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