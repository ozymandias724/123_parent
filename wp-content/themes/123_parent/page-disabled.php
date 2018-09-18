<?php get_header() ?>
	<div class="disabled" style="background-image: url('<?php the_field('general-admin-bg', 'option'); ?>');">
		<div class="disabled-center">
			
			<h1 class="disabled-center-header">Website Disabled</h1>
			
			<?php 
				$reseller_info = array_values(get_option( '123_parentcompany_info' ));
				$logo_color = get_field('field_n0982nl23n5lkmad', 'options');
				if( !empty($reseller_info) ) :
					if($logo_color == 'light'){
						$reseller_logo = $reseller_info[0]['lightlogo'];
					} else if ( $logo_color == 'dark' ){
						$reseller_logo = $reseller_info[0]['darklogo'];
					}
			 ?>
					<img class="disabled-center-image" src="<?php echo $reseller_logo; ?>" alt="">
			<?php 
				endif;
			 ?>
			 
			<div class="disabled-center-subheader">
				Sorry it appears we've encountered a problem. <br/>
				Please contact a <?php echo $reseller_info[0]['name']; ?> representative to reinstate your service.
			</div>
			
			<a href="tel:<?php echo $reseller_info[0]['phone']; ?>" class="disabled-center-tel"><?php echo $reseller_info[0]['phone']; ?></a>
		</div>
		<div class="disabled-tint"></div>
	</div>

<?php get_footer(); ?>