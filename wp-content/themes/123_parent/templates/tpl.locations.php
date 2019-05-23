<?php 
/**
 * Template Name: Locations Page
 */

   $args_posts = array(
      'posts_per_page' => -1
      ,'post_type' => 'areas-served'
   );

   $res1 = get_posts($args_posts);

   $args_page = array(
      'posts_per_page' => 1
      ,'post_type' => 'page'
      ,'pagename' => 'locations'
   );

   $res2 = get_posts($args_page);

   $fields = get_fields($res2[0]);

   function _get_social_media($ID){

      $return = '<ul class="site__social-media">';
      $format = '
          <li>
              <a href="%s" title="%s">
                  %s
              </a>
          </li>
      ';
      
      $location_content = get_fields($ID);
      $social_icons = $location_content['content']['social_media'];

      if(!empty($social_icons))
      {
          foreach($social_icons['icons'] as $social_icon)
          {
              $link = (!empty($social_icon['link']) ? $social_icon['link']['url'] : '');
              $title = (!empty($social_icon['link']) ? $social_icon['link']['title'] : '');

              if(!empty($social_icon['icon']))
              {
                  $icon = (!empty($social_icon['icon']) ? $social_icon['icon'] : '');
                  $return .= sprintf(
                      $format
                      ,$link
                      ,$title
                      ,$icon
                  );
              }
              else if(!empty($social_icon['image']))
              {
                  $image = (!empty($social_icon['image']) ? '<div class="location_social_image" style="background-image:url('.$social_icon['image']['url'].');"></div>' : '');
                  $return .= sprintf(
                      $format
                      ,$link
                      ,$title
                      ,$image
                  );
              }
          }
      }
      
      $return .= '</ul>';

      return $return;
  }

  function _get_address($ID)
  {
      $return = '';
      $location_content = get_fields($ID);
      $address = (!empty($location_content['content']['address']) ? $location_content['content']['address'] : '');
      if(!empty($address))
      {
          $postal = '';
          if(!empty($address['address_is_postal']))
          {
              $is_postal = $address['address_is_postal'];
              if($is_postal)
              {
                  $postal = '<p>Postal Address:</p>';
              }
          }  
          $street_1 = (!empty($address['address_street']) ? $address['address_street'] : '');
          $street_2 = (!empty($address['address_street_2']) ? $address['address_street_2'] : '');
          $city = (!empty($address['address_city']) ? $address['address_city'] : '');
          $state = (!empty($address['address_state']) ? $address['address_state'] : '');
          $postcode = (!empty($address['address_postcode']) ? $address['address_postcode'] : '');

          $format = '
              <div class="location_address">
                  %s
                  <p>%s %s</p> 
                  <p>%s, %s %s</p>
              </div>'; 
          $return = sprintf(
              $format
              ,$postal
              ,$street_1
              ,$street_2
              ,$city
              ,$state
              ,$postcode
          );
      }
      
      return $return; 
  }
  
  // if we have locations
  if( !empty($fields['content']['locations']) ){
      $apikey = get_gmaps_api_key();
      
      $heading = ( !empty( $fields['content']['heading'] ) ? '<h2 class="site__fade site__fade-up">'.$fields['content']['heading'].'</h2>' : '');
      $details = ( !empty( $fields['content']['details'] ) ? '<div class="site__fade site__fade-up">'.$fields['content']['details'].'</div>' : '');
      
      $return_locations = '
          <section class="mod__featured_grid">
              <div class="container">
              '.$heading.'
              '.$details.'
              <div class="site__grid"><ul>
      ';
      
      $format_location = '
          <li class="site__fade site__fade-up">
              <a href="%s">
                  %s
                  <div class="location_content">
                      <p class="location_heading">%s</p>
                      %s
                  </div>
              </a>
          </li>
      '; 

      foreach( $res1 as $key => $location ){

          $location_fields = get_fields($location->ID);
          
          $return_locations .= sprintf(
              $format_location
              ,get_permalink($location->ID)
              ,(!empty($location_fields['content']['image']['url']) ? '<div class="site__bgimg image"><div class="site__bgimg_img" style="background-image: url('.$location_fields['content']['image']['url'].')"></div></div>': '')
              ,(!empty($location_fields['content']['heading']) ? $location_fields['content']['heading'] : '')
              ,_get_address($location->ID)
          );
      }
      $return_locations .= '</ul></div>';

      $return_locations .= '
              </div>
          </section>
      ';
  }

    get_header();
 ?>
<main id="page_locations">
<?php include( get_template_directory() . '/parts/part.hero.php'); ?>
<?php 
   echo $return_locations;
?>
</main>
<?php 
    get_footer();
 ?>