<?php 
/**
*  Copy Content Block
* 
* 
*/
    // set return and guide string arrays
    $return = [];
    $guide = [];
    $return['section'] = '';
    $guide['section'] = '';
    
    // guide string for the section
    $guide['section'] = '
        <section %s class="site__block block__copy">
            <div class="container %s %s" style="%s">
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['options']['width'] ) ? $cB['options']['width'] : '' )                                                         // container width
        ,( !empty( $cB['options']['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['options']['background_color'] ) ? 'background-color:'.$cB['options']['background_color'].';' : '' )           // container bg color style
        ,'<div style="color: '.$cB['options']['foreground_color'].'">'.$cB['copy'].'</div>'                              // copy content w/ foreground color on container for easy override
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return and $guide vars
    unset($cB, $return, $guide);
 ?>