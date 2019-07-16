<?php 
/**
 * form Block
 * 
 */
    // empty return string
    $return['form_block'] = '';
    $return['form_object'] ='';
    $guide['form_object'] = '';
    $guide['form_block'] = '';
    
    // empty guide string 
    $guide['form_block'] = '
        <section class="site__block block__form">
            <div class="container %s">
                %s
                %s
                '.( !empty($cB['form']) ? do_shortcode('[gravityform id="'.$cB['form']['id'].'" title="false" description="false"]') : '') .'
            </div>
        </section>
    ';

    $return['form_block'] .= sprintf(
        $guide['form_block']
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty($cB['heading']) ? '<h3>'.$cB['heading'].'</h3>' : '' )
        ,( !empty($cB['sub_heading']) ? '<div>'.$cB['sub_heading'].'</div>' : '' )
    );


    // echo return string
    echo $return['form_block'];

 ?>