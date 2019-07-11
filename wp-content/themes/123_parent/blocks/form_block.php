<?php 
/**
 * form Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return['section'] = '';
    $return['form'] ='';
    $guide['form'] = '';
    $guide['section'] = '';
    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__form">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                '.( !empty($cB['form']) ? do_shortcode('[gravityform id="'.$cB['form']['id'].'" title="false" description="false"]') : '') .'
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['options']['width'] ) ? $cB['options']['width'] : '' )                                                         // container width
        ,( !empty( $cB['options']['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['options']['background_color'] ) ? 'background-color:'.$cB['options']['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['options']['foreground_color'] ) ? 'color:'.$cB['options']['foreground_color'].';' : '' )           // container bg color style
        ,( !empty($cB['heading_options']['heading']) ? '<h2 style="text-align:'.$cB['heading_options']['heading_alignment'].';">'.$cB['heading_options']['heading'].'</h2>' : '' )
        ,( !empty($cB['heading_options']['details']) ? '<div>'.$cB['heading_options']['details'].'</div>' : '' )
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>