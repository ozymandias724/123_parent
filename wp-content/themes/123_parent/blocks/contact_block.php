<?php 
/**
*  Contact Block
* 
* 
*/
    if( !function_exists('return_column_content') ){

        /**
         * return the content for a column
         *
         * @param array $column
         * @return void
         */
        function return_column_content( $column ){

            // reset the column return string
            $return['column'] = '';
            
            // guide string for a location
            $guide['locations'] = '
                <li class="site__fade site__fade-up">
                    %s
                    <div>
                        %s
                        %s
                        %s
                        %s
                        %s
                    </div>
                    <a class="site__button" href="javascript:;">Directions</a>
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
                                    // write this location to the return string for the column
                                    $return['column'] .= sprintf(
                                        $guide['locations']
                                        ,( !empty($fields['content']['heading']) ? '<h3 class="area__heading">'.$fields['content']['heading'].'</h3>' : '')
                                        ,( !empty($address['address_street']) ? '<p class="area__address-1">'.$address['address_street'].'</p>' : '')
                                        ,( !empty($address['address_street_2']) ? '<p class="area__address-2">'.$address['address_street_2'].'</p>' : '')
                                        ,'<span class="area__city-state-post">'.$address['address_city'] . ', ' . $address['address_state'] . ' ' . $address['address_postcode'].'</span>'
                                        ,( !empty($fields['content']['phone_number_1']) ? '<br><a class="area__phone-1" href="tel:'.$fields['content']['phone_number_1'].'"><span>Phone: </span>'.$fields['content']['phone_number_1'].'</a>' : '' )
                                        ,( !empty($fields['content']['phone_number_2']) ? '<br><a class="area__phone-2" href="tel:'.$fields['content']['phone_number_2'].'"><span>Phone: </span>'.$fields['content']['phone_number_2'].'</a>' : '' )
                                    );
                                }
                            }
                            // close the locations wrapper
                            $return['column'] .= '</ul>';
                            break;
                            case 'form':
                                $return['column'] .= '<div class="contact__block-form site__fade site__fade-up"><p>Send Us An Email</p>'.do_shortcode('[gravityform id="'.$row['form']['id'].'" title="false" description="false"]').'</div>';
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
    $guide = [];
    
    // guide string for the section
    $guide['section'] = '
        <section %s class="site__block block__contact">
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

    

    // if left has rows
    $return['left'] = '';
    $return['right'] = '';


    $return['left'] .= return_column_content($cB['left']);
    $return['right'] .= return_column_content($cB['right']);

    $return['section'] = '';

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