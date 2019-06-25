<?php 
/**
 * Template Name: Contact Page
 */

$fields = get_fields(get_the_ID());

if( !function_exists('return_column_content') ){

   /**
    * return the content for a column
    *
    * @param array $column
    * @return void
    */
   function return_column_content( $column ){

       // reset the column return string
       $return['column'] = '';
       
       // guide string for a location
       $guide['locations'] = '
           <li class="site__fade site__fade-up">
               %s
               <div>
                   %s
                   %s
                   %s
                   %s
                   %s
               </div>
               <a class="site__button" href="javascript:;">Directions</a>
           </li>
       ';
       
       if( !empty($column) ){

           // each row in this column (acf flex content layouts)
           foreach( $column as $i => $row ){

               // check which layout this row is
               switch ( $row['acf_fc_layout'] ) {

                  // this row is a locations block
                  case 'locations':

                     // open the locations wrapper
                     $return['column'] .='<ul class="locations">';

                     // loop thru location items
                     if( !empty($row['locations']) ){

                        foreach( $row['locations'] as $location ){

                              // get this location posts fields
                              $fields = get_fields($location['location']->ID);

                              // shorten using the address field (bad practice tho)
                              $address = ( !empty($fields['content']['address']) ? $fields['content']['address'] : '');
                              
                              // write this location to the return string for the column
                              $return['column'] .= sprintf(
                                 $guide['locations']
                                 ,( !empty($fields['content']['heading']) ? '<h3 class="area__heading">'.$fields['content']['heading'].'</h3>' : '')
                                 ,( !empty($address['address_street']) ? '<p class="area__address-1">'.$address['address_street'].'</p>' : '')
                                 ,( !empty($address['address_street_2']) ? '<p class="area__address-2">'.$address['address_street_2'].'</p>' : '')
                                 ,'<span class="area__city-state-post">'.$address['address_city'] . ', ' . $address['address_state'] . ' ' . $address['address_postcode'].'</span>'
                                 ,( !empty($fields['content']['phone_number_1']) ? '<br><a class="area__phone-1" href="tel:'.$fields['content']['phone_number_1'].'"><span>Phone: </span>'.$fields['content']['phone_number_1'].'</a>' : '' )
                                 ,( !empty($fields['content']['phone_number_2']) ? '<br><a class="area__phone-2" href="tel:'.$fields['content']['phone_number_2'].'"><span>Phone: </span>'.$fields['content']['phone_number_2'].'</a>' : '' )
                              );
                        }
                     }
                     // close the locations wrapper
                     $return['column'] .= '</ul>';
                     break;

                  case 'form':
                     $return['column'] .= '<div class="contact__block-form site__fade site__fade-up"><p>Send Us An Email</p>'.do_shortcode('[gravityform id="'.$row['form']['id'].'" title="false" description="false"]').'</div>';
                     break;

                  default:
                     # code...
                     break;
               }
           }
       }
       return $return['column'];
   }
}


// set return and guide string arrays
$return = [];
$guide = [];

// guide string for the section
$guide['section'] = '
   <section class="page__template tpl_page_contact">
       <div class="container %s">
           %s
           %s
           <ul class="columns">
               <li class="left">%s</li>
               <li class="right">%s</li>
           </ul>
       </div>
   </section>
';

// if left has rows
$return['left'] = '';
$return['right'] = '';

$return['left'] .= return_column_content($fields['left']);
$return['right'] .= return_column_content($fields['right']);

$return['section'] = '';

// write all the content we can into the opening until the left/right part
$return['section'] .= sprintf(
   $guide['section']
   
   ,( !empty( $fields['width'] ) ? $fields['width'] : '' ) // container width

   ,( !empty($fields['heading']) ? '<h2 class="block__heading site__fade site__fade-up">'.$fields['heading'].'</h2>' : '' )

   ,( !empty($fields['text']) ? '<div class="block__details site__fade site__fade-up">'.$fields['text'].'</div>' : '' )

   ,$return['left']

   ,$return['right']
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