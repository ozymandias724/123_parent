<?php 
	$logo_is_inverted = get_field('general-theme-invert-headerfooter-logo-colors', 'option');
 ?>
<footer class="mobilefooter<?php echo $logo_is_inverted ? ' invertlogo' : ''; ?>">
	<div class="mobilefooter-section">
		<a href="<?php echo site_url(); ?>" class="mobilefooter-logo">
			<img src="<?php echo get_logo(); ?>" class="mobilefooter-logo-image">
		</a>


		<div class="mobilefooter-section-contactlinks">
			<?php 
				if( !empty( get_the_phone() ) ) :
			 ?>
				<a href="tel:<?php echo get_the_phone('tel'); ?>" class="mobilefooter-contactlinks-phone"><?php echo 'P: ' . get_the_phone() ?></a>
			<?php 
				endif;
				if( !empty( get_the_fax() ) ):
			 ?>
					<br>
					<a href="tel:<?php echo get_the_fax('tel'); ?>" class="mobilefooter-contactlinks-fax"><?php echo 'F: ' . get_the_fax() ?></a>
			<?php 
				endif;
				if( !empty( get_master_address()) ) :
					$handle = new GooMaps();
					$address = get_field('social-address', 'options')['address'];
					$geocodedArray = $handle->geocode($address);
					$formattedAddress = $handle->formatAddress($geocodedArray[2]);
			 ?>
					<br>
					<div class="mobilefooter-contactlinks-address"><?php echo $formattedAddress; ?></div>
			<?php 
				endif;
			 ?>
		</div>
		<?php include locate_template( 'modules/sub-modules/social-icons.php' ); ?>		
	</div>
	<div class="mobilefooter-section mobilefooter-section-pagelinks ">
		<h2 class="mobilefooter-section-heading">Links</h2>
		<?php 
			NavUtil::render_nav_links('mobilefooter-pagelinks');
		 ?>
	</div>	
	<div class="mobilefooter-section mobilefooter-section-payment ">
		<h2 class="mobilefooter-section-heading">Payment</h2>
		<?php 
			$payment_types = array('mastercard', 'visa', 'amex', 'discover', 'paypal', 'cash', 'check');
			echo "<ul class='mobilefooter-section-payment-types'>";
			foreach($payment_types as $payment_type) : if( get_field($payment_type, 'option') == true ) :
		 ?>
				<li class="mobilefooter-section-payment-types-type <?php echo $payment_type ?><?php echo !empty(get_field($payment_type . '-image', 'option')) ? ' hasimage' : ''; ?>">
					<?php if( !empty(get_field($payment_type . '-image', 'option')) ): ?>
						<img class="mobilefooter-section-payment-types-type-image" src="<?php the_field($payment_type . '-image', 'option'); ?>">
					<?php endif; ?>
				</li>
		<?php endif; endforeach;
			echo "</ul>";
		 ?>
	</div>
	<?php 	
		////////////////////////////////////
		// Custom Award Badges (repeater) //
		////////////////////////////////////
	 ?>
	<div class="mobilefooter-section">
	 	<?php 
			if( have_rows( 'field_o2be34tgashv', 'options' ) ) :
	 	 ?>
			<ul class="mobilefooter-badges">		
				<?php 
					while ( have_rows( 'field_o2be34tgashv', 'options' ) ) : the_row();
						$link_obj = get_sub_field('link');
						$img_obj = get_sub_field('image');
				 ?>
					<li class="mobilefooter-badges-badge">
						<?php if( get_sub_field('link') ) : ?>
						<a href="<?php echo $link_obj['url']; ?>"><img src="<?php echo $img_obj['url']; ?>" alt=""></a>
						<?php else : ?>
						<img src="<?php echo $img_obj['url']; ?>" alt="">
						<?php endif; ?>
					</li>
				 <?php 
					endwhile;
				 ?>
			</ul>
		<?php 
			endif;
		 ?>
	</div>
	<?php 
		//////////////
		// Reseller //
		//////////////
	 ?>
	<div class="mobilefooter-section">
		<div class="mobilefooter-copyright">
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
					<span>Powered by </span>
					<a target="_blank" class="mobilefooter-copyright-tclink" href="<?php echo $reseller_info[0]['url'] ?>"><?php echo $reseller_info[0]['name']; ?></a>
					<br>
			<?php 
				endif;
			 	if( !get_field('terms-disable', 'option') ) :
			 ?>
			 	<a class="mobilefooter-copyright-tclink" href="<?php echo site_url() ?>/terms">Terms &amp; Conditions</a> 
			<?php endif; ?>
			 <p>Copyright &copy; <?php echo Date('Y') ?></p>
		</div>
	</div>
	<?php 
		if ( !isset($reseller_info) ) :
	 ?>
		<a href="<?php echo $reseller_info['url']; ?>" class="mobilefooter-webxlink">
			<img class="mobilefooter-webxlink-logo" src="<?php echo $reseller_logo; ?>" alt="">
		</a>
	<?php 
		endif;
	 ?>
</footer>