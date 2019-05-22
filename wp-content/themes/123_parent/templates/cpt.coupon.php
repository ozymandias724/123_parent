<?php 
/**
 * Template Name: Coupon
 * Template Post Type: coupon
 */

$fields = get_fields($post->ID);

function _get_coupon($fields){

    $format_coupon = '
        <div class="container site__fade site__fade-up">
            <div>
                <h5>%s</h5>
                <p class="coupon_description">This is a note for what this coupon does and if it\'s not filled in it doesn\'t show.</p>
                <p class="coupon_code">Code: <span>%s</span></p>
            </div>
        </div>
    ';
 
    if( $fields['status'] ){ 
        $return_coupon .= sprintf(
            $format_coupon
            ,get_the_title($post->ID)
            ,$fields['code']
        );
    }


    return $return_coupon;
}
?>
<?php
    get_header();
?>
<main class="single__template coupon__single__template">
<?php
    echo _get_coupon($fields);
?>
<?php 
    get_footer();
 ?>