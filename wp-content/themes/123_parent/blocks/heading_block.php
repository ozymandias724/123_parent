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
            <div class="container %s %s" style="%s %s">
                %s
            </div>
        </section>
    ';

    $return[1] .= sprintf(
        $guide[1]
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )
        ,( !empty( $cB['alignment'] ) ? 'text-align:'.$cB['alignment'].';' : '' )
        ,'<'.$cB['level'].' style="color: '.$cB['foreground_color'].'">'.$cB['content'] . '</'.$cB['level'].'>'
    );


    // echo return string
    echo $return[1];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>