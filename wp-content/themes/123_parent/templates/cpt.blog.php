<?php 
/**
 * Template Name: Blog
 * Template Post Type: post
 */
    $fields = get_fields($post->ID);

    $format = '
        <section class="mod__featured_grid">
            <div class="container">
                <div class="site__fade site__fade-up">
                    <div class="image site__bgimg_img" style="background-image:url(%s);"></div>
                    <div class="post__content">
                        <h2>%s</h2>
                        <p class="post__date">Posted On: %s</p>
                        <div class="post__details">%s</div>
                    </div>
                </div>
            </div>
        </section>
    ';
    if($fields['status']){
        $return = sprintf(
            $format
            ,(!empty($fields['featured_image']['url']) ? $fields['featured_image']['url']: '')
            ,$post->post_title
            ,get_the_date()
            ,(!empty($fields['details'])? $fields['details'] : '' )
        );
    }

    get_header();
?>
<main id="single_blog">
<?php 
    echo $return;
    get_footer();
 ?>