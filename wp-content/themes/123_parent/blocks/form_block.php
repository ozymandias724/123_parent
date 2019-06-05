<?php 
/**
 * form Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return['form'] ='';
    $guide['form'] = '';
    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__form">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                '. ( !empty($cB['form']) ? do_shortcode('[wpforms id="'.$cB['form']->ID.'" title="false" description="false"]' ) : '' ) . '
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
        ,( !empty($cB['details']) ? '<div>'.$cB['details'].'</div>' : '' )
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>