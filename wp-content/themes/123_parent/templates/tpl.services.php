<?php 
/**
 * Template Name: Services
 */

   $args_posts = array(
      'posts_per_page' => -1
      ,'post_type' => 'services'
   );

   $res1 = get_posts($args_posts);

   $args_page = array(
      'posts_per_page' => 1
      ,'post_type' => 'page'
      ,'pagename' => 'services'
   );

   $res2 = get_posts($args_page);

   $fields = get_fields($res2[0]);

   if( !empty($fields['featured_services']['services']) ){

      $heading = ( !empty( $fields['featured_services']['heading'] ) ? '<h2>'.$fields['featured_services']['heading'].'</h2>' : '');
      $details = ( !empty( $fields['featured_services']['details'] ) ? '<div>'.$fields['featured_services']['details'].'</div>' : '');
      
      $return_services = '
          <section class="mod__services-featuredservice mod__featured_grid">
              <div class="container">
                  '.$heading.'
                  '.$details.'
                  <div class="site__grid"><ul> 
      ';
      
      $format_service = '
         <li class="site__fade site__fade-up">
            <a href="%s">
               <div><div class="block" style="background-image:url(%s);"></div></div>
               <div>
                  <h5>%s</h5>
                  %s
                  <p class="service_price">%s</p>
               </div>
            </a>
         </li>
      ';

      foreach( $res1 as $i => $service ){

          $service_fields = get_fields($service->ID);
          
          if( $service_fields['status'] ){ 
              $return_services .= sprintf(
                  $format_service
                  ,get_permalink($service->ID)
                  ,(!empty($service_fields['image']['url']) ? $service_fields['image']['url'] : '')
                  ,$service->post_title 
                  ,(!empty($service_fields['details']) ? $service_fields['details'] : '')
                  ,(!empty($service_fields['price']) ? '$'.$service_fields['price'] : '')
              );
          }
      }
      $return_services .= '</ul></div>';

      $return_services .= '
            </div>
         </section>
      ';
  }

   get_header();
   
 ?>
<main id="page_services">
<?php include( get_template_directory() . '/parts/part.hero.php'); 
   echo $return_services;
?>
<?php 
    get_footer();
 ?>