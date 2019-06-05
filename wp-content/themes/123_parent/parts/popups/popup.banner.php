<?php 
/**
*  Banner Popup
*  This file is only loaded if the banner popup exists; conditionals handled before call
*/
    // empty overlay return
    $return['overlay'] = '';
    // empty button return
    $return['button'] = '';

    // get fields
    $fields = get_field('popups', 'options')['banner'];

    // overlay guide
    $guide['overlay'] = '
        <div id="popups__banner_overlay">
            <div class="container">
                <figure><img src="%s"></figure>
                <div>
                    %s
                    %s
                    '.do_shortcode('[wpforms id="'.$fields['overlay']['form']->ID.'" title="false" description="false"]', $ignore_html).'
                </div>
                <i class="fas fa-times overlay__closebutton"></i>
            </div>
        </div>
    ';
    
    // button guide
    $guide['button'] = '<div id="popups__banner"><a href="javascript:;">%s</a></div>';
    
    // write the button (so semantic!)
    $return['button'] .= sprintf(
        $guide['button']
        ,$fields['button']['text']
    );
    // write the overlay
    $return['overlay'] .= sprintf(
        $guide['overlay']
        ,$fields['overlay']['image']['url']
        ,$fields['overlay']['heading']
        ,$fields['overlay']['details']
    );
    
    // echo the overlay and the button
    // the overlay is initially hidden
    // this will be the first content within the <body>
    echo $return['button'];
    echo $return['overlay'];

    // clear all the vars we used to protect the rest of the document
    unset($return, $guide, $fields);
 ?>