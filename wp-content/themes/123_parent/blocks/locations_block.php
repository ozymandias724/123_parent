<?php 
/**
 * Locations Block
 * 
 */

    if( !function_exists('return_column_content_location_block') ){

        /**
         * return the content for a column
         * 
         * @param array $column
         * @return void
         */
        function return_column_content_location_block( $column ){

            // reset the column return string
            $return['column'] = '';  

            // guide for google map
            $guide['locations'] = '
                <li>
                    <iframe id="gmap_canvas" height="400" width="400" src="https://maps.google.com/maps?key=AIzaSyCfDxwoigWRerVQMojFfT6nk0MMOYsz8XA&q=%s&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </li>
            ';
            
            if( !empty($column) ){

                // each row in this column (acf flex content layouts)
                foreach( $column as $row ){

                    // check which layout this row is
                    switch ($row['acf_fc_layout']) {

                        // this row is a locations block
                        case 'locations':

                            // open the locations wrapper
                            $return['column'] .='<ul class="locations">';

                            // loop thru location items
                            if( !empty($row['locations']) ){

                                foreach( $row['locations'] as $location ){

                                    // get this location posts fields
                                    $fields = get_fields($location['location']->ID);
                                    
                                    // shorten using the address field (bad practice tho)
                                    $address = ( !empty($fields['content']['address']) ? $fields['content']['address'] : '');

                                    $complete_address = array(
                                        ( !empty( $address['address_street'] ) ? $address['address_street'] : '')
                                        ,( !empty( $address['address_street'] ) ? $address['address_street'] : '')
                                        ,( !empty( $address['address_city']  ) ? $address['address_city']  : '')
                                        ,( !empty( $address['address_state'] ) ? $address['address_state'] : '' )
                                        ,( !empty( $address['address_postcode'] ) ? $address['address_postcode'] : '' )
                                    );

                                    $return['column'] .= sprintf(
                                        $guide['locations']
                                        ,implode(' ', $complete_address)
                                    );
                                }
                            }

                            // close the locations wrapper
                            $return['column'] .= '</ul>';

                            break;
                            case 'form':
                                $return['column'] .= '<div class="locations__block-form site__fade site__fade-up"><p>Send Us An Email</p>'.do_shortcode('[gravityform id="'.$row['form']['id'].'" title="false" description="false"]').'</div>';
                                break;
                        default:
                            # code...
                            break;
                    }
                }
            }
            return $return['column'];
        }
    }


    // set return and guide string arrays
    $return = [];
    
    $return['left'] = '';
    $return['right'] = '';
    $return['section'] = '';

    $guide = [];
    
    // guide string for the section
    $guide['section'] = '
        <section %s class="site__block block__locations">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                <ul class="columns">
                    <li class="left">%s</li>
                    <li class="right">%s</li>
                </ul>
            </div>
        </section>
    ';

    $return['left'] .= return_column_content_location_block($cB['left']);
    $return['right'] .= return_column_content_location_block($cB['right']);

    // write all the content we can into the opening until the left/right part
    $return['section'] .= sprintf(
        $guide['section']

        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll

        ,( !empty( $cB['options']['width'] ) ? $cB['options']['width'] : '' )                                                         // container width

        ,( !empty( $cB['options']['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class

        ,( !empty( $cB['options']['background_color'] ) ? 'background-color:'.$cB['options']['background_color'].';' : '' )           // container bg color style

        ,( !empty( $cB['options']['foreground_color'] ) ? 'color:'.$cB['options']['foreground_color'].';' : '' )           // container bg color style

        ,( !empty($cB['heading_options']['heading']) ? '<h2 class="block__heading site__fade site__fade-up" style="'.( !empty( $cB['heading_options']['heading_alignment'] )? 'text-align:'.$cB['heading_options']['heading_alignment'].';' : '' ).'">'.$cB['heading_options']['heading'].'</h2>' : '' )

        ,( !empty($cB['heading_options']['sub_heading']) ? '<div class="block__details site__fade site__fade-up">'.$cB['heading_options']['sub_heading'].'</div>' : '' )

        ,$return['left']
        ,$return['right']
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return and $guide vars
    unset($cB, $return, $guide);
 ?>