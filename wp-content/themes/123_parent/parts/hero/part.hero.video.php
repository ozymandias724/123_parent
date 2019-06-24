<?php 
/**
 * Hero Include: Video Background
*/
$return['vol_controls'] = '<i class="fa fa-user"></i>';
// 
// 
// config the <video> element
$guide['video'] = '
    <video autoplay %s %s>
        <source src="%s" type="video/mp4">
    </video>
';
// write the <video> element
$return['video'] = sprintf(
    $guide['video'],
    (!empty($bg['video']['options']['loop']) ? 'loop' : ''),
    (!empty($bg['video']['options']['muted']) ? 'muted' : ''),
    ($bg['video']['source'] == 'file' ? $bg['video']['file']['url'] : $bg['video']['url'])
);

// write teh final return string
$guide['hero'] = '
    %s
    %s
    %s
';
$return['hero'] = sprintf(
    $guide['hero'],
    $return['video'],   // the video element and its stuff
    $return['fg']      // the foreground
    ,'<div class="hero_bgtint" style="'.$return['bgtint'].'"></div>'
);
echo $return['hero'];
?>