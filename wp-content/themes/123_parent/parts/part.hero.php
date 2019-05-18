<?php 
/**
 * Partial
 * Hero Section
 */
    $fields = get_fields($post->ID);
    // detect hero type
    $type = $fields['choose_hero_type'];
    // a hero is either not selected, or no hero is selected
    if( $type == 'none' || empty($type) )
    {
        $content_hero = '';        
    }
    // we have a hero type selected
    else 
    {

        // get all fields (options table)
        $foreground = (!empty(get_field('hero_foreground')) ? get_field('hero_foreground') : '' );
        $background = (!empty(get_field('hero_background')) ? get_field('hero_background') : '' );
        // foreground
        $logo = (!empty($foreground['hero_logo']) ) ? $foreground['hero_logo'] : '';
        $title = (!empty($foreground['hero_title']) ) ? $foreground['hero_title'] : '';
        $tagline = (!empty($foreground['hero_tagline']) ) ? $foreground['hero_tagline'] : '';
        $button = (!empty($foreground['hero_button']) ) ? $foreground['hero_button'] : '';
        // background
        $static_image = (!empty($background['hero_static_image']) ? $background['hero_static_image'] : '' );
        $slider_images = (!empty($background['hero_slider_images']) ? $background['hero_slider_images'] : '' );
        
        // open hero container
        $content_hero = '<section class="hero site__fade site__fade-up" id="hero_'.$type.'">';

        // hero type is static image
        if( $type == 'image' && !empty($static_image))
        {
    
            $format_hero = '
                <div class="hero-bgimg" style="background-image: url(%s)" id="hero_staticimage">
                    <div class="hero_foreground">
                        %s
                        %s
                        %s
                        %s
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
                <div class="hero_video-container">
                    <video id="video_tag" autoplay muted loop title="%s"> 
                        <source src="%s" type="video/mp4">
                    </video>
                </div>
                <div class="hero_foreground">
                    %s
                    %s
                    %s
                    %s
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