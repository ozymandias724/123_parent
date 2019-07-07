<?php 
/**
 * Template Name: Coupon
 * Template Post Type: coupon
 */

    $fields = get_fields( $post->ID );

    function get_coupon( $fields ){
        $return = '';
        $format_coupon = '
            <section class="single__page single_coupon">
                <div class="grid_coupon">
                    <a href="javascript:;">
                        <div>
                            <h5>%s</h5>
                            <div class="coupon_details block__item-body">%s</div>
                            %s
                            %s
                        </div>
                    </a>
                </div>
            </section>
        ';
    
        if( $fields['status'] ){ 
            $return .= sprintf(
                $format_coupon
                ,get_the_title()
                ,(!empty($fields['details'])? $fields['details']:'')
                ,(!empty($fields['code'])? '<p class="coupon_code">Code: <span>'.$fields['code'].'</span></p>':'')
                ,(!empty($fields['expiration'])? '<p class="coupon_expiration">Expires: <span>'.$fields['expiration'].'</span></p>':'')
            );
        }

        return $return;
    }

    echo '<link rel="stylesheet" id="main-css"  href="' .get_template_directory_uri() . '/__build/_css/main.css" type="text/css" media="all" />';
    
    echo get_coupon($fields);

    echo '<script type="text/javascript" src="' .get_template_directory_uri() . '/__build/_js/main.js"></script>';

 ?>