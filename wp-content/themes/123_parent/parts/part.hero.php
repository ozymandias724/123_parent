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

      $placement = ( !empty($foreground['placement'] ) ? $foreground['placement'] : '');

      $background_color = ( !empty($foreground['background_color'] ) ? 'color:'.$foreground['background_color'].';' : '');
      $foreground_color = ( !empty($foreground['foreground_color'] ) ? 'background-color:'.$foreground['foreground_color'].';' : '');
      $title = ( !empty($foreground['hero_title'] ) ? '<h2>'.$foreground['hero_title'].'</h2>' : '');
      $logo = ( !empty($foreground['hero_logo'] ) ? '<img alt="'.$foreground['hero_logo']['alt'].'" src="'.$foreground['hero_logo']['url'].'" />' : ''); 
      $tagline = ( !empty($foreground['hero_tagline'] ) ? '<p>'.$foreground['hero_tagline'].'</p>' : '');
      
      // Foreground Button fields
      $button = $foreground['button'];
      $button_text_color = ( !empty($foreground['button']['foreground_color'] ) ? 'color:'.$foreground['button']['foreground_color'].';' : '');
      $button_bg_color = ( !empty($foreground['button']['background_color'] ) ? 'background-color:'.$foreground['button']['background_color'].';' : '');
      $button_url = ( !empty($foreground['button']['link']['url'] ) ? $foreground['button']['link']['url'] : '');
      $button_title = ( !empty($foreground['button']['link']['title'] ) ? $foreground['button']['link']['title'] : '');
      $button_target = ( !empty($foreground['button']['link']['target'] ) ? $foreground['button']['link']['target'] : '');

      // Video fields

      // open hero container
      $content_hero = '<section class="hero site__fade site__fade-up" id="hero_'.$style.'">'; 

      // static image
      if( $style == 'image' && !empty($background_image) ){

         $format_hero = '
            <div style="background-image: url(%s)" title="%s" id="hero_staticimage">
               <div style="%s %s" class="hero_foreground container '.$width.'">
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

            ,$background_color
            ,$foreground_color
            ,$title
            ,$logo
            ,$tagline
            ,( !empty($button['link']) ? '<a style="'. $button_text_color . $button_bg_color .'" href="'.$button_url.'" title="'.$button_title.'" target="'.$button_target.'">'.$button_title.'</a>' : '')
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
            <div style="%s %s" class="hero_foreground container '.$width.'">
               %s
               %s    
               %s
               %s
            </div>
         ';
         $content_hero .= sprintf(
            $format_hero
            ,$slider

            ,$background_color
            ,$foreground_color
            ,$title
            ,$logo
            ,$tagline
            ,( !empty($button['link']) ? '<a style="'. $button_text_color . $button_bg_color .'" href="'.$button_url.'" title="'.$button_title.'" target="'.$button_target.'">'.$button_title.'</a>' : '')
         );
         
      // video
      }else if( $style == 'video' && !empty($background_video) ){

         $format_hero = '
            <div>
               <video title="%s" autoplay muted loop> 
                  <source src="%s" type="video/mp4">
               </video>
               <div style="%s %s" class="hero_foreground container '.$width.'"> 
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

            ,$background_color
            ,$foreground_color
            ,$title
            ,$logo
            ,$tagline
            ,( !empty($button['link']) ? '<a style="'. $button_text_color . $button_bg_color .'" href="'.$button_url.'" title="'.$button_title.'" target="'.$button_target.'">'.$button_title.'</a>' : '')
         );
         
      }
      // close hero container
      $content_hero .= '</section>'; 
   }

   // echo hero
   echo $content_hero;
    
 ?>