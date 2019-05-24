<?php 
/**
 * Template Name: Blog
 */

   $args_posts = array(
      'posts_per_page' => -1
      ,'post_type' => 'post'
   );

   $res1 = get_posts($args_posts);

   $args_page = array(
      'posts_per_page' => 1
      ,'post_type' => 'page'
      ,'pagename' => 'blog'
   );

   $res2 = get_posts($args_page);

   $fields = get_fields($res2[0]);

   if( !empty($fields['featured_posts']['posts']) ){

      $heading = ( !empty( $fields['featured_posts']['heading'] ) ? '<h2 class="site__fade site__fade-up">'.$fields['featured_posts']['heading'].'</h2>' : '');
      $details = ( !empty( $fields['featured_posts']['details'] ) ? '<div class="site__fade site__fade-up">'.$fields['featured_posts']['details'].'</div>' : '');
      
      $return_posts = '
         <section class="mod__featured_grid">
            <div class="container">
               '.$heading.'
               '.$details.'
               <div class="site__grid"><ul>
      ';
      
      $format_post = '
          <li class="site__fade site__fade-up">
              <a href="%s">
                  <div class="image" style="background-image: url(%s)"></div>
                  <div class="blog_item_content">
                      <h5>%s</h5>
                      <div class="blog_item_excerpt">%s</div>
                      <p class="blog_item_read_more">Read More</p>
                  </div>
              </a>
          </li>
      ';

      foreach( $res1 as $i => $item ){

         $post_fields = get_fields($item->ID);
          
         if( $post_fields['status'] ){
            $return_posts .= sprintf(
               $format_post
               ,get_post_permalink($item->ID)
               ,$post_fields['featured_image']['url']
               ,$item->post_title
               ,(!empty($post_fields['excerpt']) ? $post_fields['excerpt'] : '')
            );
         }
      }
      $return_posts .= '</ul></div>';

      $return_posts .= '
            </div>
         </section>
      ';
   }

   get_header();
 ?>
<main id="page_blog">
<?php include( get_template_directory() . '/parts/part.hero.php');
   echo $return_posts;
   get_footer();
?>