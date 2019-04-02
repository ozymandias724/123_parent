<?php 
/**
 * 	Render Blog Module if Active
 */
if (Pagedata::is_active_page('gallery')) :
?>
	<?php include( get_template_directory() . '/partials/banner.php'); ?>
<section class="gallery-galleries">
    <?php if(have_rows('gallery-repeater', 'option')) : while(have_rows('gallery-repeater', 'option')) :  the_row(); ?>
        <div class="gallery-galleries-gallery">
            <h2 class="fade fade-in gallery-galleries-gallery-header"><?php echo get_sub_field('gallery-name','option') ?></h2>
            <?php 				
                $images = get_sub_field('gallery-gallery', 'option');
                $medium_remainder = count($images) % 2;
                $large_remainder = count($images) % 4;
                foreach($images as $index => $image) :
                    $classes = '';
                    if(!empty($medium_remainder) && $index >= count($images) - $medium_remainder){
                        $classes .= 'medium-' . (string) $medium_remainder . ' ';
                    }
                    if(!empty($large_remainder) && $index >= count($images) - $large_remainder){
                        $classes .= 'large-' . (string) $large_remainder . ' ';
                    }
                    $img_src = wp_get_attachment_image_url( $image['id'], 'medium' );
                    $img_srcset = wp_get_attachment_image_srcset( $image['id'], 'medium' );
                ?>
                    <a href="<?php echo $image['url']; ?>" class="fade fade-up gallery-galleries-gallery-imagecontainer<?php echo !empty($classes) ? ' ' . $classes : '';  ?>" data-caption="<?php echo get_sub_field('gallery-name', 'option'); ?>">
                        <img
                                class="gallery-galleries-gallery-imagecontainer-image"
                                src="<?php echo esc_url( $img_src ); ?>"
                                srcset="<?php echo esc_attr( $img_srcset ); ?>"
                                sizes="(max-width: 640px) 641px"
                                alt="Image"
                        >
                    </a>
            <?php endforeach; ?>
        </div>
    <?php endwhile; endif; ?>
</section>
<?php 
endif;
 ?>