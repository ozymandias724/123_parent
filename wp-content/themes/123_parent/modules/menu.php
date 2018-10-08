<?php 
/**
 * 
 */
 ?>
<main class="menu main" id="menu">
	
	<?php 
		if( is_home() ) :
	 ?>
			<h2 class="fade fade-in menu-hero-text-header hero-text-header"><?php Pagedata::the_active_page_name('menu'); ?></h2>;
	<?php 
		endif;
	 ?>
	<div class="menu-menus">
		<?php 
			if( have_rows('menu-repeater', 'options') ) : while( have_rows('menu-repeater', 'options') ) : the_row();
				$menu_name =  !empty( get_sub_field('menu-category-name', 'options') )  ? get_sub_field('menu-category-name', 'options') : null;
				$menu_description =  !empty( get_sub_field('menu-category-description', 'options') )  ? get_sub_field('menu-category-description', 'options') : null;
				$menu_type =  !empty( get_sub_field('menutype', 'options'))  ? get_sub_field('menutype', 'options') : null;
		?>
			<div class="menu-menus-menu <?php echo "menutype-" . $menu_type; ?>">
				<h4 class="menu-menus-menu-title display-tf"><?php echo $menu_name; ?></h4>
				<p class="menu-menus-menu-description"><?php echo $menu_description; ?></p>
				<?php 
				/**
				 * 	PDF
				 */
					if( $menu_type == 'pdf') :
						$pdf_menu_file = ( !empty( get_sub_field('pdfmenu', 'options') ) ) ? get_sub_field('pdfmenu', 'options') : null;
				 ?>
				 		<div class="menu-menus-menu-pdf fade fade-up">
				 			<iframe class="menu-menus-menu-pdf-iframe" src="<?php echo $pdf_menu_file; ?>" frameborder="0"></iframe>
				 		</div>
				 <?php 
					endif;
				  ?>
				<?php 
				/**
				 * 	List Style
				 */
					if( $menu_type == 'list') :
						if( have_rows('menu-category-list-repeater', 'options') ) : 
					 ?>
			 			<div class="menu-menus-menu-list">
					<?php
						while( have_rows('menu-category-list-repeater', 'options') ) : the_row();						
							$list_menu_name = get_subfield_ternary('menu-list-item-name','options');
							$list_menu_description = get_subfield_ternary('menu-list-item-description','options');
							$list_menu_price = get_subfield_ternary('menu-list-item-price','options');
					 ?>
					 		<div class="menu-menus-menu-list-item fade fade-up">
					 			<h6 class="menu-menus-menu-list-item-name display-tf"><?php echo $list_menu_name; ?></h6>
					 			<h6 class="menu-menus-menu-list-item-price display-tf"><?php echo $list_menu_price; ?></h6>
					 			<p class="menu-menus-menu-list-item-description"><?php echo $list_menu_description; ?></p>
					 		</div>
				 <?php 
				 		endwhile;
				 		echo "</div>";
				 		endif;
					endif;
				  ?>
				<?php
				/**
				 * 	Grid
				 */
					if( $menu_type == 'masonry') :
						if( have_rows('menu-category-repeater', 'options')) : 
					 ?>
			 			<div class="menu-menus-menu-grid">
					<?php
						while( have_rows('menu-category-repeater', 'options')) : the_row();
							$masonry_menu_price = get_subfield_ternary('menu-item-price', 'options');
							$masonry_menu_description = get_subfield_ternary('menu-item-description', 'options');
							$masonry_menu_name = get_subfield_ternary('menu-item-name', 'options');
					 ?>
					 		<div class="menu-menus-menu-grid-item fade fade-up">
					 			<?php if( get_sub_field('menu-item-picture-toggle', 'options') == true ) : $masonry_menu_imgsrc = get_subfield_ternary('menu-item-picture', 'options'); ?>
									<figure class="menu-menus-menu-grid-item-figure">
										<img class="menu-menus-menu-grid-item-figure-image" src="<?php echo $masonry_menu_imgsrc; ?>" alt="">
									</figure>
				 				<?php endif; ?>
								<h4 class="display-tf menu-menus-menu-grid-item-name"><?php echo $masonry_menu_name; ?></h4>
								<p class="menu-menus-menu-grid-item-description"><?php echo $masonry_menu_description; ?></p>
								<h5 class="display-tf menu-menus-menu-grid-item-price"><?php echo $masonry_menu_price; ?></h5>
					 		</div>
	 				<?php
			 			endwhile;
			 			echo "</div>";
				 		endif;
					endif;
				  ?>
			</div>
		<?php 
			endwhile;
			endif;
		 ?>
	</div>
</main>