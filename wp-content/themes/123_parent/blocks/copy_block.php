<?php 
/**
 * copy Block
 * 
 */
    // data source

    // empty return string
    $return = [];
    $guide = [];
    $return[0] ='';
    $guide[0] ='';


    
    // empty guide string 
    $guide[1] = '
        <section id="block__copy" class="site__block">
            <div class="container %s" style="color: %s; background-color: %s">
                %s
            </div>
        </section>
    ';

    $return[1] .= sprintf(
        $guide[1]
        ,$cB['width']
        ,$cB['foreground_color']
        ,$cB['background_color']
        ,( !empty($cB['copy']) ? '<div class="copy">'.$cB['copy'].'</div' : '' )
    );


    // echo return string
    echo $return[1];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>