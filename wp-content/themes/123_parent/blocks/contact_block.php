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

    $guide['locations'] = '<li>%s</li>';


    
    // 
    // Do the left Side
    $return['left'] = '';
    foreach( $cB['left'] as $row ){

        // Locations Layout
        if( $row['acf_fc_layout'] == 'locations' ){
            $return['left'] .= '<ul>';
            foreach( $row['locations'] as $location ){
                $fields = get_fields($location['location']->ID);
                $return['left'] .= sprintf(
                    $guide['locations']
                    ,(!empty($fields['content']['heading']) ? $fields['content']['heading'] : '')
                );
            }
            $return['left'] .= '</ul>';
        }
        
        // Form Layout
        if( $row['acf_fc_layout'] == 'form' ){
            $return['left'] .= '<div>'.do_shortcode('[wpforms id="'.$row['form']->ID.'" title="false" description="false"]').'</div>';
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
            foreach( $row['locations'] as $location ){
                $fields = get_fields($location['location']->ID);
                $return['right'] .= sprintf(
                    $guide['locations']
                    ,(!empty($fields['content']['heading']) ? $fields['content']['heading'] : '')
                );
            }
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
        ,( !empty($cB['heading']) ? '<h2 class=" block__heading site__fade site__fade-up">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div class="block__details site__fade site__fade-up">'.$cB['text'].'</div>' : '' )
        ,$return['left']
        ,$return['right']
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return and $guide vars
    unset($cB, $return, $guide);
 ?>