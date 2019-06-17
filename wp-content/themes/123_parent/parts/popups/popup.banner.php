<?php 
/**
*  Banner Popup
*  This file is only loaded if the banner popup exists; conditionals handled before call
*/
    // empty overlay return
    $return['overlay'] = '';
    // empty button return
    $return['button'] = '';

    $guide['button'] = '';
    $guide['overlay'] = '';

    // get fields
    $fields = get_field('popups', 'options')['banner'];

    // overlay guide
    $guide['overlay'] = '
        <div id="popups__banner_overlay">
            <i class="fas fa-times overlay__closebutton"></i>
            <div class="container">
                <figure><img src="%s"></figure>
                <div>
                    %s
                    %s
                    <div class="popup_form">'.( !empty($fields['overlay']['form']) ? do_shortcode('[wpforms id="'.$fields['overlay']['form']->ID.'" title="false" description="false"]') : "").'</div>
                </div>
            </div>
        </div>
    ';
    
    
    if( !empty($fields['button']['text'])){
        // button guide
        $guide['button'] = '<div id="popups__banner"><a href="javascript:;"><span>%s</span></a></div>';
        // write the button (so semantic!)
        $return['button'] .= sprintf(
            $guide['button']
            ,$fields['button']['text']
        );
    }
    
    if( !empty($fields['overlay']['heading'])){
        // write the overlay
        $return['overlay'] .= sprintf(
            $guide['overlay']
            ,(!empty($fields['overlay']['image']['url']) ? $fields['overlay']['image']['url'] : '')
            ,(!empty($fields['overlay']['heading']) ? '<div class="popup_heading">'.$fields['overlay']['heading'].'</div>' : '')
            ,(!empty($fields['overlay']['details']) ? '<div class="popup_details">'.$fields['overlay']['details'].'</div>': '')
        );
    }
    
    // echo the overlay and the button
    // the overlay is initially hidden
    // this will be the first content within the <body>
    echo $return['button'];
    echo $return['overlay'];

    // clear all the vars we used to protect the rest of the document
    unset($return, $guide, $fields);
 ?>