<?php 
/**
 * Template Name: About Page
 */

   $args_posts = array(
      'posts_per_page' => -1
      ,'post_type' => 'staff'
   );

   $res1 = get_posts($args_posts);

   $args_page = array(
      'posts_per_page' => 1
      ,'post_type' => 'page'
      ,'pagename' => 'about'
   );

   $res2 = get_posts($args_page);

   $fields = get_fields($res2[0]);

   // if we have staff members
   if( !empty($res1) ){
      $return_staff = '';
      $format_staff = '
          <li class="site__fade site__fade-up">
              <a href="%s">
                  <div class="image site__bgimg site__bgimg--zoom site__bgimg--gradient"><div style="background-image: url(%s)" class="site__bgimg_img"></div></div>
                  <h5>%s</h5>
              </a>
          </li>
      ';
      // loop thru the staff members (post objects)
      foreach ($res1 as $i => $rec) {
          // get the fields of each staff member post object
          $rec_fields = get_fields($rec->ID);
          // if the staff member status is active
          if( $rec_fields['status'] ){
              $return_staff .= sprintf(
                  $format_staff
                  ,get_permalink($rec->ID)
                  ,$rec_fields['image']['url']
                  ,$rec->post_title
              );
          }
      }
  } else {
      $return_staff = '';
  }
  
  // company bio
  if( !empty($fields['company_bio']) ){

      $heading = ( !empty( $fields['company_bio']['heading'] ) ? '<h2 class="site__fade site__fade-up">'.$fields['company_bio']['heading'].'</h2>' : '');
      $details = ( !empty( $fields['company_bio']['details'] ) ? '<div class="site__fade site__fade-up">'.$fields['company_bio']['details'].'</div>' : '');
      $return_company = '';
      $return_company = '
          <section class="mod__featured_grid">
              <div class="container">
                  '.$heading.'
                  '.$details.'
                  <div class="site__grid"><ul>
                      '.$return_staff.'
                  </ul></div>
              </div>
          </section>
      ';
  }

    get_header();
 ?>
<main id="page_about">
<?php include( get_template_directory() . '/parts/part.hero.php');   ?>
   <div class="container">
<?php
   echo $return_company;
?>
   </div>
</main>
<?php 
    get_footer();
 ?>