<?php 
/**
*  Timed Popup
*  This file is only loaded if the timed popup exists; conditionals handled before call
*/
    // empty overlay return
    $return['overlay'] = '';

    $guide['overlay'] = '';

    // get fields
    $fields = get_field('popups', 'options')['timed_overlay'];

    // overlay guide
    $guide['overlay'] = '
        <div id="popups__timed_overlay">
            <i class="fas fa-times overlay__closebutton"></i>
            <div class="container">
                <figure><img src="%s"></figure>
                <div>
                    %s
                    %s
                    <div class="popup_form">'.( !empty($fields['overlay']['form']) ? do_shortcode('[gravityform id="'.$fields['overlay']['form']['id'].'" title="false" description="false"]') : '' ).'</div>
                </div>
            </div>
        </div>
    ';
    
    // write the overlay
    $return['overlay'] .= sprintf(
        $guide['overlay']
        ,(!empty($fields['overlay']['image']['url']) ? $fields['overlay']['image']['url'] : '')
        ,(!empty($fields['overlay']['heading']) ? '<div class="popup_heading">'.$fields['overlay']['heading'].'</div>' : '')
        ,(!empty($fields['overlay']['details']) ? '<div class="popup_details">'.$fields['overlay']['details'].'</div>': '')
    );
    
    // echo the overlay
    // the overlay is initially hidden
    // this will be the first content within the <body>
    echo $return['overlay'];

    // clear all the vars we used to protect the rest of the document
    unset($return, $guide, $fields);
 ?>