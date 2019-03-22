<?php 
/**
 * Partial
 * Hero Section
 */
    // detect hero type
    $type = get_field('choose_hero_type', 'options');
    // a hero is either not selected, or no hero is selected
    if( $type == 'none' || empty($type) ){
        $content_hero = '';        
    }
    // we have a hero type selected
    else {

        // get all fields (options table)
        $logo = (!empty(get_field('hero_logo', 'options')) ? get_field('hero_logo', 'options') : '' );
        $title = (!empty(get_field('hero_title', 'options')) ? get_field('hero_title', 'options') : '' );
        $tagline = (!empty(get_field('hero_tagline', 'options')) ? get_field('hero_tagline', 'options') : '' );
        $button = (!empty(get_field('hero_button', 'options')) ? get_field('hero_button', 'options') : '' );
        $video = (!empty(get_field('hero_video', 'options')) ? get_field('hero_video', 'options') : '' );
        $static_image = (!empty(get_field('hero_static_image', 'options')) ? get_field('hero_static_image', 'options') : '' );
        $slider_images = (!empty(get_field('hero_slider_images', 'options')) ? get_field('hero_slider_images', 'options') : '' );
        $hero_style = (!empty(get_field('choose_hero_style_without_the_logo', 'options')) ? get_field('choose_hero_style_without_the_logo', 'options') : '' );
        $hero_logo_style = (!empty(get_field('choose_hero_style_with_the_logo', 'options')) ? get_field('choose_hero_style_with_the_logo', 'options') : '' );
        

        // open hero container
        $content_hero = '<section class="hero">';


        // hero type is static image
        if( $type == 'image'){
        
            // $format_hero = '
            //     <div class="hero-bgimg" style="background-image: url(%s)" id="hero_staticimage">
            //         <div>
            //             %s
            //             %s
            //             %s
            //         </div>
            //     </div>
            // ';
            // $content_hero .= sprintf(
            //     $format_hero
            //     ,$static_image['url']
            //     ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
            //     ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
            //     ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
            // );

            if(
                $hero_style == 'hero_1' || 
                $hero_style == 'hero_2' || 
                $hero_style == 'hero_3' || 
                $hero_style == 'hero_4'
            ){
                $format_hero = '
                    <div class="hero-bgimg %s" style="background-image: url(%s)" id="hero_staticimage">
                        <div>
                            <div>
                                %s
                                %s
                                %s
                            </div>
                        </div>
                    </div>
                ';
                $content_hero .= sprintf(
                    $format_hero
                    ,$hero_style
                    ,$static_image['url']
                    ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
                    ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
                    ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
                );
            }else if(isset($logo)){
                $format_hero = '
                    <div class="hero-bgimg logo" id="hero_staticimage">
                        <div style="background-image: url(%s)"></div>
                    </div>
                ';
                $content_hero .= sprintf(
                    $format_hero
                    ,$logo['url']
                );
            }
        }

        // hero type is slider
        else if( $type == 'slider' ){
            $format_hero = '';
            $content_hero .= sprintf(
                $format_hero
            );
        }

        // hero type is video
        else if( $type == 'video' ){
            $format_hero = '';
            $content_hero .= sprintf(
                $format_hero
            );
        }

        // close hero container
        $content_hero .= '</section>';
    }

    // echo hero
    echo $content_hero;
 ?>