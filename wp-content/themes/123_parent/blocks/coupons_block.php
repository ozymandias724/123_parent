<?php 
/**
 * coupons Block
 * 
 */
    // empty return string
    $return = [];
    $return['section'] = '';
    $guide = [];
    $return['coupon'] ='<ul>';

    $guide['coupon'] = '
        <li class="site__fade site__fade-up coupons__'.$cB['style'].'">
            <a class="coupon_print" href="%s?style='.$cB['style'].'" target="_blank">
                <h5>%s</h5>
                <div class="coupon_description block__item-body">%s</div>
                %s
                %s
            </a>
        </li>
    ';
    
    foreach($cB['coupons'] as $i => $coupon) {
        
        $fields = get_fields($coupon['coupon']->ID);

        if( $fields['status'] ){ 
            $return['coupon'] .= sprintf(
                $guide['coupon']
                ,get_permalink($coupon['coupon']->ID)
                ,$coupon['coupon']->post_title
                ,(!empty($fields['details']) ? $fields['details'] : '')
                ,(!empty($fields['code']) ? '<p class="coupon_code">Code: <span>'.$fields['code'].'</span></p>' : '')
                ,(!empty($fields['expiration']) ? '<p class="coupon_expiration">Expires: <span>'.$fields['expiration'].'</span></p>' : '')
            );
        }
    }
    $return['coupon'] .= '</ul>';
    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__coupons">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        // opts 
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
        // 
        ,( !empty($cB['heading']) ? '<h2 class="site__fade site__fade-up block__heading" style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div class="site__fade site__fade-up block__details">'.$cB['text'].'</div>' : '' )
        // 
        ,( !empty($return['coupon']) ? '<div class="site__grid coupons__'.$cB['style'].'">'.$return['coupon'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>