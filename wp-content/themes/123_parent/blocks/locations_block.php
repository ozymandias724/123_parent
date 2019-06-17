<?php 
/**
 * form Block
 * 
 */
function _get_address($ID)
{
    $return = '';
    $location_content = get_fields($ID);
    $address = (!empty($location_content['content']['address']) ? $location_content['content']['address'] : '');
    if(!empty($address))
    {
        $postal = '';
        if(!empty($address['address_is_postal']))
        {
            $is_postal = $address['address_is_postal'];
            if($is_postal)
            {
                $postal = '<p>Postal Address:</p>';
            }
        }  
        $street_1 = (!empty($address['address_street']) ? $address['address_street'] : '');
        $street_2 = (!empty($address['address_street_2']) ? $address['address_street_2'] : '');
        $city = (!empty($address['address_city']) ? $address['address_city'] : '');
        $state = (!empty($address['address_state']) ? $address['address_state'] : '');
        $postcode = (!empty($address['address_postcode']) ? $address['address_postcode'] : '');

        $format = '
            <div class="location_address">
                %s
                <p>%s %s</p> 
                <p>%s, %s %s</p>
            </div>'; 
        $return = sprintf(
            $format
            ,$postal
            ,$street_1
            ,$street_2
            ,$city
            ,$state
            ,$postcode
        );
    }
    
    return $return; 
}
    // empty return string
    $return = [];
    $guide = [];

    $return['locations'] = '';
    
    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__locations">
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
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
        ,( !empty($cB['heading']) ? '<h2>'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return['locations']) ? $return['locations'] : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )

    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>