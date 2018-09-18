<?php 
/**
 * 	Areas-Served
 */
if( Pagedata::is_active_page('areas-served')) :
 ?>
<main class="areas-served main" id="areas-served">
	<div class="areas-served-hero  hero">
		<div class="areas-served-hero-text hero-text">
			<h1 class="fade fade-up areas-served-hero-text-header hero-text-header">
				<?php Pagedata::the_active_page_name('areas-served'); ?>
			</h1>
		</div>
		<div class="areas-served-hero-tint hero-tint"></div>
		<div class="areas-served-hero-map" id="map"></div>
	</div>
	
	<?php 
	/**
	 * 	If areas served selection is chosen
	 */
	if( get_field('areas_served_select', 'options') ) :
	?>
	<div class="areas-served-areas">
	<?php 
	/**
	 * zips, countries, counties, states
	 */
	$grid_items = return_areas_served_grid_items();
	foreach( $grid_items as $grid_item):
		$img_src = wp_get_attachment_image_url( $grid_item['image']['id'], 'medium' );
		$img_srcset = wp_get_attachment_image_srcset( $grid_item['image']['id'], 'medium' );
	 ?>
		<div class="fade fade-up areas-served-areas-area">
			<div class="areas-served-areas-area-image">
				<img
					 class="areas-served-areas-area-image-img"
					 src="<?php echo esc_url( $img_src ); ?>"
				     srcset="<?php echo esc_attr( $img_srcset ); ?>"
				     sizes="(max-width: 640px) 641px"
		     		 alt="Image" >
			</div>
			<h4 class="display-tf areas-served-areas-area-header"><?php echo $grid_item['header']; ?></h4>
		</div>
	<?php 
	endforeach;
	?>
	</div>
	<?php 
	endif;
	 ?>
</main>
<?php 
endif;
 ?>