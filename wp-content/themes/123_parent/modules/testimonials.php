<main class="testimonials main" id="testimonials">
	<section class="testimonials-hero hero ">
		<div class="testimonials-hero-text hero-text">
			<h1 class="fade fade-in testimonials-hero-text-header hero-text-header">
				<?php Pagedata::the_active_page_name('testimonials'); ?>
			</h1>
		</div>
	</section>
	<section class="testimonials-testimonials ">
		<?php if(have_rows('testimonials-repeater', 'option')): ?>

			<div class="testimonials-testimonials-grid">
			<?php while(have_rows('testimonials-repeater', 'option')): the_row();
				$select = get_sub_field(' testimonials-repeater-select', 'option');
				$grid_item_class = $select == 'youtube' ? 'testimonials-youtubegriditem' : ''; 
				if(!empty(get_sub_field('testimonials-repeater-image'))){
					$grid_item_class .= ' hasimage';
				}
			?>
					<div class="fade fade-up testimonials-testimonials-grid-item<?php echo $grid_item_class; ?>">
						
						<!--  -->
						<?php if( get_sub_field('testimonials-repeater-select', 'option') == 'personal' ): ?>
							<?php if(!empty(get_sub_field('testimonials-repeater-image'))): ?>
								<div style="background-image: url('<?php echo get_sub_field('testimonials-repeater-image') ?>');" class="testimonials-testimonials-grid-item-image"></div>
							<?php endif; ?>
							<div class="testimonials-testimonials-grid-item-textwrap">	
								<div class="testimonials-testimonials-grid-item-quote">“<?php echo get_sub_field('testimonials-repeater-quote'); ?>”</div>
								<div class="testimonials-testimonials-grid-item-personinfo">
									<div class="testimonials-testimonials-grid-item-personinfo-name">- <?php echo get_sub_field('testimonials-repeater-name'); ?></div>
								</div>
							</div>
						<?php endif; ?>
						
						<!--  -->
						<?php if( get_sub_field('testimonials-repeater-select', 'option') == 'youtube' ): ?>
							<div class="testimonials-testimonials-grid-item-youtubecontainer">
								<?php the_sub_field('testimonials-repeater-youtube', 'option'); ?>
							</div>
						<?php endif; ?>

					</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>
</main>