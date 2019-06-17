<?php 
/**
* Template Name: Coupons
*/
$args = array(
    'post_type' => 'coupon',
    'posts_per_page' => -1,

);
$res = get_posts($args);
$fields = get_fields(get_the_ID());

$guide['coupon'] = '
    <li class="site__fade site__fade-up">
        <a href="%s">
            <h5>%s</h5>
            <div class="coupon_description block__item-body">%s</div>
            %s
        </a>
    </li>
';


$return['coupon'] = '<section><ul>';

foreach($res as $i => $coupon) {
    
    $fields = get_fields($coupon->ID);

    if( $fields['status'] ){ 
        $return['coupon'] .= sprintf(
            $guide['coupon']
            ,get_permalink($coupon->ID)
            ,$coupon->post_title
            ,(!empty($fields['details']) ? $fields['details'] : '')
            ,(!empty($fields['code']) ? '<p class="coupon_code">Code: <span>'.$fields['code'].'</span></p>' : '')
        );
    }
}
$return['coupon'] .= '</ul></section>';

?>
<?php
    get_header();
?>
<main>
<?php 
    include( get_template_directory() . '/parts/part.hero.php');
    echo $return['coupon'];
?>
<?php 
    get_footer();
 ?>