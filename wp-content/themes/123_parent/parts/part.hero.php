<?php 
/**
 * Partial
 * Hero Section
 */
    
   $fields = get_fields($post->ID);

   print_r($fields);
   // detect hero type
   $style = $fields['style'];

   // a hero is either not selected, or no hero is selected
   if( $style == 'none' || empty($style) ){
      
      $content_hero = '';        
     
   // we have a hero type selected
   }else {

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

      // static image
      if( $type == 'image' && !empty($static_image)){

         $format_hero = '
            <div class="container" style="background-image: url(%s)" id="hero_staticimage">
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
         
      // slider
      } else if($type == 'slider' && !empty($slider_images)) {  
         
         $slider = '<div class="container"><div id="slick_slider_hero">';

         foreach( $slider_images as $i => $image ){
            $slider .= '<div><img class="slider_img" src="'.$image['url'].'"></div>';
         } 

         $slider .= '</div>';
         
         $format_hero = '
               %s
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
            ,( !empty($slider) ) ? $slider : ''
            ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
            ,( !empty($logo) ) ? '<img src="'.$logo['url'].'"/>' : ''
            ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
            ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
         );
         
      // video
      }else if( $type == 'video' && !empty($background['hero_video']) ){

         $video_url = $background['hero_video'];
         $format_hero = '
            <div class="container">
               <video id="video_tag" autoplay muted loop> 
                  <source src="%s" type="video/mp4">
               </video>
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