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
            </div>
        </section>
    ';

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
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return and $guide vars
    unset($cB, $return, $guide);
 ?>