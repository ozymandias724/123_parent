<?php 
/**
*  Heading Content Block
* 
* 
*/
    $return['heading_block'] = '';
    
    // guide string for the section
    $guide['heading_block'] = '
        <section class="site__block block__heading">
            <div class="container '.$cB['width'].'">
                %s
                %s
            </div>
        </section>
    ';
    // return string for the section
    $return['heading_block'] .= sprintf(
        $guide['heading_block']
        ,'<'.$cB['level'].'>'.$cB['heading'] . '</'.$cB['level'].'>' // heading content w/ level and alignment
        ,'<p>'.$cB['sub_heading'].'</p>'
    );

    // echo return string
    echo $return['heading_block'];

 ?>