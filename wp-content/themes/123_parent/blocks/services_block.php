<?php 
/**
 * Services Block
 * 
 */
    // empty return string

    $return = [];
    $guide = [];
    $return['services'] ='<ul>';
    
    foreach($cB['services'] as $i => $service) {
        
        $fields = get_fields($service['service']->ID);

        if( $cB['style'] == 'one'){
            $guide['services'] = '
                <li>
                    <a href="%s">
                        <div><div class="image '.( ($cB['style'] == 'one') ? 'less_size_block' : '').'" style="background-image:url(%s);"></div></div>
                        <div>
                            %s 
                            <div class="service__details block__item-body">%s</div>
                            <p class="service_price">%s</p>
                        </div>
                    </a>
                </li>
            ';
            
            if( $fields['status'] ){ 
                $return['services'] .= sprintf(
                    $guide['services']
                    ,get_permalink($service['service']->ID)
                    ,(!empty($fields['image']['url']) ? $fields['image']['url'] : '')
                    ,( !empty($service['service']->post_title ) ? '<h3>'.$service['service']->post_title.'</h3>' : '' )
                    ,(!empty($fields['details']) ? $fields['details'] : '')
                    ,(!empty($fields['price']) ? '$'.$fields['price'] : '')
                );
            }
        }else if( $cB['style'] == 'three' || $cB['style'] == 'two'){

            if($i % 2 == 0){
                $guide['services'] = '
                    <li>
                        <a href="%s">
                            <div><div class="image '.( ($cB['style'] == 'one') ? 'less_size_block' : '').'" style="background-image:url(%s);"></div></div>
                            <div>
                                %s 
                                <div class="service__details block__item-body">%s</div>
                            </div>
                        </a>
                    </li>
                ';
                if( $fields['status'] ){ 
                    $return['services'] .= sprintf(
                        $guide['services']
                        ,get_permalink($service['service']->ID)
                        ,(!empty($fields['image']['url']) ? $fields['image']['url'] : '')
                        ,( !empty($service['service']->post_title) ? '<h3><span>'.$service['service']->post_title.'</span><span>'.(!empty($fields['price']) ? '$'.$fields['price'] : '').'</span></h3>' : '' )
                        ,(!empty($fields['details']) ? $fields['details'] : '')
                    );
                }
            }else{
                $guide['services'] = '
                    <li>
                        <a href="%s">
                            <div>
                                %s 
                                <div class="service__details block__item-body">%s</div>
                            </div>
                            <div><div class="image '.( ($cB['style'] == 'one') ? 'less_size_block' : '').'" style="background-image:url(%s);"></div></div>
                        </a>
                    </li>
                ';
                if( $fields['status'] ){ 
                    $return['services'] .= sprintf(
                        $guide['services']
                        ,get_permalink($service['service']->ID)
                        ,( !empty($service['service']->post_title) ? '<h3><span>'.$service['service']->post_title.'</span><span>'.(!empty($fields['price']) ? '$'.$fields['price'] : '').'</span></h3>' : '' )
                        ,(!empty($fields['details']) ? $fields['details'] : '')
                        ,(!empty($fields['image']['url']) ? $fields['image']['url'] : '')
                    );
                }
            }

        }
    }
    $return['services'] .= '</ul>';

    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__services">
            <div class="container %s %s services__%s" style="%s %s">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
         $guide['section']
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )    // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['style']) ? $cB['style'] : '')                                                     
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
        ,( !empty($cB['heading']) ? '<h2 class="block__heading" style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div class="block__details">'.$cB['text'].'</div>' : '' )
        ,( !empty($return['services']) ? '<div '.( ($cB['style'] == 'one') ? 'class="site__grid"' : '').'>'.$return['services'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>