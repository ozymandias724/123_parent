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
      // Background and foreground fields
      $background = ( !empty($fields['background'] ) ? $fields['background'] : '');
      $foreground = ( !empty($fields['foreground'] ) ? $fields['foreground'] : '');

      // Background
      $background_image = ( !empty($background['image'] ) ? $background['image']['image'] : '');
      $background_video = ( !empty($background['video']['file'] ) ? $background['video']['file'] : '');

      // Slider fields
      $slider_images = ( !empty($background['slider']['images'] ) ? $background['slider']['images'] : '');
      $slider_randomize = ( !empty($background['slider']['randomize'] ) ? $background['slider']['randomize'] : '');

      if($slider_randomize){
         shuffle($slider_images);
      }

      // Foreground fields
      $width = ( !empty($foreground['width'] ) ? $foreground['width'] : '');
      $background_color = ( !empty($foreground['background_color'] ) ? $foreground['background_color'] : '');
      $foreground_color = ( !empty($foreground['foreground_color'] ) ? $foreground['foreground_color'] : '');
      $placement = ( !empty($foreground['placement'] ) ? $foreground['placement'] : '');
      $title = ( !empty($foreground['hero_title'] ) ? $foreground['hero_title'] : '');
      $logo = ( !empty($foreground['hero_logo'] ) ? $foreground['hero_logo'] : ''); 
      $tagline = ( !empty($foreground['hero_tagline'] ) ? $foreground['hero_tagline'] : '');
      $button = ( $foreground['button'] );

      // open hero container
      $content_hero = '<section class="hero site__fade site__fade-up" id="hero_'.$style.'">'; 

      // static image
      if( $style == 'image' && !empty($background_image) ){

         $format_hero = '
            <div style="background-image: url(%s)" title="%s" id="hero_staticimage">
               <div class="hero_foreground container '.$width.'">
                  %s
                  %s
                  %s
                  %s
               </div>
            </div>
         ';
         $content_hero .= sprintf(
            $format_hero
            ,$background_image['url']
            ,$background_image['alt']
            ,( !empty($title) ? '<h2>'.$title.'</h2>' : '')
            ,( !empty($logo['url'] ) ? '<img alt="'.$logo['alt'].'" src="'.$logo['url'].'"/>' : '')
            ,( !empty($tagline) ? '<p>'.$tagline.'</p>' : '')
            ,( !empty($button['link']) ? '<a href="'.$button['link']['url'].'" title="'.$button['link']['title'].'" target="'.$button['link']['target'].'">'.$button['link']['title'].'</a>' : '')
         );
         
      // slider
      } else if( $style == 'slider' && !empty($slider_images) ) {  
         
         $slider = '<div id="slick_slider_hero">';

         foreach( $slider_images as $i => $image ){
            $slider .= '<div><img class="slider_img" alt="'.$image['alt'].'" src="'.$image['url'].'"></div>';
         } 

         $slider .= '</div>';
         
         $format_hero = '
            %s
            <div class="hero_foreground container '.$width.'">
               %s
               %s    
               %s
               %s
            </div>
         ';
         $content_hero .= sprintf(
            $format_hero
            ,$slider
            ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
            ,( !empty($logo['url']) ) ? '<img alt="'.$logo['alt'].'" src="'.$logo['url'].'"/>' : ''
            ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
            ,( !empty($button['link']) ? '<a href="'.$button['link']['url'].'" title="'.$button['link']['title'].'" target="'.$button['link']['target'].'">'.$button['link']['title'].'</a>' : '')
         );
         
      // video
      }else if( $style == 'video' && !empty($background_video) ){

         $format_hero = '
            <div>
               <video title="%s" autoplay muted loop> 
                  <source src="%s" type="video/mp4">
               </video>
               <div class="hero_foreground container '.$width.'"> 
                  %s
                  %s
                  %s
                  %s
               </div>
            </div>
         ';
         $content_hero .= sprintf(
            $format_hero
            ,$background_vide['alt']
            ,$background_video['url']
            ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
            ,( !empty($logo['url']) ) ? '<img alt="'.$logo['alt'].'" src="'.$logo['url'].'"/>' : ''
            ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
            ,( !empty($button['link']) ? '<a href="'.$button['link']['url'].'" title="'.$button['link']['title'].'" target="'.$button['link']['target'].'">'.$button['link']['title'].'</a>' : '')
         );
         
      }
      // close hero container
      $content_hero .= '</section>'; 
   }

   // echo hero
   echo $content_hero;
    
 ?>