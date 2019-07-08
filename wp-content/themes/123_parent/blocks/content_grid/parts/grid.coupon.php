<?php 
/**
* Coupon item
*/  

    $return['content'] = '';

    $guide['content'] = '
        <a class="coupon_print" href="%s?style=" target="_blank">
            <div>
                <h5>%s</h5>
                <div class="coupon_description block__item-body">%s</div>
                %s
                %s
            </div>
        </a>
    ';

    $the_fields = get_fields( $post->ID );

    $return['content'] .= sprintf(
        $guide['content']
        ,get_permalink($post->ID)
        ,$post->post_title
        ,(!empty($the_fields['details']) ? $the_fields['details'] : '')
        ,(!empty($the_fields['code']) ? '<p class="coupon_code">Code: <span>'.$the_fields['code'].'</span></p>' : '')
        ,(!empty($the_fields['expiration']) ? '<p class="coupon_expiration">Expires: <span>'.$the_fields['expiration'].'</span></p>' : '')
    );
?>
<div class="grid_coupon grid_item">
<?php
    echo $return['content'];
?>
</div>