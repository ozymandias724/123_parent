<?php 
/**
 * 	Helpers
 */
	$themeName = wp_get_theme()->Name;
	$limit = false;
	if( $themeName == '123_one' ){
		$limit = 3;
	}
 ?>
<main class="services main" id="services">
	<h1 class="fade fade-in services-header hero-text-header"><?php Pagedata::the_active_page_name('services'); ?></h1>
	<?php if(have_rows('services-repeater', 'option')) : $i = 0; ?>
	<div class="services-grid">
		<?php 
			// $counter = 0;

			while(have_rows('services-repeater', 'option')) : 
				
				the_row();

				// $counter++;
				$i++;
				if( !is_home() ){
					$limit = false;
				}
				if( $themeName == "123_one" && $i > $limit && !empty($limit) ){
					break;
				}
		 ?>
		<div class="fade fade-in services-grid-item<?php echo ($counter % 2 == 0) ? ' services-grid-item--invert' : ''; ?>">
			<?php 
				$image = get_sub_field('service-image', 'options');
				$img_src = wp_get_attachment_image_url( $image['ID'], 'medium' );
				$img_srcset = wp_get_attachment_image_srcset( $image['ID'], 'medium' );
			 ?>
			<figure class="services-grid-item-imagecontainer">
				<img 
					class="services-grid-item-imagecontainer-image"
					src="<?php echo esc_url( $img_src ); ?>"
					srcset="<?php echo esc_attr( $img_srcset ); ?>"
					sizes="(max-width: 640px) 641px"
					alt="Image"
				>
			</figure>
			<div class="services-grid-item-wrapper">
				<h3 class="services-grid-item-header"><?php echo get_sub_field('service-name', 'option'); ?></h3>
				<div class="services-grid-item-descriptioncontainer">
					<div class="services-grid-item-descriptioncontainer-description"><?php echo get_sub_field('service-description', 'option'); ?></div>
				</div>
				<div class="services-grid-item-pricecontainer">
					<div class="services-grid-item-pricecontainer-price"><?php echo get_sub_field('service-price', 'option'); ?></div>
				</div>
			</div>
		</div>
		<?php endwhile; ?>

		<?php 
			if( $themeName == "123_one" && !empty($limit) ) :
		 ?>
		<a href="<?php echo site_url(); ?>/services" class="home-services-viewall button-viewall">view all</a>
		<?php 
			endif;
		 ?>

	</div>
	<?php endif; ?>
</main>