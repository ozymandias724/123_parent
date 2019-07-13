<?php 
/**
*  Heading Content Block
* 
* 
*/
    // set return and guide string arrays
    $return = [];
    $guide = [];
    $return['section'] = '';
    
    // guide string for the section
    $guide['section'] = '
        <section %s class="site__block block__heading">
            <div class="container %s %s" style="%s">
                %s
            </div>
        </section>
    ';
    // return string for the section
    $return['section'] .= sprintf(
        $guide['section']
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['options']['width'] ) ? $cB['options']['width'] : '' )                                                         // container width
        ,( !empty( $cB['options']['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['options']['background_color'] ) ? 'background-color:'.$cB['options']['background_color'].';' : '' )           // container bg color style
        ,'<'.$cB['heading_options']['level'].' style="color: '.$cB['options']['foreground_color'].';text-align:'.$cB['heading_options']['heading_alignment'].';">'.$cB['heading_options']['content'] . '</'.$cB['heading_options']['level'].'>' // heading content w/ level and alignment
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return and $guide vars
    unset($cB, $return, $guide);
 ?>