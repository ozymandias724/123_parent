<?php 
/**
 * Services Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return[0] ='<ul>';
    $guide[0] = '
        <li>
            <a href="%s">
                <div><div class="block" style="background-image:url(%s);"></div></div>
                <div>
                    %s
                    %s
                    <p class="service_price">%s</p>
                </div>
            </a>
        </li>
    ';
    
    foreach($cB['services'] as $i => $service) {
        
        $fields = get_fields($service['service']->ID);
        if( $fields['status'] ){ 
            $return[0] .= sprintf(
                $guide[0]
                ,get_permalink($service['service']->ID)
                ,(!empty($fields['image']['url']) ? $fields['image']['url'] : '')
                ,( !empty($service['service']->post_title ) ? '<h3>'.$service['service']->post_title.'</h3' : '' )
                ,(!empty($fields['details']) ? $fields['details'] : '')
                ,(!empty($fields['price']) ? '$'.$fields['price'] : '')
            );
        }
    }
    $return[0] .= '</ul>';

    
    // empty guide string 
    $guide[1] = '
        <section id="block__services" class="site__block">
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
        ,( !empty($cB['heading']) ? '<h2 style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return[0]) ? '<div class="site__grid">'.$return[0].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return[1];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>