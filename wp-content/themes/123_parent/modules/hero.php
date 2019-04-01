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
        $foreground = (!empty(get_field('hero_foreground', 'options')) ? get_field('hero_foreground', 'options') : '' );
        $background = (!empty(get_field('hero_background', 'options')) ? get_field('hero_background', 'options') : '' );
        // foreground
        $logo = (!empty($foreground['hero_logo']) ) ? $foreground['hero_logo'] : '';
        $title = (!empty($foreground['hero_title']) ) ? $foreground['hero_title'] : '';
        $tagline = (!empty($foreground['hero_tagline']) ) ? $foreground['hero_tagline'] : '';
        $button = (!empty($foreground['hero_button']) ) ? $foreground['hero_button'] : '';
        // background
        $static_image = (!empty($background['hero_static_image']) ? $background['hero_static_image'] : '' );
        $slider_images = (!empty($background['hero_slider_images']) ? $background['hero_slider_images'] : '' );
        
        // open hero container
        $content_hero = '<section class="hero" id="hero_'.$type.'">';

        // hero type is static image
        if( $type == 'image' && !empty($static_image))
        {
    
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



        // slider
        else if($type == 'slider' && !empty($slider_images))
        {  
            // open return string
            $return_slider = '<div id="slick_slider">';

            foreach( $slider_images as $i => $rec )
            {
                $return_slider .= '<div><img class="slick_slider_img" src="'.$rec['url'].'"></div>';
            }

            $return_slider .= '</div>';
            
            $format_hero = '
                %s
                <div class="hero_foreground">
                    %s
                    %s
                    %s
                    %s
                </div>
                <a href="javascript:;" id="slick-pause" title="Pause slider button"><i class="fas fa-pause" aria-hidden="true"></i></a>
                <a href="javascript:;" id="slick-play" title="Play slider button"><i class="fas fa-play" aria-hidden="true"></i></a>
            ';
            $content_hero .= sprintf(
                $format_hero
                ,( !empty($return_slider) ) ? $return_slider : ''
                ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
                ,( !empty($logo) ) ? '<img src="'.$logo['url'].'"/>' : ''
                ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
                ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
            );
        }
        // /slider

        // hero type is video
        else if( $type == 'video' )
        {

            if( !empty($background['hero_video']) )
            {
                $video_url = $background['hero_video'];
            }
            
            $format_hero = '
                <div id="hero_video">
                    <video id="video_tag" autoplay muted loop title="%s"> 
                        <source src="%s" type="video/mp4">
                    </video>
                    <div>
                        %s
                        %s
                        %s
                        %s
                    </div>
                    <div>
                        <a href="javascript:;" id="video_pause" title="Pause video button"><i class="fa fa-pause" aria-hidden="true"></i></a>
                        <a href="javascript:;" id="video_play" title="Play video button"><i class="fa fa-play" aria-hidden="true"></i></a>
                    </div>
                </div>
            ';
            $content_hero .= sprintf(
                $format_hero
                ,( !empty($title) ) ? $title : ''
                ,( !empty($video_url) ) ? $video_url['url'] : ''
                ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
                ,( !empty($logo) ) ? '<img src="'.$logo['url'].'"/>' : ''
                ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
                ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
            );
        }

        // close hero container
        $content_hero .= '</section>'; 
    }

    // echo hero
    echo $content_hero;
    
 ?>