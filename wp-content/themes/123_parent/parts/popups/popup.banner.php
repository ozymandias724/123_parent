<?php 

    //  1: button
    //  2: overlay

    $fields = get_field('popups', 'options')['banner'];


    $guide = [];
    $return = [];

    $guide['overlay'] = '';
    $return['overlay'] = '';
    // 
    $guide['button'] = '<a href="javascript:;">%s</a>';
    $return['button'] = '';
    // 

    $return['button'] .= sprintf(
        $guide['button']
        ,$fields['button']['text']
    );
    $return['overlay'] .= sprintf(
        $guide['overlay']
    );
    
    
    echo $return['button'];
    echo $return['overlay'];


    unset($return, $guide, $fields);
 ?>