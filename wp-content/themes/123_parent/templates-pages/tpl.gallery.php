<?php 
/**
 * Template Name: Gallery Page
 * 
 */

$fields = get_fields(get_the_ID());

$return = [];
$return['tabs'] = '';
$return['section'] = '';
$guide = [];

// if we have galleries
if( !empty($fields['galleries']) ){

   $return['galleries'] = '';

   // set the galleries guide string
   $guide['galleries'] = '<li class="site__fade site__fade-up"><div><div class="image" style="background-image: url(%s)"></div></div></li>';
   // set the galleries return string
   $return['galleries'] .= '<div class="galleries">';

   // open the tabs list
   if( $fields['tab_type'] != 'none' ){
      $return['tabs'] .= '<div class="tabs site__fade site__fade-up"><ul>';
   }

   // loop thru the galleries
   foreach( $fields['galleries'] as $i => $gallery ){

      // create a tab for each gallery
      if( $fields['tab_type'] !== 'none' ){
            $return['tabs'] .= '<li class="'.( ($i === 0 ) ? 'tab_active' : '' ).'"><a href="javascript:;">'.$gallery['title'].'</a></li>';
      }

      // open the galleries grid
      if ( $fields['tab_type'] == 'none' ){
            $return['galleries'] .= '<div class="site__grid '.( ($i===0) ? 'current_gallery' : 'hidden_gallery' ).'"><h2 class="site__fade site__fade-up">'.$gallery['title'].'</h2><ul>';
      }else{
            $return['galleries'] .= '<div class="site__grid '.( ($i===0) ? 'current_gallery' : 'hidden_gallery' ).'"><ul>';
      }

      // loop thru the gallery images to create line items
      foreach( $gallery['images'] as $image ){
            $return['galleries'] .= sprintf(
               $guide['galleries']
               ,$image['url']
            );
      }
      $return['galleries'] .= '</ul></div>';
   }
   // close the tabs list
   if( $fields['tab_type'] !== 'none' ){
      $return['tabs'] .= '</ul></div>';
   }

   $return['galleries'] .= '</div>';
}

// empty guide string 
$guide['section'] = '
   <section class="page__template tpl_page_gallery">
      <div class="container %s">
            %s
            %s
            <div class="tabsandgrids_container '.$fields['tab_type'].'">
               %s
               %s
            </div>
      </div>
   </section>
';

$return['section'] .= sprintf(
   $guide['section']

   ,( !empty( $fields['width'] ) ? $fields['width'] : '' ) // container width

   ,( !empty($fields['heading']) ? '<h2 class="block__heading site__fade site__fade-up">'.$fields['heading'].'</h2>' : '' )

   ,( !empty($fields['text']) ? '<div class="block__details site__fade site__fade-up">'.$fields['text'].'</div>' : '' ) // gallery options

   ,( !empty($return['tabs']) ? $return['tabs'] : '' )

   ,( !empty($return['galleries']) ? $return['galleries'] : '' )
);


   get_header();
?>
<main>
<?php
   include( get_template_directory() . '/parts/part.hero.php');

   echo $return['section'];

   unset($return, $guide);

   get_footer();
?>