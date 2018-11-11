<?php 
/**
* Site Setup Fields
*/


$format = '<a href="%s" target="_blank"><img class="sitesetup_images" src="%s" alt="select theme"></a>';
$content = sprintf(
	$format
	,get_admin_url() .'/themes.php?noconflict=yeah'
	,'http://www.123websites.com/images/signup/themes.jpg'
);
acf_add_local_field(array(
	'parent' => 'group_sitesetup_intro',
	'key' => 'field_sitesetup_msg_intro_1',
	'type' => 'message',
	'label' => '',
	'message' => $content,
));



$the_pagination = '<div id="setup-pagination"></div>';
acf_add_local_field(array(
	'parent' => 'group_sitesetup_0',
	'key' => 'field_sitesetup_msg_1',
	'type' => 'message',
	'message' => $the_pagination,
));
$next_prev = '<div id="setup-nextprev"><span data-name="prev">Prev</span><span data-name="next">Next</span></div>';
acf_add_local_field(array(
	'parent' => 'group_sitesetup_5',
	'key' => 'field_sitesetup_nextprev',
	'type' => 'message',
	'message' => $next_prev,

));


/**
* Page 1
*/
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_address',
		'label' => '1. Choose Address',
		'name' => 'sitesetup_address',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_bdaa98',
		),
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_phone_main',
		'label' => '2. Primary Phone #',
		'name' => 'sitesetup_phone',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_8378888',
		),
		'display' => 'seamless',
		'layout' => 'block',
	));

	// phone secondary
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_phone_secondary',
		'label' => 'Secondary Phone #',
		'name' => 'sitesetup_phone_secondary',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_8378ddf888',
		),
		'display' => 'seamless',
		'layout' => 'block',
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_email',
		'label' => 'Company email',
		'name' => 'sitesetup_email',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_212o8afdh',
		),
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_hours_msg',
		'type' => 'message',
		'message' => 'We will make sure these are visible on your new site so people will know which hours they can call for a live person or message you after hours through the site for information.',
		'display' => 'normal',
		'label' => '5. Hours of Operation',
	));


	// hours of operation
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_hours',
		'label' => 'Hours of Operation',
		'name' => 'sitesetup_hours',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_3876f',
		),
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_msg',
		'type' => 'message',
		'message' => 'We want to be able to show people how they can pay for your services or products. No one wants a client that needs your service but does not have the proper way to pay you, right? So what are the types of payments you except?',
		'display' => 'normal',
		'label' => '6. Payment Types',
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_mc_tog',
		'label' => 'Payment Types',
		'name' => 'sitesetup_payment_mc_tog',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_12hafhpwae',
		),
		'display' => 'seamless',
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_visa_tog',
		'label' => 'Payment Types',
		'name' => 'sitesetup_payment_visa_tog',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_12hafhzapwae',
		),
		'display' => 'seamless',
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_amex_tog',
		'label' => 'Payment Types',
		'name' => 'sitesetup_payment_amex_tog',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_12haf2dafhpwae',
		),
		'display' => 'seamless',
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_disc_tog',
		'label' => 'Payment Types',
		'name' => 'sitesetup_payment_disc_tog',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_12ha1212fhpwae',
		),
		'display' => 'seamless',
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_paypal_tog',
		'label' => 'Payment Types',
		'name' => 'sitesetup_payment_paypal_tog',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_12hafhpwazdffde',
		),
		'display' => 'seamless',
	));


	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_cash_tog',
		'label' => 'Payment Types',
		'name' => 'sitesetup_payment_cash_tog',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_12hafhp12398e',
		),
		'display' => 'seamless',
	));


	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_payment_check_tog',
		'label' => 'Payment Types',
		'name' => 'sitesetup_payment_check_tog',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_odasf129873e',
		),
		'display' => 'seamless',
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_socials',
		'label' => 'Social Media',
		'name' => 'sitesetup_socials',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_akan8a8sskshb',
		),
		'display' => 'seamless',
	));


/**
*	Page 2
*/
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_1',
		'label' => '1. Company Logo',
		'name' => 'sitesetup_logo',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_2343135',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_areas',
		'label' => '2. Areas Served Hero',
		'name' => 'sitesetup_hero_areas',
		'type' => 'clone',
		'instructions' => '',
		'clone' => array(
			0 => 'field_afd9zx7',
		),
		'display' => 'normal',
		'layout' => 'block',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_contact',
		'label' => '3. Contact Hero',
		'name' => 'sitesetup_hero_contact',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_23',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_about',
		'label' => '4. About Hero',
		'name' => 'sitesetup_hero_about',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_bdsh8f',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_blog',
		'label' => '5. Blog Hero',
		'name' => 'sitesetup_hero_blog',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_15',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_gallery',
		'label' => '6. Gallery Hero',
		'name' => 'sitesetup_hero_gallery',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_5',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_services',
		'label' => '7. Services Hero',
		'name' => 'sitesetup_hero_services',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_9',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_testimonials',
		'label' => '8. Testimonials Hero',
		'name' => 'sitesetup_hero_testimonials',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_19',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_location',
		'label' => '9. Location Hero',
		'name' => 'sitesetup_hero_location',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_23',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_hero_menu',
		'label' => '10. Menu Hero',
		'name' => 'sitesetup_hero_menu',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_23',
		),
		'display' => 'normal',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_gallery',
		'label' => 'Gallery',
		'name' => 'sitesetup_gallery_repeater',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_6',
		),
	));
/**
*	Page 3
*/
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_areas_type',
		'label' => '1. Areas Served',
		'name' => 'sitesetup_areas',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_89dsuahf',
		),
		'display' => 'normal'
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_areas_repeater_zips',
		'label' => 'Areas Served',
		'name' => 'sitesetup_areas_repeater_zips',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_1',
		),
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_areas_repeater_states',
		'label' => 'Areas Served',
		'name' => 'sitesetup_areas_repeater_states',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_09zcjxivohfasa',
		),
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_areas_repeater_counties',
		'label' => 'Areas Served',
		'name' => 'sitesetup_areas_repeater_counties',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_39qifdiuadiasadsf',
		),
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_areas_repeater_countries',
		'label' => 'Areas Served',
		'name' => 'sitesetup_areas_repeater_countries',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_70zcxovrghreafz',
		),
	));




	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_services',
		'label' => '2. Services',
		'name' => 'sitesetup_services_repeater',
		'type' => 'clone',
		'clone' => array(
			0 => 'field_10',
		),
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_msg_bloglink',
		'type' => 'message',
		'message' => '3. <a href="'. get_admin_url() .'/edit.php' .'"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/blog.jpg"></a>',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_msg_testimoniallink',
		'type' => 'message',
		'message' => '4. <a href="'. get_admin_url() .'/admin.php?page=testimonials-settings/' .'"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/testimonials.jpg"></a>',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_msg_couponlink',
		'type' => 'message',
		'message' => '5. <a href="'. get_admin_url() . '/admin.php?page=testimonials-settings' .'"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/coupons.jpg"></a>',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_4',
		'key' => 'field_sitesetup_msg_godaddy',
		'type' => 'message',
		'message' => '1. <a href="https://www.godaddy.com/"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/godaddy.jpg"></a>',
	));


	$custom_submit = '2. <input type="submit" accesskey="p" value="Publish Website" class="sitesetup-publish" name="publish">';
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_4',
		'key' => 'field_sitesetup_msg_submit',
		'type' => 'message',
		'message' => $custom_submit,
	));
?>