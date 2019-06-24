<?php 
/**
* Template Name: Blog
*/
$args = array(
    'post_type' => 'post'
    ,'posts_per_page' => -1
);


$res = get_posts($args);
$fields = get_fields(get_the_ID());


$return['section'] = '';


$return['posts'] = '<ul>';

$guide['posts'] = '
   <li class="site__fade site__fade-up">
      <a href="%s">
         %s
         <div class="content">
            <h5>%s</h5>
            <div class="excerpt block__item-body">%s</div>
            <p class="read_more">Read More</p>
         </div>
      </a>
   </li>
';

foreach($res as $i => $post) {
        
   $post_fields = get_fields($post->ID);

   print_r($post_fields);
       
   if( $post_fields['status'] ){
       $return['posts'] .= sprintf(
           $guide['posts']
           ,get_post_permalink($post->ID)
           ,( !empty($post_fields['featured_image']['url']) ? '<div class="image__container"><div class="image rectangular_block" style="background-image:url('.$post_fields['featured_image']['url'].')"></div></div>' : '')
           ,$post->post_title
           ,(!empty($post_fields['excerpt']) ? $post_fields['excerpt'] : '')
       );
   }
}
$return['posts'] .= '</ul>';

// empty guide string 
$guide['section'] = '
   <section class="site__block block__blog_posts">
       <div class="container %s">
           %s
           %s
           %s
       </div>
   </section>
';

$return['section'] .= sprintf(
   $guide['section']
   
   ,( !empty( $fields['width'] ) ? $fields['width'] : '' )  // container width

   ,( !empty( $fields['heading'] ) ? '<h2 class="block__heading" style="text-align:'.$fields['heading_alignment'].';">'.$fields['heading'].'</h2>' : '' )

   ,( !empty( $fields['text'] ) ? '<div class="block__details">'.$fields['text'].'</div>' : '' )

   ,( !empty( $return['posts'] ) ? $return['posts'] : '' )
);

?>
<?php
    get_header();
?>
<main>
<?php 
    include( get_template_directory() . '/parts/part.hero.php');
    echo $return['section'];
?>
<?php 
    get_footer();
 ?>