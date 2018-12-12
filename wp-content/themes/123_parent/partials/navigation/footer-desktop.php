<?php 
	
	// get name of reseller
	$reseller_info = array_values(get_option( '123_parentcompany_info' ));

	$format_reseller = '
		<p class="footer-section-heading">Follow Us</p>
		<h3><a target="_blank" href="%s" class="footer-webxlink">%s</a></h3>
	';
	$content_reseller = sprintf(
		$format_reseller
		,$reseller_info[0]['url']
		,$reseller_info[0]['name']
	);

	$logo_is_inverted = get_field('general-theme-invert-headerfooter-logo-colors', 'option');
 ?>
 	
<footer class="footer<?php echo $logo_is_inverted ? ' invertlogo' : ''; ?>">
 <div class="footer-wrap">
	<div class="footer-section">
		<a href="<?php echo site_url(); ?>" class="footer-logo">
			<figure>
				<img src="<?php echo get_logo(); ?>" class="footer-logo-image">
			</figure>
		</a>
		<div class="footer-section-contactlinks">
			<?php if( !empty( get_the_phone() ) ) : ?>
				<a href="tel:<?php echo get_the_phone('tel'); ?>" class="footer-contactlinks-phone"><?php echo 'P: ' . get_the_phone() ?></a>
			<?php endif; ?>
			<?php if( !empty( get_the_fax() ) ): ?>
				<br>
				<a href="tel:<?php echo get_the_fax('tel'); ?>" class="footer-contactlinks-fax"><?php echo 'F: ' . get_the_fax() ?></a>
			<?php endif; ?>
			<br>
			<div class="footer-contactlinks-address">
				<?php 
					$handle = new GooMaps();
					$address = get_field('social-address', 'options')['address'];
					$geocodedArray = $handle->geocode($address);
					echo $handle->formatAddress($geocodedArray[2]);
				 ?>
			</div>
		</div>
	</div>
	
	<div class="footer-section footer-section-pagelinks">
		<p class="footer-section-heading">Links</p>
		 <?php NavUtil::render_nav_links('footer-pagelinks'); ?>
	</div>	

	<div class="footer-section footer-section-payment">
		<div class="footer-payment">
			<p class="footer-section-heading">Payment</p>
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
	</div>

	<div class="footer-section">
		<?php 
			echo $content_reseller;
			include locate_template( 'modules/sub-modules/social-icons.php' );
		 ?>
	</div>
	<?php 
	/**
	 * Badges
	 */
	if( have_rows( 'field_o2be34tgashv', 'options' ) ) :
  	 ?>
 		<ul class="footer-badges">		
 			<?php 
 				while ( have_rows( 'field_o2be34tgashv', 'options' ) ) : the_row();
 					$link_obj = get_sub_field('link');
 					$img_obj = get_sub_field('image');
 			 ?>
 				<li class="footer-badges-badge">
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
</footer>
<div class="footer-copyright">
	<?php 
	 	if ( !empty($reseller_info) ) :
	 ?>
		Powered by <a target="_blank" class="footer-copyright-tclink" href="<?php echo $reseller_info[0]['url'] ?>"><?php echo $reseller_info[0]['name']; ?></a> 
	<?php 
	 	endif;
	 ?>	
	<?php if( !get_field('terms-disable', 'option') ): ?>
		| <a class="footer-copyright-tclink" href="<?php echo site_url() ?>/terms">Terms &amp; Conditions</a> 
	<?php endif; ?>
	| Copyright &copy; <?php echo Date('Y') ?>
</div>