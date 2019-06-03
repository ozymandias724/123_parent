<?php 
/**
 * Services Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return['services'] ='<ul>';
    $guide['services'] = '
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
            $return['services'] .= sprintf(
                $guide['services']
                ,get_permalink($service['service']->ID)
                ,(!empty($fields['image']['url']) ? $fields['image']['url'] : '')
                ,( !empty($service['service']->post_title ) ? '<h3>'.$service['service']->post_title.'</h3' : '' )
                ,(!empty($fields['details']) ? $fields['details'] : '')
                ,(!empty($fields['price']) ? '$'.$fields['price'] : '')
            );
        }
    }
    $return['services'] .= '</ul>';

    
    // empty guide string 
    $guide['section'] = '
        <section id="block__services" class="site__block">
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
         ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
        ,( !empty($cB['heading']) ? '<h2 style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return['services']) ? '<div class="site__grid">'.$return['services'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>