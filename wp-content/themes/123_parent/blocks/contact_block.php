<?php 
/**
*  Contact Block
* 
* 
*/
    // set return and guide string arrays
    $return = [];
    $guide = [];
    
    // guide string for the section
    $guide['section'] = '
        <section %s class="site__block block__contact">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                <div class="columns">
                    <div class="left">%s</div>
                    <div class="right">%s</div>
                </div>
            </div>
        </section>
    ';

    function get_area_content($row){

        $return = '';

        $guide['locations'] = '
            <li>
                <div class="container %s">
                    <h3 class="area__heading">%s</h3>
                    <div class="area__postal">%s</div>
                    <div class="area__address-1">%s</div>
                    <div class="area__address-2">%s</div>
                    <div class="area__city-state-post">%s</div>
                    <a href="tel:%s" class="area__phone-1">%s</a>
                    <a href="tel:%s" class="area__phone-2">%s</a>
                    <a class="area__directions" href="javascript:;">Directions</a>
                </div>
            </li>
        ';

        foreach( $row['locations'] as $location ){
            $fields = get_fields($location['location']->ID);

            $address = ( !empty($fields['content']['address']) ? $fields['content']['address'] : '');

            $postal = ( !empty($address['address_is_postal']) ? 'This is a postal address' : '');
            $street_1 = ( !empty($address['address_street']) ? $address['address_street'] : '');
            $street_2 = ( !empty($address['address_street_2']) ? $address['address_street_2'] : '');
            $city = ( !empty($address['address_city']) ? $address['address_city'] : '');
            $state = ( !empty($address['address_state']) ? $address['address_state'] : '');
            $postcode = ( !empty($address['address_postcode']) ? $address['address_postcode'] : '');
            
            $return .= sprintf(
                $guide['locations']
                ,( !empty($fields['options']['width']) ? $fields['options']['width'] : '')
                ,( !empty($fields['content']['heading']) ? $fields['content']['heading'] : '')
                ,$postal
                ,$street_1
                ,$street_2
                ,$city . ', ' . $state . ' ' . $postcode
                ,'(123) 456-7890'
                ,'Phone: (123) 456-7890'
                ,'(123) 456-7890'
                ,'Phone: (123) 456-7890'
                
            );
        }
        return $return;
    }


    // 
    // Do the left Side
    $return['left'] = '';

    foreach( $cB['left'] as $row ){

        // Locations Layout
        if( $row['acf_fc_layout'] == 'locations' ){
            $return['left'] .= '<ul class="area__ul">';
            $return['left'] .= get_area_content($row);
            $return['left'] .= '</ul>';
        }
        
        // Form Layout
        if( $row['acf_fc_layout'] == 'form' ){
            $return['left'] .= '<div class="contact__block-form">'.do_shortcode('[wpforms id="'.$row['form']->ID.'" title="false" description="false"]').'</div>';
        }

        // Map Layout

    }
    // 

    // 
    // Do the Right Side
    $return['right'] = '';

    foreach( $cB['right'] as $row ){

        // Locations Layout
        if( $row['acf_fc_layout'] == 'locations' ){
            $return['right'] .= '<ul>';
            $return['right'] .= get_area_content($row);
            $return['right'] .= '</ul>';
        }
        
        // Form Layout
        if( $row['acf_fc_layout'] == 'form' ){
            $return['right'] .= '<div>'.do_shortcode('[wpforms id="'.$row['form']->ID.'" title="false" description="false"]').'</div>';
        }

        // Map Layout

    }
    // 
    

    // write all the content we can into the opening until the left/right part
    $return['section'] .= sprintf(
        $guide['section']
        //  options for every block
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
        // post object grid options
        ,( !empty($cB['heading']) ? '<h2 class="block__heading site__fade site__fade-up">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div class="block__details site__fade site__fade-up">'.$cB['text'].'</div>' : '' )
        ,$return['left']
        ,$return['right']
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return and $guide vars
    unset($cB, $return, $guide);
 ?>