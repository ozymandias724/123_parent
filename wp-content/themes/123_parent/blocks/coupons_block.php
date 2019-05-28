<?php 
/**
 * coupons Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return[0] ='<ul>';
    $guide[0] = '
        <li class="">
            <a href="%s">
                <h5>%s</h5>
                <p class="coupon_description">This is a note for what this coupon does and if it\'s not filled in it doesn\'t show.</p>
                <p class="coupon_code">Code: <span>%s</span></p>
            </a>
        </li>
    ';
    
    foreach($cB['coupons'] as $i => $coupon) {
        
        $fields = get_fields($coupon['coupon']->ID);
        if( $fields['status'] ){ 
            $return[0] .= sprintf(
                $guide[0]
                ,get_permalink($coupon['coupon']->ID)
                ,$coupon['coupon']->post_title
                //,date('M j, Y',$coupon_fields['expiration'])
                ,$coupon_fields['code']
            );
        }
    }
    $return[0] .= '</ul>';

    
    // empty guide string 
    $guide[1] = '
        <section id="block__coupons" class="site__block">
            <div class="container %s" style="background-color: %s; color: %s;">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return[1] .= sprintf(
         $guide[1]
        ,$cB['width']
        ,$cB['background_color']
        ,$cB['foreground_color']
        ,( !empty($cB['heading']) ? '<h2>'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return[0]) ? '<div class="site__grid">'.$return[0].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );


    // echo return string
    echo $return[1];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>