<?php 
/**
*   Partial
*   Hero Section
*/

$fields = get_fields( get_the_ID() );

$header = 'header__' . get_field('header', 'options')['style'];

// 
// 
// Get Foreground
$fg = ( !empty($fields['foreground'] ) ? $fields['foreground'] : '');
// Get Background
$bg = (!empty($fields['background']) ? $fields['background'] : '');


// options
$return['fgbgtint'] = '';
if (!empty($fg['options']['background_tint'])) {
    $return['fgbgtint'] = ' background-color: rgba(' . hex2rgb($fg['options']['background_tint']) . ',' . $fg['options']['tint_opacity'] . ')';
}

// 
// 
// FG CONTENT
$return['fg_content'] = '';

if( !empty($fg['content']) ){
    foreach ($fg['content'] as $row) {
        // 
        if ($row['acf_fc_layout'] == 'large_text') {
            // 
            $return['fg_content'] .= '<h1>'.$row['text'].'</h1>';
        }
        // 
        else if ($row['acf_fc_layout'] == 'small_text') {
            // 
            $return['fg_content'] .= '<p>'.$row['text'].'</p>';
        }
        // 
        else if ($row['acf_fc_layout'] == 'image') {
            // wrap the image with anchor if link url exists
            if( !empty($row['url']) ) {
                $return['fg_content'] .= '<a title="'.$row['url']['title'].'" target="'.$row['url']['target'].'" href="' . $row['url']['url'] . '">';
            } 

            $return['fg_content'] .= '<img alt="' . $row['image']['alt'] . '" src="' . $row['image']['url'] . '" />';
            
            if ( !empty($row['url']) ) {
                $return['fg_content'] .= '</a>';
            } 
        }
    }
}

// fg button
$return['button'] = '';

if (!empty($fg['button']['link']['url'])) {
    $guide['button'] = '
        <a class="site__button" href="%s" title="%s" target="%s">%s</a>
    ';
    $return['button'] = sprintf(
        $guide['button'],
        (!empty($fg['button']['link']['url']) ? $fg['button']['link']['url'] : ''),
        (!empty($fg['button']['link']['title']) ? $fg['button']['link']['title'] : ''),
        (!empty($fg['button']['link']['target']) ? $fg['button']['link']['target'] : ''),
        (!empty($fg['button']['link']['title']) ? $fg['button']['link']['title'] : '')
    );
}


// fg return guide
$guide['fg'] = '
    <div style="%s %s" class="%s %s hero_foreground" >
        %s
        %s
    </div>
';

// fg return string
$return['fg'] = sprintf(
    $guide['fg']
    ,$return['fgbgtint']
    ,( !empty($bg['color']['text_color']) ? 'color:'.$bg['color']['text_color'].';' : '')
    ,( !empty($fg['options']['placement']) ? $fg['options']['placement'] : '')
    ,( !empty($fg['options']['width']) ? $fg['options']['width'] : '')
    ,$return['fg_content']
    ,$return['button']
);
// 
// 
// End Foreground

// 
// 

$return['bgtint'] = '';
if (!empty($bg['background_tint'])) {
    $return['bgtint'] = ' background-color: rgba('.hex2rgb($bg['background_tint']).','. $bg['tint_opacity'].')';
}

// check bg type
$type = $fields['hero_type'];


if( $type !== 'none' ){
    
    // open hero container
    echo '<section class="hero site__fade site__fade-up" id="hero_'.$type.'">'; 
    
    // static image
    
    if( $type == 'image' ){
        
        echo '<div class="image" style="background-image: url('.$bg['image']['image']['url'].')">'.$return['fg'].'</div>';

    }
    
    else if( $type == 'slider' ){
        // 
        if ($bg['slider']['randomize']) {
            shuffle($slider_images);
        }

        if (!empty($bg['slider']['images'])) {
            $slider = '<div id="slick_slider_hero">';
            foreach ($bg['slider']['images'] as $i => $image) {
                $slider .= '<div><img class="slider_img" alt="' . $image['alt'] . '" src="' . $image['url'] . '"></div>';
            }
            $slider .= '</div>';
        }

        echo $return['fg'];
        echo $slider;
        
    }
    
    else if( $type == 'video'){
        // 
        include(get_template_directory().'/parts/hero/part.hero.video.php');
    }
    
    else if( $type == 'color' ){
        // 
        echo $return['fg'];
        echo '<div class="hero_bgtint" style="background-color:'.$bg['color']['fill_color'].';"></div>';
    }
    // close hero container
    echo '</section>'; 
}

?>