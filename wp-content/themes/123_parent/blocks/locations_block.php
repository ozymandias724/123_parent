<?php 
/**
 *  Locations Block
 * 
 */

if( !function_exists('return_location_block_location') ){
    function return_location_block_location($location){  
        $guide['location'] = '
            <li>
                <iframe id="gmap_canvas" height="400" width="400" src="https://maps.google.com/maps?key=AIzaSyCfDxwoigWRerVQMojFfT6nk0MMOYsz8XA&q=%s&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </li>
        ';
        $return['location'] = '';
        // get this location posts fields
        $fields = get_fields($location->ID);
    
        // shorten using the address field (bad practice tho)
        $address = (!empty($fields['address']) ? $fields['address'] : '');
    
        if( !empty($address['address_street']) ){
            $complete_address = array(
                (!empty($address['address_street']) ? $address['address_street'] : ''), (!empty($address['address_street']) ? $address['address_street'] : ''), (!empty($address['address_city']) ? $address['address_city']  : ''), (!empty($address['address_state']) ? $address['address_state'] : ''), (!empty($address['address_postcode']) ? $address['address_postcode'] : '')
            );
        }
    
        if( !empty($complete_address) ){
            $return['location'] .= sprintf(
                $guide['location']
                ,implode(' ', $complete_address)
            );
        }
        
        return $return['location'];
    }
}
    
    
    
    
    
    
    
    $return['locations_block'] = '';

    // guide string for the section
    $guide['locations_block'] = '
        <section class="site__block block__locations">
            <div class="container %s">
                %s
                %s
                %s
            </div>
        </section>
    ';

    // write all the content we can into the opening until the left/right part
    $return['locations_block'] .= sprintf(
        $guide['locations_block']
        ,(!empty($cB['width']) ? $cB['width'] : '')                                                         // container width
        ,(!empty($cB['heading']) ? '<h3>' . $cB['heading'] . '</h3>' : '')
        ,(!empty($cB['sub_heading']) ? '<div>' . $cB['sub_heading'] . '</div>' : '')
        ,( !empty($cB['location']) ? return_location_block_location($cB['location']) : 'plz fix me' )
    );
    
    echo $return['locations_block'];

?>