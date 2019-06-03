<?php 
/**
*  Copy Content Block
* 
* 
*/
    // set return and guide string arrays
    $return = [];
    $guide = [];
    
    // guide string for the section
    $guide['section'] = '
        <section id="block__copy" class="site__block">
            <div class="container %s %s" style="%s">
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,'<div style="color: '.$cB['foreground_color'].'">'.$cB['copy'].'</div>'                              // copy content w/ foreground color on container for easy override
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return and $guide vars
    unset($cB, $return, $guide);
 ?>