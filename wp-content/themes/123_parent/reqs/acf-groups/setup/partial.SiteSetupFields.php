<?php 
	// Intro Group ('choose a theme')
	$format = '<a href="%s" target="_blank"><img class="sitesetup_images" src="%s" alt="select theme"></a>';
	$content = sprintf(
		$format
		,get_admin_url() .'themes.php?noconflict=yeah'
		,'http://www.123websites.com/images/signup/themes.jpg'
	);

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_intro',
		'key' => 'field_sitesetup_msg_intro_1',
		'type' => 'message',
		'label' => '',
		'message' => $content,
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_intro',
		'key' => 'field_sitesetup_msg_intro_1',
		'type' => 'message',
		'label' => '',
		'message' => $content,
	));

	$theme_three = [
		'field_cp_header-logopicker',
		'field_cp_header-logotoggle',
		'field_cp_button-bgpicker',
		'field_cp_button-bgtoggle',
		'field_cp_button-textpicker',
		'field_cp_button-texttoggle',
		'field_cp_footer-bgpicker',
		'field_cp_footer-bgtoggle',
		'field_cp_footer-headerspicker',
		'field_cp_footer-headerstoggle',
		'field_cp_footer-textpicker',
		'field_cp_footer-texttoggle',
	];
	// array of color picker fields to clone (in order)
	$cps = array(
		'field_cpt4an89aason2kn'
		,'field_cpt4paampi2k2ksnsil'
		,'field_cpt4aoinadfin'
		,'field_cpt42o3innasgin'
		,'field_cpt4asoigngni2k'
		,'field_cpt423lknsdaknasln2'
		,'field_cpt4a23lk2lkn2ksk'
		,'field_cpt4asdogng092jn'
		,'field_cpt40s9jfo2mlkn'
		,'field_cpt4askgna9s2n'
		,'field_cpt4as09n2lknas'
		,'field_cpt4asdnag098hn2j'
		,'field_cpt4s0d9fn2oknal'
		,'field_cpt4ni34aklngk'
		,'field_cpt4s9aso2knl'
		,'field_cpt4ang8gnlks'
		,'field_cpt4agon2dg9naal'
		,'field_cpt4ng9ksj2aksng'
		,'field_8123afaasfdaef'
		,'field_2137dfhash12'
		,'field_21387fzadsf'
		,'field_2137dfhaafwsh12'
		,'field_hint_oi2n44akdfasd'
		,'field_27fzzzzadsf'
		,'field_21123zzzwsh12'
		,'field_2zcvvvczsf'
		,'field_21htjhwrew12'
		,'field_2123asaf'
		,'field_2czvdasfgsd'
		,'field_29wfeauajhadfsk'
		,'field_faauoiegwuf23'
	);
	
	

	// add all the color picker clones
	acf_add_local_field(array(
		'key' => 'field_setup_clonecpts'
		,'name' => 'setup-clone-cpts'
		,'type' => 'clone'
		,'clone' => array_values($cps)
		,'parent' => 'group_sitesetup_intro'
	));

	if( wp_get_theme()['Name'] == '123_three' ){

		acf_add_local_field(array(
			'key' => 'field_t3cps'
			,'name' => 'setup-clone-cpts_3'
			,'type' => 'clone'
			// ,'clone' => array_values($theme_three)
			,'clone' => array(
				'field_123_colorpicker_wrapper'
			)
			,'parent' => 'group_sitesetup_intro'
			,'display' => 'seamless'
			,'label' => 'Theme 3'
		));
	}

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
	// page 1 clones
	$clones = array(
		'field_bdaa98'			// company address
		,'field_8378888'		// company phone
		,'field_8378ddf888'		// company fax
		,'field_212o8afdh'		// company	email
	);
	
	 acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_clones_2',
		'label' => 'Clones 2',
		'name' => 'sitesetup_clones_2',
		'type' => 'clone',
		'clone' => $clones
	));
	

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_hours_msg',
		'type' => 'message',
		'message' => 'We will make sure these are visible on your new site so people will know which hours they can call for a live person or message you after hours through the site for information.',
		'display' => 'normal',
		'label' => '5. Hours of Operation',
	));

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
	
	$clones = array(
		'field_12hafhpwae'
		,'field_12haf2dafhpwae'
		,'field_12ha1212fhpwae'
		,'field_12hafhpwazdffde'
		,'field_12hafhp12398e'
		,'field_odasf129873e'
	);
	
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_clones_2_a',
		'label' => 'Payments',
		'name' => 'sitesetup_clones_2_a',
		'type' => 'clone',
		'clone' => $clones
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_1',
		'key' => 'field_sitesetup_clones_2_b',
		'label' => 'Socials',
		'name' => 'sitesetup_clones_2_b',
		'type' => 'clone',
		'clone' => array(
			'field_akan8a8sskshb'
		)
		,'display' => 'seamless'
	));

	/**
	*	Page 2
	*/
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_clones_3_0',
		'label' => 'Logo',
		'name' => 'sitesetup_clones_3_0',
		'type' => 'clone',
		'clone' => array(
			'field_2343135'
		)
		,'display' => 'seamless'
	));
	$clones = array(
		// 'field_2343135' 	// site logo
		'field_afd9zx7' 	// areas served banner
		,'field_23'			// contact banner
		,'field_bdsh8f'		// coupon banner
		,'field_15'			// gen blog banner
		,'field_5'			// gallery banner
		,'field_71b12312'	// menu banner
		,'field_9'			// services banner
		,'field_19'			// testimonials banner
		,'field_23'			// contact banner
	);
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_clones_3',
		'label' => '2. Choose Page Banners',
		'instructions' => 'select an image for each pages hero/banner image'
		,'name' => 'sitesetup_clones_3',
		'type' => 'clone',
		'clone' => array_values($clones)
		,'display' => 'normal'
		,'wrapper' => array(
			'id' => 'payment_types'
		)
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_2',
		'key' => 'field_sitesetup_clones_3_1',
		'label' => 'Gallery',
		'name' => 'sitesetup_clones_3_1',
		'type' => 'clone',
		'clone' => array(
			'field_6'
		)
		,'display' => 'seamless'
	));

	// Page 4: Verify Content
	$clones = array(
		'field_89dsuahf'
		,'field_1'
		,'field_09zcjxivohfasa'
		,'field_39qifdiuadiasadsf'
		,'field_70zcxovrghreafz'
		,'field_10'
	);
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_clones_4',
		'label' => '1. Add / Verify Content',
		'name' => 'sitesetup_clones_4',
		'type' => 'clone',
		'clone' => array_values($clones)
		,'display' => 'normal'
	));

	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_msg_bloglink',
		'type' => 'message',
		'message' => '3. <a target="_blank" href="'. get_admin_url() .'edit.php' .'"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/blog.jpg"></a>',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_msg_testimoniallink',
		'type' => 'message',
		'message' => '4. <a target="_blank" href="'. get_admin_url() .'admin.php?page=testimonials-settings/' .'"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/testimonials.jpg"></a>',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_3',
		'key' => 'field_sitesetup_msg_couponlink',
		'type' => 'message',
		'message' => '5. <a target="_blank" href="'. get_admin_url() . 'edit.php?post_type=coupon' .'"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/coupons.jpg"></a>',
	));
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_4',
		'key' => 'field_sitesetup_msg_godaddy',
		'type' => 'message',
		'message' => '1. <a target="_blank" href="https://www.godaddy.com/"><img class="sitesetup_images" src="http://www.123websites.com/images/signup/godaddy.jpg"></a>',
	));


	$custom_submit = '2. <input type="submit" accesskey="p" value="Publish Website" class="sitesetup-publish" name="publish">';
	acf_add_local_field(array(
		'parent' => 'group_sitesetup_4',
		'key' => 'field_sitesetup_msg_submit',
		'type' => 'message',
		'message' => $custom_submit,
	));
?>