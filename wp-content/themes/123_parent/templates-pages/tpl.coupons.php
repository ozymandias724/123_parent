<?php 
/**
* Template Name: Coupons
*/
$args = array(
    'post_type' => 'coupon'
    ,'posts_per_page' => -1

);
$res = get_posts($args);
$fields = get_fields(get_the_ID());


$return['section'] = '';

$guide['coupon'] = '
    <li class="site__fade site__fade-up">
        <a href="%s">
            <h5>%s</h5>
            <div class="coupon_description block__item-body">%s</div>
            %s
            %s
        </a>
    </li>
';


$return['coupon'] = '<ul>';

foreach($res as $i => $coupon) {
    
    $coupon_fields = get_fields($coupon->ID);

    if( $coupon_fields['status'] ){ 
        $return['coupon'] .= sprintf(
            $guide['coupon']
            ,get_permalink($coupon->ID)
            ,$coupon->post_title
            ,(!empty($coupon_fields['details']) ? $coupon_fields['details'] : '')
            ,(!empty($coupon_fields['code']) ? '<p class="coupon_code">Code: <span>'.$coupon_fields['code'].'</span></p>' : '')
            ,(!empty($coupon_fields['expiration']) ? '<p class="coupon_expiration">Expires: <span>'.$coupon_fields['expiration'].'</span></p>' : '')
        );
    }
}
$return['coupon'] .= '</ul>';

$guide['section'] = '
    <section class="page__template tpl_page_coupon">
        <div class="container %s">
            %s
            %s
            %s
        </div>
    </section>
';

$return['section'] .= sprintf(
    $guide['section']
    ,( !empty( $fields['width'] ) ? $fields['width'] : '' ) 
    ,( !empty($fields['heading']) ? '<h2 class="site__fade site__fade-up block__heading" style="text-align:'.$fields['heading_alignment'].';">'.$fields['heading'].'</h2>' : '' )
    ,( !empty($fields['text']) ? '<div class="site__fade site__fade-up block__details">'.$fields['text'].'</div>' : '' )
    // 
    ,( !empty($return['coupon']) ? '<div class="site__grid coupons__'.$fields['style'].'">'.$return['coupon'].'</div>' : '' )
);

?>
<?php
    get_header();
?>
<main>
<?php 
    include( get_template_directory() . '/parts/part.hero.php');
    echo $return['section'];
?>
<?php 
    get_footer();
 ?>