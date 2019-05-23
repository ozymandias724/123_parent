<?php 
/**
 * Template Name: Coupons
 */
$args_posts = array(
    'posts_per_page' => -1
    ,'post_type' => 'coupon'
);

$res1 = get_posts($args_posts);

$args_page = array(
    'posts_per_page' => 1
    ,'post_type' => 'page'
    ,'pagename' => 'coupons'
);

$res2 = get_posts($args_page);

$fields = get_fields($res2[0]);

$return_coupons = '';
if( !empty($fields['featured_coupons']['coupons']) ){

    $heading = ( !empty( $fields['featured_coupons']['heading'] ) ? '<h2 class="site__fade site__fade-up">'.$fields['featured_coupons']['heading'].'</h2>' : '');
    $details = ( !empty( $fields['featured_coupons']['details'] ) ? '<div class="site__fade site__fade-up">'.$fields['featured_coupons']['details'].'</div>' : '');
    
    $return_coupons = '
        <section class="mod__coupons-featuredcoupons mod__featured_grid">
            <div class="container">
            '.$heading.'
            '.$details.'
            <div class="site__grid"><ul> 
    ';
    
    $format_coupon = '
        <li class="site__fade site__fade-up">
            <a href="%s">
                <h5>%s</h5>
                <p class="coupon_description">This is a note for what this coupon does and if it\'s not filled in it doesn\'t show.</p>
                <p class="coupon_code">Code: <span>%s</span></p>
            </a>
        </li>
    ';

    foreach( $res1 as $key => $coupon ){

        $coupon_fields = get_fields($coupon->ID);
        
        if( $coupon_fields['status'] ){ 
            $return_coupons .= sprintf(
                $format_coupon
                ,get_permalink($coupon->ID)
                ,$coupon->post_title
                //,date('M j, Y',$coupon_fields['expiration'])
                ,$coupon_fields['code']
            );
        }
    }
    $return_coupons .= '</ul></div>';
    $return_coupons .= '
            </div>
        </section>
    ';
}

?>
<?php
    get_header();
?>
<main class="page__template coupons__page__template">
<?php include( get_template_directory() . '/parts/part.hero.php');   ?>
<?php
    echo $return_coupons;
?>
<?php 
    get_footer();
 ?>