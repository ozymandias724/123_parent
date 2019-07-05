<?php 
/**
 * Coupon Grid
*/

    $content = '';

    $the_fields = get_fields( $post->ID );

    $content .= '<a href="'.get_permalink( $post->ID ).'">';

    $content .= '<p>'.$post->post_title.'</p>';

    $content .= ( !empty( $the_fields['details'] ) ? '<div class="coupon_details block__item-body">'.$the_fields['details'].'</div>' : '' );

    $content .= ( !empty( $the_fields['code'] ) ? '<p class="coupon_code">Code: <span>'.$the_fields['code'].'</span></p>' : '' );

    $content .= ( !empty( $the_fields['expiration'] ) ? '<p class="coupon_expiration">Expires: <span>'.$the_fields['expiration'].'</span></p>' : '' );


?>
<div class="grid_coupon">
<?php
    echo $content;
?>
</div>