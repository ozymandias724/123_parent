<?php 
/**
 * services Block
 * 
 */
    // data source

    // empty return string
    $return = [];
    $guide = [];
    
    // empty guide string 
    $guide[1] = '
        <section id="block__heading" class="site__block">
            <div class="container %s" style="background-color: %s; text-align: %s">
                %s
            </div>
        </section>
    ';

    $return[1] .= sprintf(
        $guide[1]
        ,$cB['width']
        ,$cB['background_color']
        ,$cB['alignment']
        ,'<'.$cB['level'].' style="color: '.$cB['foreground_color'].'">'.$cB['content'] . '</'.$cB['level'].'>'
    );


    // echo return string
    echo $return[1];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>