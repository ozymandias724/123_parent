<?php 
	//////////////////
	// Social Icons //
	//////////////////
	if( have_rows('field_akan8a8sskshb', 'options') ) :
		$social_icons = get_field('field_akan8a8sskshb', 'options');
		echo "<ul class='sociallinks'>";
		while ( have_rows('field_akan8a8sskshb', 'options') ) : 
			the_row();
			$url = get_sub_field('url');
			$fa = get_sub_field('fonticon');
			$img = get_sub_field('image');
 ?>
			<li class="sociallinks-item">
				<a href="<?php echo $url; ?>" class="sociallinks-item-link">
					<?php if( $img != false) : ?>
						<img class="sociallinks-item-link-icon" src="<?php echo $img; ?>" alt="">
					<?php endif; ?>
					<?php if ( $img == false && $fa != "") : ?>
						<i class="sociallinks-item-link-icon fa <?php echo $fa; ?>"></i>
					<?php endif; ?>
					<?php 
						if ( $img == false && $fa == "" && $url != "") :
							$custom_png_url = '';
							if( strpos($url, 'booksy') ){
								$custom_png_url = get_template_directory_uri() . '/library/img/social_icons/booksy.png';
							}
							if( strpos($url, 'groupon') ){
								$custom_png_url = get_template_directory_uri() . '/library/img/social_icons/groupon.png';
							}
							if( strpos($url, 'pinterest') ){
								$custom_png_url = get_template_directory_uri() . '/library/img/social_icons/pinterest.png';
							}
					 ?>
						<img class="sociallinks-item-link-icon" src="<?php echo $custom_png_url; ?>" alt="">
					<?php endif ?>
				</a>
			</li>
<?php 
		endwhile;
		echo "</ul>";
	else :
		// no rows were found
	endif;
 ?>