<?php
/**
 * 
 */
	if( $post->post_name !== 'disabled' ){

		$format_copyright_m = '
			<br>
			<span class="mobilefooter-copyright">
			Powered by <a href="%s" class="mobilefooter-copyright-tclink" target="_blank">%s</a>
			%s
			<br>
			Copyright &copy; %s
			</span>
		';
		$has_terms = 
			( !get_field('terms-disable', 'option') ) 
			? '<br><a href="'.site_url().'/terms" target="_blank" class="mobilefooter-copyright-tclink">Terms &amp; Conditions</a>'
			: ''
		;
		$content_copyright_m = sprintf(
			$format_copyright
			,$reseller_info[0]['url']
			,$reseller_info[0]['name']
			,$has_terms
			,Date('Y')
		);
		$format_copyright_dt = '
			<span class="footer-copyright">
			Powered by <a href="%s" class="footer-copyright-tclink" target="_blank">%s</a>
			%s
			| Copyright &copy; %s
			</span>
		';
		$has_terms = 
		( !get_field('terms-disable', 'option') ) 
			? '| <a href="'.site_url().'/terms" target="_blank" class="footer-copyright-tclink">Terms &amp; Conditions</a>'
			: ''
		; // end $has_terms
		$content_copyright_dt = sprintf(
			$format_copyright
			,$reseller_info[0]['url']
			,$reseller_info[0]['name']
			,$has_terms
			,Date('Y')
		);
		get_template_part('partials/global', 'popups');
		if( have_rows('field_o2be34tgashv', 'options') ){
			$format_badges_link = '
				<li>
					<a href="%s">
						<img src="%s">
					</a>
				</li>
			';
			$format_badges_nolink = '
				<li>
					<img src="%s">
				</li>
			';
			$content_badges = '<ul>';
			while( have_rows('field_o2be34tgashv', 'options') ){
				the_row();

				$link = get_sub_field('link');
				$img = get_sub_field('image');

				if( !empty($link) ){
					$content_badges .= sprintf(
						$format_badges_link
						,$link['url']
						,$img['url']
					);
				} else {
					$content_badges .= sprintf(
						$format_badges_nolink
						,$img['url']
					);
				}
			}
			$content_badges .= '</ul>';
		}
		$handle = new GooMaps();
		$address = get_field('social-address', 'options')['address'];
		$geocodedArray = $handle->geocode($address);
		$formattedAddress = $handle->formatAddress($geocodedArray[2]);
		$reseller_info = array_values(get_option( '123_parentcompany_info' ));
	    if( !empty($reseller_info) ) {
		   	
		   	$logo_color = get_field('field_n0982nl23n5lkmad', 'options');

		    if($logo_color == 'light'){
		        $reseller_logo = $reseller_info[0]['lightlogo'];
		    }
		    else if ( $logo_color == 'dark' ){
		        $reseller_logo = $reseller_info[0]['darklogo'];
	    	}
	    }
		$logo_is_inverted = get_field('general-theme-invert-headerfooter-logo-colors', 'option');		
		$payment_types = array('mastercard', 'visa', 'amex', 'discover', 'paypal', 'cash', 'check');
		$payment_types = array_filter($payment_types, function($index){
			return get_field($index, 'option') == true;
		});
		$format_payment = '
			<li class="%s %s">
				<img src="%s">
			</li>
		';
		$content_payment ='<ul>';
		foreach( $payment_types as $paytype){

			$content_payment .= sprintf(
				$format_payment
				,$paytype
				,(!empty(get_field($paytype . '-image', 'option')) ? ' hasimage' : '')
				,get_field($paytype . '-image', 'option')
			);
		}
		$content_payment .= '</ul>';
		// end payment
		$addr = get_master_address();
		$format_contact_dt = '
			<a href="tel:%s" class="footer-contactlinks-phone">%s</a>
			<br>
			<a href="fax:%s" class="footer-contactlinks-fax">%s</a>
			<br>
		';
		$content_contact_dt = sprintf(
			$format_contact_dt
			,get_the_phone('tel')
			,get_the_phone()
			,get_the_fax('tel')
			,get_the_fax()
		);
		$format_contact_m = '
			<a href="%s" class="mobilefooter-contactlinks-phone">%s</a>
			<br>
			<a href="%s" class="mobilefooter-contactlinks-fax">%s</a>
			<br>
		';
		$content_contact_m = sprintf(
			$format_contact_m
			,get_the_phone('tel')
			,get_the_phone()
			,get_the_fax('tel')
			,get_the_fax()
		);
		// include mobile/desktop footers
		include('partials/navigation/footer/footer-mobile.php');
		include('partials/navigation/footer/footer-desktop.php');
	}

	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
	   ?>
	   	<script src="//localhost:35729/livereload.js"></script>
	   <?php
	}

	wp_footer();
?>
</body>
</html>