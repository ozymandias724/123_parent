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
        <section id="block__form" class="site__block">
            <div class="container %s" style="background-color: %s; color: %s;">
                %s
                %s
                '. ( !empty($cB['form']) ? do_shortcode('[wpforms id="'.$cB['form']->ID.'" title="false" description="false"]' ) : '' ) . '
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
         $guide['section']
        ,$cB['width']
        ,$cB['background_color']
        ,$cB['foreground_color']
        ,( !empty($cB['heading']) ? '<h2>'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['details']) ? '<div>'.$cB['details'].'</div>' : '' )
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>