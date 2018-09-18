<main class="company main" id="company">
	<section class="company-hero hero ">
		<div class="company-hero-text hero-text">
			<h1 class="fade fade-in company-hero-text-header hero-text-header">
				<?php Pagedata::the_active_page_name('company'); ?>
			</h1>
			<?php 
				$selected_option = get_field('company-page-option-toggle', 'option');
			?>
		</div>
	</section>



	<?php if($selected_option == 'option1'): 

		if( !empty(get_field('company-subheader', 'option')) ):
			?>
			<div class="company-hero-text-subheader hero-text-subheader"><?php echo get_field('company-subheader', 'option') ?></div>					
			<?php
		endif;
	 ?>

		<div class="fade fade-up company-wysiwyg section-wysiwyg"><?php echo get_field('company-content', 'option')  ?></div>
	<?php endif; ?>



	<?php if($selected_option == 'option2'): ?>
	<?php if(have_rows('company-employee-repeater', 'option')): ?>
	<section class="company-employees section ">
		<div class="company-employees-grid">
			<?php while(have_rows('company-employee-repeater', 'option')): the_row();?>
				<div class="company-employees-grid-item fade fade-up">
					<div class="company-employees-grid-item-imagecontainer">
						<img src="<?php echo !empty(get_sub_field('company-employee-image', 'option')) ? get_sub_field('company-employee-image', 'option') : get_template_directory_uri() . '/library/img/blank-profile.png'; ?>" class="company-employees-grid-item-imagecontainer-image">
					</div>
					<div class="company-employees-grid-item-imagecontainer--desktop fade fade-up" style="background-image: url('<?php echo !empty(get_sub_field('company-employee-image', 'option')) ? get_sub_field('company-employee-image', 'option') : get_template_directory_uri() . '/library/img/blank-profile.png'; ?>');">
						<div class="company-employees-grid-item-imagecontainer-tint--desktop"></div>
					</div>
					<div class="company-employees-grid-item-rightwrap">
						
						<div class="company-employees-grid-item-textcontainer">
							<h3 class="company-employees-grid-item-textcontainer-name"><?php echo get_sub_field('company-employee-name'); ?></h3>
							<div class="company-employees-grid-item-textcontainer-title"><?php echo get_sub_field('company-employee-title'); ?></div>
							<div class="company-employees-grid-item-textcontainer-description"><?php echo get_sub_field('company-employee-description'); ?></div>	
						</div>
				
						<?php 
							if( have_rows('company-employee-socialmedia', 'options') ) : 
						 ?>
							<ul class="sociallinks">
							<?php 
								while( have_rows('company-employee-socialmedia', 'options') ) : 
								the_row();
								$sp_sm_url = get_sub_field('url');
								$sp_sm_icon = get_sub_field('fonticon');
								$sp_sm_img = get_sub_field('image');
						 	 ?>
						 		<li class="sociallinks-item">
									<a class="sociallinks-item-link" href="<?php echo $sp_sm_url; ?>">
										<i class="sociallinks-item-link-icon fa <?php echo $sp_sm_icon; ?>"></i>
									</a>
						 		</li>
							 <?php 
								endwhile;
							 ?>
							</ul>
						 <?php
							endif;
						 ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</section>
	<?php endif; ?>
	<?php endif; ?>
</main>
