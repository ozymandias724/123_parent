<?php 
/**
*  Copy Content Block
* 
* 
*/
    // set return and guide string arrays
    $return['copy_block'] = '';
    $guide['copy_block'] = '';
    
    // guide string for the section
    $guide['copy_block'] = '
        <section class="site__block block__copy">
            <div class="container %s">
                %s
            </div>
        </section>
    ';

    $return['copy_block'] .= sprintf(
        $guide['copy_block']
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,$cB['copy']
    );


    // echo return string
    echo $return['copy_block'];

    
 ?>