<?php 
/*
*/
if(!function_exists('register_parent_company_data')){
	function register_parent_company_data(){
		$logo_color = get_field('field_n0982nl23n5lkmad', 'options');
		$resellers = array(
			'1network' => [
				'name' => '1 Network',
				'email'=> 'admin@1network.com' ,
				'phone' => '(302) 444-0401',
				'url' => 'http://www.1network.com',
				'darklogo' => 'http://123websites.com/images/partner-logos/1network-dk.png',
				'lightlogo' => 'http://123websites.com/images/partner-logos/1network-lt.png',
			],
			'webx' => [
				'name' => 'WebX Websites' ,
				'email'=> 'admin@webxwebsites.com' ,
				'phone' => '(702) 850-2919',
				'url' => 'http://www.webxwebsites.com',
				'darklogo' => 'http://123websites.com/images/partner-logos/webx-dk.png',
				'lightlogo' => 'http://123websites.com/images/partner-logos/webx-lt.png',

			],
			'2020' => [
				'name' => '2020 Websites' ,
				'email'=> 'admin@2020websites.com' ,
				'phone' => '(951) 204-3427',
				'url' => 'http://www.2020websites.com',
				'darklogo' => 'http://123websites.com/images/partner-logos/2020-dk.png',
				'lightlogo' => 'http://123websites.com/images/partner-logos/2020-lt.png',
			],
			'123' => [
				'name' => '123 Websites' ,
				'email'=> 'admin@123websites.com' ,
				'phone' => '(888) 200-4008',
				'url' => 'http://www.123websites.com',
				'darklogo' => 'http://123websites.com/images/partner-logos/123-dk.png',
				'lightlogo' => 'http://123websites.com/images/partner-logos/123-lt.png',
			],
			'demo' => [
				'name' => 'Demo',
				'email'=> 'admin@demowebsites.com',
				'phone' => '(123) 456-7890',
				'url' => 'http://www.123websites.com',
				'darklogo' => 'http://123websites.com/images/partner-logos/demo-dk.png',
				'lightlogo' => 'http://123websites.com/images/partner-logos/demo-lt.png',
			],
		);
		$detected_reseller = '';
		if ( strpos( ABSPATH, 'resellers/webx') !== false ){ $detected_reseller = 'webx';	}
		
		else if ( strpos(ABSPATH, 'resellers/1network') !== false ) { $detected_reseller = '1network'; }
		
		else if ( strpos(ABSPATH, 'resellers/2020sites') !== false ) { $detected_reseller = '2020'; }
		
		else if ( strpos(ABSPATH, 'resellers/123') !== false ) { $detected_reseller = '123'; }

		else if ( strpos(ABSPATH, 'resellers/demo') !== false ) { $detected_reseller = 'demo'; }
		
		else { $detected_reseller = '123'; }

		// update the select field in theme settings (dont think its doing anything)
		update_field('field_8sna0sklfjfa8nfja', $detected_reseller, 'options');

		// set array of info for detected reseller
		$resellers_options = array(
			$detected_reseller => $resellers[$detected_reseller]
		);
		// set the db value to access this in the theme
		update_option( '123_parentcompany_info', $resellers_options );
	}
}
add_action('acf/init', 'register_parent_company_data');

 ?>