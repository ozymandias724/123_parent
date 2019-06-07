<?php 
/**
 * Partial
 * Hero Section
 */
    
   $fields = get_fields($post->ID);

   // detect hero type
   $style = $fields['style'];

   // a hero is either not selected, or no hero is selected
   if( $style == 'none' || empty($style) ){
      
      $content_hero = '';        
     
   // we have a hero type selected
   }else {
      // get background and foreground
      $background = ( !empty($fields['background'] ) ? $fields['background'] : '');
      $foreground = ( !empty($fields['foreground'] ) ? $fields['foreground'] : '');

      // get background fields
      $background_image = ( !empty($background['image'] ) ? $background['image']['url'] : '');
      $background_video = ( !empty($background['video']['file'] ) ? $background['video']['file']['url'] : '');
      $slider_images = ( !empty($background['slider']['images'] ) ? $background['slider']['images'] : '');
      $slider_randomize = ( !empty($background['slider']['randomize'] ) ? $background['slider']['randomize'] : '');
      if($slider_randomize){
         shuffle($slider_images);
      }

      // get foreground fields
      $width = ( !empty($foreground['width'] ) ? $foreground['width'] : '');
      $placement = ( !empty($foreground['placement'] ) ? $foreground['placement'] : '');
      $title = ( !empty($foreground['hero_title'] ) ? $foreground['hero_title'] : '');
      $logo = ( !empty($foreground['hero_logo'] ) ? $foreground['hero_logo']['url'] : ''); 
      $tagline = ( !empty($foreground['hero_tagline'] ) ? $foreground['hero_tagline'] : '');
      $button = ( !empty($foreground['hero_button'] ) ? $foreground['hero_button'] : '');

      // open hero container
      $content_hero = '<section class="hero site__fade site__fade-up" id="hero_'.$style.'">'; 

      // static image
      if( $type == 'image' && !empty($background_image)){

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
            ,$background_image
            ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
            ,( !empty($logo) ) ? '<img src="'.$logo.'"/>' : ''
            ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
            ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
         );
         
      // slider
      } else if($style == 'slider' && !empty($slider_images)) {  
         
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
            ,$slider
            ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
            ,( !empty($logo) ) ? '<img src="'.$logo.'"/>' : ''
            ,( !empty($tagline) ) ? '<p>'.$tagline.'</p>' : ''
            ,( !empty($button) ) ? '<a href="'.$button['url'].'" title="" target="'.$button['target'].'">'.$button['title'].'</a>' : ''
         );
         
      // video
      }else if( $type == 'video' && !empty($background_video) ){

         $format_hero = '
            <div class="container">
               <video autoplay muted loop> 
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
            ,$background_video
            ,( !empty($title) ) ? '<h2>'.$title.'</h2>' : ''
            ,( !empty($logo) ) ? '<img src="'.$logo.'"/>' : ''
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