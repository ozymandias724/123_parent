<?php 
/**
 * Template Name: Menu Page
 * Description: TBD
 */
$args = array(
   'post_type' => 'food_menus'
   ,'posts_per_page' => -1
);


$res = get_posts($args);
$fields = get_fields(get_the_id());


$guide = [];
$return = [];

$return['section'] = '';

// Functions 
function get_menu_items($menu_style, $item){
   switch($menu_style){
      case 'menu_photo_list': 
      $format = '
            <li class="menu_item site__fade site__fade-up">
               %s
               <div>
                  <h3>%s</h3>
                  <div class="menu__item-description">%s</div>
                  %s
               </div>
            </li>
      ';

      $return = sprintf(
            $format
            ,(!empty($item['image']) ? '<div class="image_provided block" style="background-image:url('.$item['image']['url'].');"></div>' : '')
            ,(!empty($item['title']) ? $item['title'] : '')
            ,(!empty($item['description']) ? $item['description'] : '')
            ,(!empty($item['price']) ? '<div class="menu__item-price">$'.$item['price'].'</div>' : '')
      );
      break;

      case 'menu_photo_tiled_x3':
      $price = (!empty($item['price']) ? $item['price'] : '');
      $priceArr = explode('.',$price);
      $format = '
            <li class="menu_item site__fade site__fade-up">
               %s
               <h3 class="menu__item-price">%s <div>$%s.<span>%s</span></div></h3>
               <div class="menu__item-description">%s</div>
            </li>
      ';

      $return = sprintf(
            $format
            ,(!empty($item['image']) ? '<div class="image_provided block" style="background-image:url('.$item['image']['url'].');"></div>' : '')
            ,(!empty($item['title']) ? $item['title'] : '')
            ,$priceArr[0]
            ,$priceArr[1]
            ,(!empty($item['description']) ? $item['description'] : '')
      );
      break;

      default: 
      $format = '
            <li class="menu_item site__fade site__fade-up">
               <h3 class="menu__item-price">%s <span class="menu_price">%s</span></h3>
               <div class="menu__item-description">%s</div>
            </li>
      ';
      
      $return = sprintf(
            $format
            ,(!empty($item['title']) ? $item['title'] : '')
            ,(!empty($item['price']) ? $item['price'] : '')
            ,(!empty($item['description']) ? $item['description'] : '')
      );
      break;
   }
   return $return;
}

// If there are menu posts added to the Food Menus block
if( !empty($res) ){

   // open buttons and menus container
   $return['buttons_and_menus'] = '<div id="tabs_style__'.$fields['tabs_style'].'" class="tabs">'; 
   
   // open buttons wrapper (sibling of content area)
   $return['buttons'] = '<ul class="button_group">';
   
   // open wrapper for the menus area (sibling of buttons)
   $return['menus'] = '<div class="menu_area tabs_style__'.$fields['tabs_style'].'">';

   // for each menu
   foreach( $res as $i => $menu ){

      // get fields for this menu post object
      $menu_fields = get_fields($menu->ID);

      // guide for a button (pill etc)
      $guide['buttons'] = '
            <li class="'.( ($i===0) ? 'tab_active' : '' ).'">
               <a href="javascript:;">%s</a>
            </li>
      ';
      
      // write to the button group
      $return['buttons'] .= sprintf(
            $guide['buttons'] 
            ,$menu->post_title
      );

      // if this menu post has menu sections
      if( !empty($menu_fields['menu_sections']) ){

            if($menu_fields['style'] !== 'menu_text_sub_group_half'){
               // open the wrapper for the menu sections
               $return['menu_sections'] = '<ul class="menu_section '.$menu_fields['style'].( ($i===0) ? ' current_food_menu ' : ' hidden_food_menu ' ).'">';
            }else{
               // open the wrapper for the menu sections
               $return['menu_sections'] = '<ul class="menu_section '.$menu_fields['style'].' menu_flex '.( ($i===0) ? ' current_food_menu ' : ' hidden_food_menu ' ).'">';
            }

            // loop thru each menu section (rows in the repeater)
            foreach( $menu_fields['menu_sections'] as $i => $section ){

               // Menu Header Format
               if($menu_fields['style'] !== 'menu_text_sub_group_half'){
                  $header_format = '
                        <h2><span>%s</span></h2>
                        %s
                  ';
               }else{
                  $header_format = '
                        <div><h2><span>%s</span></h2>
                        %s
                  ';
               }

               // Menu Title and Description
               $return['menu_sections'] .= sprintf(
                  $header_format
                  ,(!empty($section['title']) ? $section['title'] : '')
                  ,(!empty($section['description']) ? $section['description'] : '')
               );

               // Open Menu Items Content
               $return['menu_sections'] .= '<ul class="menu_items">';

               foreach( $section['item'] as $i => $item){
                  $return['menu_sections'] .=  get_menu_items($menu_fields['style'], $item);
               }

               // Close Menu Items Content
               if($menu_fields['style'] !== 'menu_text_sub_group_half'){
                  $return['menu_sections'] .= '</ul>';
               }else{
                  $return['menu_sections'] .= '</ul></div>';
               }
            }

            // close the menu sections wrapper
            $return['menu_sections'] .= '</ul>';

            // write this menu into the menus wrapper
            $return['menus'] .= $return['menu_sections'];
      }
   }

   // close buttons
   $return['buttons'] .= '</ul>';

   // close content
   $return['menus'] .= '</div>';
   
   // close buttons and menus container
   $return['buttons_and_menus'] .= $return['buttons'] . $return['menus'];
   
   $return['buttons_and_menus'] .= '</div>';
}

$guide['section'] = '
   <section class="page__template tpl_page_menu">
      <div class="container %s">
            %s
            %s
            %s
      </div>
   </section>
';

$return['section'] .= sprintf(
   $guide['section']
   
   ,( !empty( $fields['width'] ) ? $fields['width'] : '' )                                                         // container width
   
   ,( !empty($fields['heading']) ? '<h2 class="block__heading" style="text-align:'.$fields['heading_alignment'].';">'.$fields['heading'].'</h2>' : '' )

   ,( !empty($fields['text']) ? '<p class="block__details">'.$fields['text'].'</p>' : '' )

   // Return the food menus block content which is the buttons and menus
   ,( !empty($return['buttons_and_menus']) ? $return['buttons_and_menus'] : '' )

);


?>
<?php 
   get_header();
?>
<main>
<?php 
   include( get_template_directory() . '/parts/part.hero.php');
   echo $return['section'];
   unset($return, $guide);
?>
<?php 
   get_footer();
?>