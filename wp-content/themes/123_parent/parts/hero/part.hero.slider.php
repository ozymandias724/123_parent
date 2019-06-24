<?php

$slider_images = (!empty($background['slider']['images']) ? $background['slider']['images'] : '');
$slider_randomize = (!empty($background['slider']['randomize']) ? $background['slider']['randomize'] : '');

if ($slider_randomize) {
    shuffle($slider_images);
}


$slider = '<div id="slick_slider_hero">';

foreach ($slider_images as $i => $image) {
    $slider .= '<div><img class="slider_img" alt="' . $image['alt'] . '" src="' . $image['url'] . '"></div>';
}

$slider .= '</div>';

$format_hero = '
        %s
        <div style="%s %s" class="hero_foreground ' . $width . '">
            <div class="hero_foreground_grid %s">
                %s
                %s
                %s
                %s
            </div>
        </div>
    ';
$content_hero .= sprintf(
    $format_hero,
    $slider,
    $background_color,
    $foreground_color,
    (!empty($placement) ? $placement : '') // placement
    ,
    $title,
    $logo,
    $tagline,
    (!empty($button['link']) ? '<a class="site__button" style="' . $button_text_color . $button_bg_color . '" href="' . $button_url . '" title="' . $button_title . '" target="' . $button_target . '">' . $button_title . '</a>' : '')
);


 ?>