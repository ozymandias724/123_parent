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
        
        // open hero container
        $content_hero = '<section class="hero">';

        // hero type is static image
        if( $type == 'image'){
    
            $format_hero = '
                <div class="hero-bgimg" style="background-image: url(%s)" id="hero_staticimage">
                    <div>
                        <div>
                            %s
                            %s
                            %s
                            %s
                        </div>
                    </div>
                </div>
            ';
            $content_hero .= sprintf(
                $format_hero
                ,$static_image['url']
                ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
                ,( !empty($logo) ) ? '<img src="'.$logo['url'].'"/>' : ''
                ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
                ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
            );

        }

        // hero type is slider 
        else if( $type == 'slider' ){

            // If slider_images variable is not empty
            if(!empty($slider_images)){
                //Create slider content variable
                $content_slider_images = "<div id='slick-images'>";
                //For each slider image 
                foreach($slider_images as $slider_key => $slider_value){
                    //Concatenate img div as a background image with slider url and alt text
                    $content_slider_images .= '<div class="img-slick" style="background-image: url('.$slider_value['url'].'); "></div>';
                }
                //Close end tag of slider content 
                $content_slider_images .= "</div>";
            }

            $format_hero = '
                <div class=hero-bgslider" id="hero_slider">
                    <div>
                        %s
                        <div>
                            %s
                            %s
                            %s
                            %s
                        </div>
                        <a href="javascript:;" id="slick-pause"><i class="fa fa-pause" aria-hidden="true"></i></a>
                        <a href="javascript:;" id="slick-play"><i class="fa fa-play" aria-hidden="true"></i></a>
                    </div>
                </div>
            ';
            $content_hero .= sprintf(
                $format_hero
                ,( !empty($content_slider_images) ) ? $content_slider_images : ''
                ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
                ,( !empty($logo) ) ? '<img src="'.$logo['url'].'"/>' : ''
                ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
                ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
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