<?php 
	// get the phone number for headers & footers
	if( !function_exists('get_the_phone') ){
		function get_the_phone($phonetel = 'phone'){
			$social_phone = get_field('social-phone-number', 'option');
			if( !empty( str_replace( ' ', '', $social_phone) ) ){
				$search_for = array('(',')','-',' ','.');
				$replace_with = array('','','','','');
				$tel = str_replace($search_for, $replace_with, $social_phone);
				if($phonetel == 'tel'){
					return $tel;
				}
				else{
					return $social_phone;
				}
			}
			else{
				return '';
			}
		}
	}
	// returns tel: href safe (just numbers)
	if( !function_exists('get_tel') ){
		function get_tel($the_phone){
			$search_for = array('(',')','-',' ','.');
			$replace_with = array('','','','','');
			$tel = str_replace($search_for, $replace_with, $the_phone);
			return $tel;
		}
	}

	// get the email address for footers
	if( !function_exists('get_the_email') ){
		function get_the_email(){
			$social_email = get_field('social-email-address', 'option');
			$the_email = null;
			if( !empty($social_email) ){
				$the_email = $social_email;
			}
			else{
				$the_email = 'example@domain.com';
			}
			return $the_email;
		}
	}

	// get the fax number for footers
	if( !function_exists('get_the_fax') ){
		function get_the_fax($phonetel = 'phone'){
			$social_fax = get_field('social-fax-number', 'option');

			if(!empty($social_fax)){
				$search_for = array('(',')','-',' ','.');
				$replace_with = array('','','','','');
				$tel = str_replace($search_for, $replace_with, $social_fax);
				if($phonetel == 'tel'){
					return $tel;
				}
				else{
					return $social_fax;
				}
			}
			else{
				return '';
			}
		}
	}

	/* 
		Get the Address v2
	*/
	if( !function_exists('get_master_address') ){
		function get_master_address()
		{
			// vars
			$address_1_object = get_field('social-address', 'option');
			$address_2_string = get_field('social-address-line2', 'option');
			// filter
			if( !empty($address_1_object) ){
				$ugly_address = str_replace(', United States', '', $address_1_object['address']);
				$trimmed_address_line_1 = preg_replace('/,/', '', $ugly_address, 1);
			}
			// render
			if( !empty($address_1_object) && !empty( $address_2_string ) ){
				// both
				return $trimmed_address_line_1 . "<br>" . $address_2_string;
			} else if( !empty( $address_1_object ) && empty( $address_2_string ) ){
				// just 1
				return $trimmed_address_line_1;
			} else if( empty( $address_1_object ) && !empty( $address_2_string )){
				// just 2
				return $address_2_string;
			} else {
				// empty
				return '';
			}
		}
	}


	// TO BE DEPRICATED
	// get the address for footers
	// if( !function_exists('get_the_address') ){
		
	// 	function get_the_address(){
			
	// 		if( !empty(get_field('social-address-line2', 'option')) && !empty(get_field('social-address', 'option')) ){
	// 			$address_line2 = get_field('social-address-line2', 'option');
	// 			return strstr(get_field('social-address', 'option')['address'],',', true) . ' ' . $address_line2 . strstr(get_field('social-address', 'option')['address'],',');
	// 		}
	// 		else if( !empty( get_field('social-address', 'option') ) ){
	// 			return get_field( 'social-address', 'option' )['address'];
	// 		}
	// 		else{
	// 			return '';
	// 		}
	// 	}
	// }

 ?>