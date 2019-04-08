<?php 


function check_theme(){
	$theme_header_style = '';

	if( wp_get_theme()->Name == '123_four' ){
		$theme_header_style = 'four';
	}
	if( wp_get_theme()->Name == '123_three' ){
		$theme_header_style = 'three';
	}
	else {
		$theme_header_style = 'one';
	}
	return $theme_header_style;
};
$verified_theme = check_theme();


/*
	Populate Setup_Pages Repeater's Select Field Choices w/ Required Page Templates:
*/
if(!function_exists('populate_setup_pages_choices')){
	function populate_setup_pages_choices(){
		// array of 'slug' => 'title'
		$choices = [];
		foreach(Pagedata::$required_pages as $slug => $info){
			if( $slug != 'terms' && $slug != 'disabled' ){
				$choices[$slug] = $info['title'];
			}
		}
		return $choices;
	}
}
add_action('acf/init', 'populate_setup_pages_choices');

/*
	Add Options Pages and Subpages
*/
if( function_exists('acf_add_options_page') ) {

	// Main Theme Settings
	// acf_add_options_page(array(
	// 	'page_title' 	=> 'Setup Website',
	// 	'menu_title'	=> 'Setup Website',
	// 	'menu_slug' 	=> 'site-setup',
	// 	'capability'	=> 'manage_options',
	// 	'icon_url'      => 'dashicons-admin-settings',
	// 	'redirect'		=> false,
	// 	'position' 		=> 2,
	// ));


	// Main Theme Settings
	acf_add_options_page(array(
		'page_title' 	=> '<h3>Sitewide Theme Settings</h3>',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'read_private_posts',
		'icon_url'      => 'dashicons-admin-settings',
		'redirect'		=> false,
		'position' 		=> 3,
	));


	// Blog Page Info
	acf_add_options_sub_page(array(
		'page_title' => 'Settings',
		'menu_title' => 'Settings',
		'menu_slug' => 'blog-settings',
		'parent_slug' => 'edit.php',
		'capability' => 'read_private_posts',
	));
	// Blog Page Banner
	acf_add_options_sub_page(array(
		'page_title' => 'Edit Banner',
		'menu_title' => 'Edit Banner',
		'menu_slug' => 'blog-settings-banner',
		'parent_slug' => 'edit.php',
		'capability' => 'read_private_posts',
	));
	// Coupons Banners
	acf_add_options_sub_page(array(
		'page_title' => 'Edit Banner',
		'menu_title' => 'Edit Banner',
		'menu_slug' => 'coupons-settings-banner',
		'parent_slug' => 'edit.php?post_type=coupon',
		'capability' => 'read_private_posts',
	));
	// Locations
	acf_add_options_page(array(
		'page_title' 	=> ' ',
		'menu_title'	=> 'Locations',
		'menu_slug' 	=> 'locations-settings',
		'capability'	=> 'read_private_posts',
		'icon_url'      => 'dashicons-location-alt',
		'redirect'		=> false,
		'position'      => 85,
	));
	// Locations Banner
	acf_add_options_sub_page(array(
		'page_title' => 'Edit Banner',
		'menu_title' => 'Edit Banner',
		'menu_slug' => 'locations-settings-banner',
		'parent_slug' => 'locations-settings',
		'capability' => 'read_private_posts',
	));
	// Menu
	acf_add_options_page(array(
		'page_title' 	=> ' ',
		'menu_title'	=> 'Menu',
		'menu_slug' 	=> 'menu-settings',
		'capability'	=> 'read_private_posts',
		'icon_url'      => 'dashicons-feedback',
		'redirect'		=> false,
		'position'      => 86,
	));
	// Menu Banner
	acf_add_options_sub_page(array(
		'page_title' => 'Edit Banner',
		'menu_title' => 'Edit Banner',
		'menu_slug' => 'menu-settings-banner',
		'parent_slug' => 'menu-settings',
		'capability' => 'read_private_posts',
	));
}
/*
	Add Fields and Groups
 */

if( !function_exists('add_acf_fields') ){
	function add_acf_fields() {
        /**
         * COUPON
         */
		acf_add_local_field_group(array(
			'key' => 'group_23oinalk',
			'title' => 'Coupon Page Options',
			'fields' => array(
				array(
					'key' => 'field_bdsh8f',
					'label' => 'Banner / Background Image',
					'name' => 'general-coupons-bg',
					'type' => 'image',
					'preview_size' => 'medium',
					'return_format' => 'url',
				),
				array(
					'key' => 'field_7fbaxhp',
					'label' => 'Number of Posts Per Page',
					'name' => 'general-coupons-postsperpage',
					'type' => 'number',
					'min' => -1,
					'default_value' => 10,
					'instructions' => 'To have unlimited posts per page set this field to -1',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'coupons-settings-banner',
					),
				),
			),
        ));
        /**
         * blog
         */
		acf_add_local_field_group(array(
			'key' => 'group_gms9maaksjdsuj',
			'title' => 'Blog Banner',
			'fields' => array(
				array(
				'key' => 'field_15',
				'label' => 'Banner / Background Image',
				'name' => 'general-blog-bg',
				'type' => 'image',
				'return_format' => 'url',
				'preview_size' => 'medium',
				),
			),	
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'blog-settings-banner',
					),
				),
			),
		));
		acf_add_local_field_group(array(
			'key' => 'group_23naksjdsuj',
			'title' => 'Blog Banner',
			'fields' => array(
				array(
					'key' => 'field_387126',
					'label' => 'Number of Posts Per Page',
					'name' => 'posts-per-page',
					'type' => 'number',
					'min' => -1,
					'default_value' => 10,
					'instructions' => 'To have unlimited posts per page set this field to -1',
				),
				array(
					'key' => 'field_zcv08123',
					'label' => 'Disable Categories?',
					'type' => 'true_false',
					'name' => 'disable-categories',
					'instructions' => 'Tick this box to remove and disable categories from being accessed from the front-end.',
				),
				array(
					'key' => 'field_nadnayeyf',
					'label' => 'Select Your Featured Posts',
					'name' => 'featured-posts',
					'type' => 'repeater',
					'min' => 3,
					'max' => 3,
					'sub_fields' => array(
						array(
							'key' => 'field_ybhabay3',
							'label' => 'Post',
							'type' => 'post_object',
							'name' => 'featured-posts-post',
							'instructions' => 'The posts you make in "Posts" appear here. If you don\'t choose 3, other posts will populate in their place if they exist.',
							'post_type' => array(
								0 => 'post',
							),
							'allow_null' => 1,
						),
					),
				),
			),	
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'blog-settings',
					),
				),
			),
		));
		/*
			Theme Settings Fields
		*/
		acf_add_local_field_group(array(
			'key' => 'group_5',
			'title' => ' ',
			'fields' => array (
				array(
					'key' => 'field_8b7ahnwfe',
					'message' => '<h1>Click on a tab below to see its corresponding settings. Click "Update" in the top right to save.</h1>',
					'type' => 'message',
				),
				array(
					'key' => 'field_876646',
					'label' => '1. Company Info',
					'name' => 'company-info',
					'type' => 'tab',
				),	
				array(
					'key' => 'field_npy320af',
					'label' => 'Company Name',
					'name' => 'site_title',
					'type' => 'text',
				),
				array(
					'key' => 'field_npy320zdfa1212af',
					'label' => 'Google Description',
					'name' => 'tagline',
					'type' => 'text',
				),
				array(
					'key' => 'field_8372zzzn12',
					'label' => 'Company Logo',
					'name' => 'logo-type-switch',
					'type' => 'select',
					'instructions' => 'This allows you to switch between providing a custom logo or creating one from the site name.<br/><br/><strong style="color:blue;">***IMPORTANT: IF YOU SELECT TEXT YOU MUST CLICK UPDATE TWICE FOR THIS CHANGE TO TAKE AFFECT. ALSO IF YOU CHANGE THE COMPANY NAME AND ARE USING THE TEXT OPTION YOU NEED TO CHANGE IT TO LOGO, HIT SAVE, THEN CHANGE IT BACK TO TEXT AND HIT SAVE TO THE CHANGES TO TAKE EFFECT.***</strong><br/>An image will automatically be generated containing the text from Company Name which should be short and sweet (under 24 characters).',
					'choices' => array(
						'logo' => 'Logo',
						'text' => 'Text',
					),
					'default_value' => array(
						'logo' => 'Logo',
					),
				),
				array(
					'key' => 'field_2343135',
					'label' => 'Site Logo',
					'name' => 'general-logo',
					'type' => 'image',
					'return_format' => 'url',
					'preview_size' => 'medium_large',
					'instructions' => 'Use a light version or else it won\'t show up very well. This field is required. PNG or another web-friendly format with an alpha channel preferred.',
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_8372zzzn12',
								'operator' => '==',
								'value' => 'logo',
							),
						)
					),
				),		
				array(
					'key' => 'field_bdaa98',
					'label' => 'Company Address',
					'name' => 'social-address',
					'type' => 'google_map',
					'center_lat' => '40.141256',	
					'center_lng' => '-97.681034',
					'instructions' => 'This is the address that appears in the footer. If left blank it will not show up.',
				),
				array(
					'key' => 'field_zifhef',
					'label' => 'Company Address Line 2',
					'name' => 'social-address-line2',
					'type' => 'text',
					'instructions' => 'This is the second line of the address provided above which will be inserted before the first comma. Useful for suite number, apartment number, floor number etc.',
				),
				array(
					'key' => 'field_8378888',
					'label' => 'Company Phone Number',
					'name' => 'social-phone-number',
					'type' => 'text',
					'instructions' => 'Must be in (555) 555-5555 format. Leave it blank if you don\'t want your company phone number to show up in the footer.',
				),
				array(
					'key' => 'field_8378ddf888',
					'label' => 'Company Fax Number',
					'name' => 'social-fax-number',
					'type' => 'text',
					'instructions' => 'Must be in (555) 555-5555 format. Leave it blank if you don\'t want your company phone number to show up in the footer.',
				),	
				array(
					'key' => 'field_212o8afdh',
					'label' => 'Company Email',
					'name' => 'company-email',
					'type' => 'email',
					'instructions' => 'This is the email that the contact form will be sent to.'
					
				),
				/**
				*	
				*	
				*	Color Pickers
				*	
				*	
				**/
				array(
					'key' => 'field_padfh123ad',
					'label' => '2. Colors',
					'type' => 'tab',
				),
				array(
					'name' => 'cp-t4-headers-text',
					'key' => 'field_cpt4an89aason2kn',
					'type' => 'color_picker',
					'label' => 'Text Over Focus Image Headers',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'name' => 'cp-t4-headers-text-toggle',
					'key' => 'field_cpt4paampi2k2ksnsil',
					'type' => 'true_false',
					'label' => 'On / Off',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				// Pick Accent BG Color (Default: Red)
				array(
					'name' => 'cp-t4-accent-bg',
					'key' => 'field_cpt4aoinadfin',
					'type' => 'color_picker',
					'label' => 'Accent Color<br><p class="admin_cp-label-caption">(Default: Red)</p>',
					'wrapper' => array(
						'width' => 40
					),
				),
				// Toggle Accent BG Color (Default: Red)
				array(
					'key' => 'field_cpt42o3innasgin',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-accent-bg-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				// Pick Text Over Accent Color (Default: White)
				array(
					'name' => 'cp-t4-accent-text',
					'key' => 'field_cpt4asoigngni2k',
					'type' => 'color_picker',
					'label' => 'Text Over Accent Color<br><p class="admin_cp-label-caption">(Default: White)</p>',
					'wrapper' => array(
						'width' => 40
					),
				),
				// Toggle Text Over Accent Color (Default: White)
				array(
					'key' => 'field_cpt423lknsdaknasln2',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-accent-text-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),

				// Pick Font Color Over Website Background (Default: White)
				array(
					'name' => 'cp-t4-site-bg-text',
					'key' => 'field_cpt4a23lk2lkn2ksk',
					'type' => 'color_picker',
					'label' => 'Text Over Website Background<br><p class="admin_cp-label-caption">(Default: White)</p>',
					'wrapper' => array(
						'width' => 40
					),

				),
				// Toggle Font Color Over Website Background (Default: White) 
				array(
					'key' => 'field_cpt4asdogng092jn',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-site-bg-text-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				// Pick Website Background
				array(
					'name' => 'cp-t4-site-bg',
					'key' => 'field_cpt40s9jfo2mlkn',
					'type' => 'color_picker',
					'label' => 'Website Background<br><p class="admin_cp-label-caption">(Default: Black)</p>',
					'wrapper' => array(
						'width' => 40
					),
				),
				// Text Over Darker Background
				array(
					'key' => 'field_cpt4askgna9s2n',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-site-bg-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				// Pick Primary Text Color
				array(
					'name' => 'cp-t4-general-text',
					'key' => 'field_cpt4as09n2lknas',
					'type' => 'color_picker',
					'label' => 'Primary Text Color<br><p class="admin_cp-label-caption">(Default: White)</p>',
					'wrapper' => array(
						'width' => 40
					),
				),
				// Toggle Primary Text Color
				array(
					'key' => 'field_cpt4asdnag098hn2j',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-general-text-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				// Pick Mid Background / Footer
				array(
					'name' => 'cp-t4-element-bg',
					'key' => 'field_cpt4s0d9fn2oknal',
					'type' => 'color_picker',
					'label' => 'Mid Background<br><p class="admin_cp-label-caption">(Default: Mid Gray)</p>',
					'wrapper' => array(
						'width' => 40
					),
				),
				// Toggle Mid Background / Footer
				array(
					'key' => 'field_cpt4ni34aklngk',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-element-bg-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				// Pick Text Over Darker Background
				array(
					'name' => 'cp-t4-element-bg-text',
					'key' => 'field_cpt4s9aso2knl',
					'type' => 'color_picker',
					'label' => 'Text Over Darker Background<br><p class="admin_cp-label-caption">(Default: Gray)</p>',
					'wrapper' => array(
						'width' => 40
					),
				),
				// Toggle Text Over Darker Background
				array(
					'key' => 'field_cpt4ang8gnlks',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-element-bg-text-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				// Pick Darker Background
				array(
					'name' => 'cp-t4-element-bg-dark',
					'key' => 'field_cpt4agon2dg9naal',
					'type' => 'color_picker',
					'label' => 'Darker Background<br><p class="admin_cp-label-caption">(Default: Dark Gray)</p>',
					'wrapper' => array(
						'width' => 40
					),
				),
				// Watch Darker Background
				array(
					'key' => 'field_cpt4ng9ksj2aksng',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'cp-t4-element-bg-dark-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				/*
					End of Theme 4 Color Pickers
				 */



				// Old Stuff (still good!)
				array(
					'key' => 'field_8123afaasfdaef',
					'label' => 'Header / Footer Navigation Bar BG',
					'type' => 'color_picker',
					'name' => 'navs-bg',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_2137dfhash12',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'navs-bg-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				array(
					'key' => 'field_21387fzadsf',
					'label' => 'Header / Footer Navigation Bar Text',
					'type' => 'color_picker',
					'name' => 'navs-text',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_2137dfhaafwsh12',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'navs-text-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				array(
					'key' => 'field_27fzzzzadsf',
					'label' => 'Buttons / Underlines',
					'type' => 'color_picker',
					'name' => 'buttons-underlines',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_21123zzzwsh12',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'buttons-underlines-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				array(
					'key' => 'field_2zcvvvczsf',
					'label' => 'Section Header Text',
					'type' => 'color_picker',
					'name' => 'bold-title-text',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_21htjhwrew12',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'bold-title-text-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				array(
					'key' => 'field_2123asaf',
					'label' => 'Sidebar BG / Coupon BG / Areas Served BG',
					'type' => 'color_picker',
					'name' => 'sidebar-coupon-areasserved-bg',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_2czvdasfgsd',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'sidebar-coupon-areasserved-bg-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				array(
					'key' => 'field_29wfeauajhadfsk',
					'label' => 'Top "Free Estimate" Bar / Footer Copyright Bar',
					'type' => 'color_picker',
					'name' => 'top-bottom-bg',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_faauoiegwuf23',
					'label' => 'On / Off',
					'type' => 'true_false',
					'name' => 'top-bottom-bg-toggle',
					'ui' => true,
					'ui_on_text' => 'On',
					'ui_off_text' => 'Off',
					'wrapper' => array(
						'width' => 60
					),
				),
				array(
				     'key' => 'field_123_colorpicker_wrapper'
				    ,'label' => ''
				    ,'name' => 'add_extra_theme_colors'
					,'type' => 'group'
					,'display' => 'seamless'
			    ),
				// /////////////////////
				// // Setup Pages Tab //
				// /////////////////////
				array(
					'key' => 'field_128372613bad21',
					'label' => '4. Main Menu',
					'type' => 'tab',
				),
				array(
					'key' => 'field_b78h32asdfmsda',
					'label' => 'Don\'t Fade-In Nav Background Tint?',
					'type' => 'true_false',
					'name' => 'nav-fadein-toggle',
					'wrapper' => array(
						'width' => '25',
					),
				),
				array(
					'key' => 'field_bnkpda3',
					'label' => 'Invert Header/Footer Logo Colors?',
					'type' => 'true_false',
					'default_value' => false,
					'name' => 'general-theme-invert-headerfooter-logo-colors',
					'wrapper' => array(
						'width' => '25',
					),
				),
				// enable select header style
				array(
					'key' => 'field_settings_na8n2lknsa0g'
					,'name' => 'enable-choose-header'
					,'label' => 'Use Another Header Style?'
					,'type' => 'true_false'
					,'ui' => 1
					,'ui_on_text' => 'Active'
					,'ui_off_text' => 'Inactive'
				),
				// select a header style
				array(
					'key' => 'field_settings_oi23oitns9k'
					,'name' => 'choose-header-style'
					,'label' => 'Choose Header Style'
					,'wrapper' => array(
						'id' => 'choose-header'
					)
					,'type' => 'radio'
					,'layout' => 'vertical'
					,'conditional_logic' => array(
						array(
							array(
								'field' => 'field_settings_na8n2lknsa0g',
								'operator' => '==',
								'value' => 1,
							)
						)
					)
					,'choices' => array(
						'one' => 'One'
						,'two' => 'Two'
						,'three' => 'Three'
						,'four' => 'Four'
						,'five' => 'Five'
						,'six' => 'Six'
						,'seven' => 'Seven'
						,'eight' => 'Eight'
						,'nine' => 'Nine'
						,'ten' => 'Ten'
					)
					,'default_value' => $verified_theme
				),
				// 
				array(
					'key' => 'field_naaolkn23oin',
					'type' => 'repeater',
					'name' => 'refactoring-setup-pages',
					'label' => '<h2>Setup Home Page Sections</h2>',
					'instructions' => 'add, remove or reorder homepage sections by type',
					'sub_fields' => array(
						array(
							'key' => 'field_2o3i5ng890haoin',
							'type' => 'select',
							'name' => 'page-template',
							'label' => 'Type',
							'choices' => populate_setup_pages_choices(),
						),
						array(
							'key' => 'field_ma9nkolagaseaoin',
							'type' => 'text',
							'name' => 'page-altname',
							'label' => 'Change the Page Name?',
							'placeholder' => 'will default to type name',
						),
					),
				),
				////////////////
				// Footer Tab //
				////////////////
				array(
					'key' => 'field_8712000',
					'label' => '5. Footer',
					'name' => 'social-settings',
					'type' => 'tab',
				),
				////////////////////////
				// Social Media Icons //
				////////////////////////
				array(
					'key' => 'field_akan8a8sskshb',
					'label' => 'Add new Social Media Icons',
					'instructions' => 'add, rearrange and customize social media icons',
					'name' => 'social-repeater',
					'type' => 'repeater',
					'button_label' => 'Add Social Icon',
					'collapsed' => 'field_ng98anaslkd',
					'sub_fields' => array(
						array(
							'key' => 'field_ng98anaslkd',
							'label' => '<h2>Site / Profile (entire URL)</h2>',
							'name' => 'url',
							'type' => 'url',
							'instructions' => 'Paste entire URL including http://',
						),
						array(
							'key' => 'field_kas98gnhjasnds3n',
							'label' => '<h2>Custom Font-Awesome Icon</h2>',
							'name' => 'fonticon',
							'type' => 'font-awesome',
							'return_format' => 'class',
							'save_format' => 'class',
							'allow_null' => 1,
							'instructions' => '!Important!<br>Groupon, Pinterest and Booksy display built-in custom icons<br>Leave font icon blank for these links<br>A custom image overrides this',
						),
						array(
							'key' => 'field_mnna0snaglknasik',
							'label' => '<h2>Custom PNG Icon</h2>',
							'name' => 'image',
							'type' => 'image',
							'instructions' => 'Must be .png',
							'mime_types' => '.png',
						),
					),
				),
				////////////
				// Badges //
				////////////
				array(
					'key' => 'field_o2be34tgashv',
					'label' => '<h2>Custom Award Badge Links</h2>',
					'name' => 'custom-badges',
					'type' => 'repeater',
					'sub_fields' => array(
						array(
							'key' => 'field_g2tgzagggskdsd',
							'label' => 'Link',
							'name' => 'link',
							'type' => 'link',
						),
						array(
							'key' => 'field_g55gagta2j3nl',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
						),
					),
				),
				///////////////////
				// Payment Types //
				///////////////////
				array(
					'key' => 'field_mpoh12hadf',
					'label' => 'Choose Payment Types Accepted',
					'name' => 'payment-types',
					'type' => 'message',
				),
				array(
					'key' => 'field_12hafhpwae',
					'label' => 'Mastercard',
					'name' => 'mastercard',
					'type' => 'true_false',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_mzcpoihhad',
					'label' => 'Mastercard Image',
					'name' => 'mastercard-image',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_12hafhzapwae',
					'label' => 'Visa',
					'name' => 'visa',
					'type' => 'true_false',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_mzcpaf122oihhad',
					'label' => 'Visa Image',
					'name' => 'visa-image',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_12haf2dafhpwae',
					'label' => 'American Express',
					'name' => 'amex',
					'type' => 'true_false',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_mzc219z',
					'label' => 'Amex Image',
					'name' => 'amex-image',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_12ha1212fhpwae',
					'label' => 'Discover',
					'name' => 'discover',
					'type' => 'true_false',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_mooooihhad',
					'label' => 'Discover Image',
					'name' => 'discover-image',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_12hafhpwazdffde',
					'label' => 'Paypal',
					'name' => 'paypal',
					'type' => 'true_false',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_mzcpoiz2',
					'label' => 'Paypal Image',
					'name' => 'paypal-image',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_12hafhp12398e',
					'label' => 'Cash',
					'name' => 'cash',
					'type' => 'true_false',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_zcvadf123dsaf',
					'label' => 'Cash Image',
					'name' => 'cash-image',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_odasf129873e',
					'label' => 'Check',
					'name' => 'check',
					'type' => 'true_false',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_lafdhd123',
					'label' => 'Check Image',
					'name' => 'check-image',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array(
						'width' => 40,
					),
				),
				array(
					'key' => 'field_ocozvzcvh213',
					'label' => 'Disable Terms & Conditions?',
					'name' => 'terms-disable',
					'type' => 'true_false',
					'ui' => true,
					'instructions' => 'if disabled the terms & conditions page will be disabled and the link to it in the footer will disappear.',
				),
				array (
					'key' => 'field_89ahzbdjao',
					'label' => 'Terms & Conditions',
					'name' => 'terms-content',
					'type' => 'wysiwyg',
				),
				array(
					'key' => 'field_mp9213adf',
					'label' => '<h1 style="color: red;">Looking for something?</h1>
								<div>
								- Company Address - Please see "1. Company Info" tab.<br/>
								- Company Phone Number - Please see "1. Company Info" tab.<br/>
								- Company Fax Number - Please see "1. Company Info" tab.<br/>
								- Parent Co. Logo - Please see "7. Parent Co." tab.
								</div>',
					'type' => 'message',
				),
				array(
					'key' => 'field_12837261321',
					'label' => '6. Pop-Ups',
					'type' => 'tab',
					'name' => 'popup-settings',
				),
				array(
					'key' => 'field_72afasd7161',
					'message' => '<h2 style="font-size:20px"><strong>Top Bar Pop-Up</strong></h2>',
					'type' => 'message'
				),
				array(
					'key' => 'field_987czvyh12',
					'label' => 'Image',
					'type' => 'image',
					'name' => 'topbar-image',
					'return_format' => 'url',
				),
				array(
					'key' => 'field_18216124',
					'label' => 'Header Bar Text',
					'type' => 'text',
					'name' => 'header-bar-text',
					'default_value' => 'Click here for a free estimate!!!',
					'instructions' => 'This is the text that appears in the topbar',
				),
				array(
					'key' => 'field_12938udsafgh',
					'label' => 'Slogan',
					'type' => 'text',
					'name' => 'topbar-slogan',
					'instructions' => 'This is the text that appears in the topbar popup',
				),
				array(
					'key' => 'field_89zv213gd',
					'label' => 'Client Email',
					'type' => 'email',
					'name' => 'topbar-email',
					'instructions' => 'This is the email that the topbar popup forms will send to.'
				),
				array(
					'key' => 'field_b78h32msda',
					'label' => 'Disable',
					'type' => 'true_false',
					'name' => 'remove-topbar',
					'instructions' => 'If checked this will hide the Top Bar',
				),
				array(
					'key' => 'field_72712261',
					'message' => '<h2 style="font-size:20px"><strong>Timed Pop-Up</strong></h2>',
					'type' => 'message'
				),
				array(
					'key' => 'field_871216162',
					'label' => 'Image',
					'name' => 'ad-image',
					'type' => 'image',
					'preview_size' => 'medium',
					'return_format' => 'url',
				),
				array(
					'key' => 'field_38276235123',
					'label' => 'Slogan',
					'name' => 'ad-header',
					'type' => 'text',
					'instructions' => 'This is the text that appears above the form on the ad popup.'
				),
				array(
					'key' => 'field_89zv09876gd',
					'label' => 'Client Email',
					'type' => 'email',
					'name' => 'ad-email',
					'instructions' => 'This is the email that the timed popup forms will send to.'
				),
				array(
					'key' => 'field_m12hdaf7213',
					'label' => 'Disable',
					'name' => 'ad-disable',
					'type' => 'true_false',
					'instructions' => 'If checked this will disable the Timed Pop-Up',
				),
				array(
					'key' => 'field_727161',
					'message' => '<h2 style="font-size:20px"><strong>Estimate Pop-Up</strong></h2>',
					'type' => 'message'
				),
				array(
					'key' => 'field_182163124',
					'label' => 'Header Button Text',
					'type' => 'text',
					'name' => 'quickquote-button-text',
					'default_value' => 'Quick Quote',
					'maxlength' => '11',
					'instructions' => 'This is the text that will appear in the button. Keep this under 11 characters.',
				),
				array(
					'key' => 'field_87216162',
					'label' => 'Image',
					'name' => 'quickquote-image',
					'type' => 'image',
					'preview_size' => 'medium',
					'return_format' => 'url',
				),
				array(
					'key' => 'field_38276123',
					'label' => 'Slogan',
					'name' => 'quickquote-header',
					'type' => 'text',
					'instructions' => 'This is the text that appears above the form on the estimate popup.',
				),
				array(
					'key' => 'field_2hdaf89ads',
					'label' => 'Client Email',
					'type' => 'email',
					'name' => 'quickquote-email',
					'instructions' => 'This is the email that the estimate popup forms will send to.'
				),
				array(
					'key' => 'field_zfe32123',
					'label' => 'Disable',
					'name' => 'quickquote-disable',
					'type' => 'true_false',
					'instructions' => 'If checked this will disable the Header Button and it\'s popup', 
				),
				array(
					'key' => 'field_08cvoizhcxvhxz',
					'label' => 'Popup Time (first time)',
					'type' => 'number',
					'append' => 'seconds',
					'name' => 'popuptime-short',
					'instructions' => 'If left blank this is 30 seconds',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_pqowfjsklhv23reg',
					'label' => 'Popup Time (saw ad but clicked out)',
					'type' => 'number',
					'append' => 'seconds',
					'name' => 'popuptime-long',
					'instructions' => 'If left blank this is 3600 seconds (one hour)',
					'wrapper' => array(
						'width' => 40
					),
				),
				array(
					'key' => 'field_mp92adf13123wsf',
					'label' => '<h1 style="color: red;">Looking for something?</h1>
								<div>
								- Company Email - Please see "1. Company info" tab.
								</div>',
					'type' => 'message',
				),
				////////////////////////
				// Parent Company Tab //
				////////////////////////
				array(
					'key' => 'field_97zvh21',
					'type' => 'tab',
					'label' => '9. Parent Co.',
				),
				array(
					'key' => 'field_8sna0sklfjfa8nfja',
					'type' => 'select',
					'allow_null' => 1,
					'label' => 'Choose Parent Company',
					'choices' => array(
						'webx' => 'WebX Websites'
						,'onenet' => '1 Network'
						,'2020' => '2020 Network'
						,'123' => '123'
						// 'demo' => 'Demo'
					),
					'name' => 'webx-select',
					'ui' => 1,
					'instructions' => 'Select the Parent Company (don\'t forget to update)',
				),
				// select light-or-dark webx logo
				array(
					'key' => 'field_n0982nl23n5lkmad',
					'label' => 'Logo Color',
					'instructions' => 'Select The Logo Color That best compliments the Clients Footer Background. If The Client has a Dark or Black Background Select a Light Logo. If The Client has a light or White Background select a Dark logo.',
					'name' => 'webx-isdark-check',
					'type' => 'select',
					'choices' => array(
						'light' => 'Light',
						'dark' => 'Dark'
					),
					// 'allow_null' => 1,
				),	
				//////////////
				// MISC TAB //
				//////////////
				array(
					'key' => 'field_218372012112173',
					'label' => 'Misc.',
					'name' => 'general-404-settings',
					'type' => 'tab',
				),
				array(
					'key' => 'field_83nbjd',
					'label' => 'Image Placeholder',
					'instructions' => 'This is the image that will pop up if there\'s no featured image provided in a blog post.',
					'type' => 'image',
					'return_format' => 'url',
					'preview_size' => 'medium',
					'name' => 'featured-placeholder',
				),
				array(
					'key' => 'field_16',
					'label' => '404 Background Image',
					'name' => 'general-404-bg',
					'type' => 'image',
					'return_format' => 'url',
					'preview_size' => 'medium',
					'instructions' => '404 is the page that shows up when a page can\'t be found',
				),
				array(
					'key' => 'field_217710',
					'label' => '404 Header Text',
					'name' => 'general-404-header',
					'type' => 'text',
					'instructions' => 'If left blank this defaults to "404"',
					'default_value' => '404',
				),
				array(
					'key' => 'field_217752110',
					'label' => '404 Subheader Text',
					'name' => 'general-404-subheader',
					'type' => 'textarea',
					'new_lines' => 'br',
					'instructions' => 'If left blank this defaults to "The requested page is not available. Click here to return home."',
				),
				
				array(
					'key' => 'field_b8n2qnafhdpz',
					'label' => 'Custom CSS',
					'type' => 'acf_code_field',
					'name' => 'custom-css',
					'theme' => 'monokai',
					'mode' => 'css',
				),
				array(
					'key' => 'field_oohpadf812',
					'label' => 'Disable Site',
					'type' => 'tab',
				),
				array(
					'key' => 'field_mz09271yadsd',
					'label' => '<h3 style="color: red; margin-bottom: 6px;">Do you want to disable the site?</h3> (the text that\'s shown is the answer to that question)',
					'type' => 'true_false',
					'name' => 'disable-site',
					'ui' => true,
					'instructions' => 'When you re-enable the site be sure to clear your browser\'s cache to avoid the redirect.',
				),
				array(
					'key' => 'field_13366',
					'name' => 'general-admin-bg',
					'type' => 'link',
					'label' => 'Disabled Page Background',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'general-settings',
					),
				),
			),
		));
		/*
			Locations Settings Fields
		 */
		acf_add_local_field_group(array(
			'key' => 'group_7',
			'title' => ' ',
			'fields' => array (
				
				array(
					'key' => 'field_2137dsafh',
					'label' => 'List of Locations',
					'type' => 'tab',
				),
				array(
					'key' => 'field_392716161',
					'label' => 'Addresses',
					'name' => 'addresses-repeater',
					'type' => 'repeater',
					'button_label' => 'Add Address',
					'min' => 1,
					'sub_fields' => array(
						array(
							'key' => 'field_93717167122',
							'label' => 'General',
							'type' => 'tab',
						),
						array(
							'key' => 'field_3771721fda',
							'label' => 'Location Name',
							'type' => 'text',
							'name' => 'addresses-name',
							'instructions' => 'If there\'s no official name try providing something about the address eg: "Main St. Location".',
							'required' => true,
						),
						array(
							'key' => 'field_1817262',
							'label' => 'Map',
							'type' => 'google_map',
							'name' => 'addresses-gmap',
							'center_lat' => '40.141256',	
							'center_lng' => '-97.681034',
							'required' => true,
						),
						array(
							'key' => 'field_86fdas',
							'label' => 'Address Line 2',
							'type' => 'text',
							'name' => 'addresses-extra',
							'instructions' => 'Suite number, apt number, floor number etc. Will be applied before the first comma in the address',
						),
						array(
							'key' => 'field_937171vff',
							'label' => "Hours",
							'type' => 'tab',
						),
						array(
							'key' => 'field_3876f',
							'label' => 'Hours',
							'name' => 'addresses-hours-repeater',
							'type' => 'repeater',
							'button_label' => 'Add Hours',
							'instructions' => 'Leave blank if you want "24/7" to appear instead.',
							'sub_fields' => array(
								array(
									'key' => 'field_877aa6ff8',
									'label' => 'Day Start',
									'name' => 'addresses-hours-day-start',
									'type' => 'select',
									'choices' => array(
										'sun' => 'Sun',
										'mon' => 'Mon',
										'tues' => 'Tues',
										'wed' => 'Wed',
										'thurs' => 'Thurs',
										'fri' => 'Fri',
										'sat' => 'Sat',
									),
									'required' => true,
									'allow_null' => true,
									'ui' => 1,
								),
								array(
									'key' => 'field_8776ff8',
									'label' => 'Day End',
									'name' => 'addresses-hours-day-end',
									'type' => 'select',
									'instructions' => 'Leave this blank if you want these hours to be applied to one day instead of a range of days',
									'choices' => array(
										'sun' => 'Sun',
										'mon' => 'Mon',
										'tues' => 'Tues',
										'wed' => 'Wed',
										'thurs' => 'Thurs',
										'fri' => 'Fri',
										'sat' => 'Sat',
									),
									'allow_null' => true,
									'ui' => 1,
								), 
								array(
									'key' => 'field_983y112',
									'name' => 'addresses-hours-time-start',
									'type' => 'time_picker',
									'label' => 'Time Start',
									'instructions' => 'Leave both Time Start and Time End blank if you want "All Day" to appear instead.',
								),
								array(
									'key' => 'field_983y11b12',
									'name' => 'addresses-hours-time-end',
									'type' => 'time_picker',
									'label' => 'Time End',
									'instructions' => 'Leave both Time Start and Time End blank if you want "All Day" to appear instead.',
								),
								array(
									'key' => 'field_983y1a1b12',
									'name' => 'addresses-hours-closed',
									'type' => 'true_false',
									'label' => 'Closed?',
									'instructions' => 'If you are closed this day tick this box-sizing.',
								),
							),
						),
						array(
							'key' => 'field_8937ffdsa',
							'label' => 'Phone Numbers',
							'type' => 'tab',
						),
						array(
							'key' => 'field_26',
							'label' => 'Office Phone Number',
							'type' => 'text',
							'name' => 'contact-office',
							'required' => true,
							'instructions' => 'Must be in (555) 555-5555 format.',
						),
						array(
							'key' => 'field_25',
							'label' => 'Cell Phone Number',
							'type' => 'text',
							'name' => 'contact-cell',
							'instructions' => 'Must be in (555) 555-5555 format.',
						),
						array(
							'key' => 'field_27',
							'label' => 'Fax Number',
							'type' => 'text',
							'name' => 'contact-fax',
							'instructions' => 'Must be in (555) 555-5555 format.',
						),
					),
					'layout' => 'row',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'locations-settings',
					),
				),
			),
		));
		/*
			Locations Settings Banner Fields
		 */
		acf_add_local_field_group(array(
			'key' => 'group_13223konksska',
			'title' => 'Edit Banner',
			'fields' => array(
				array(
					'key' => 'field_23',
					'label' => 'Banner / Background Image',
					'name' => 'contact-bg',
					'type' => 'image',
					'preview_size' => 'medium',
					'return_format' => 'url',
				),
				array(
					'key' => 'field_873262213',
					'label' => 'Slogan',
					'name' => 'general-contact-slogan',
					'type' => 'textarea',
					'instructions' => 'This is the text that appears in the section just above the footer on all pages except the contact page. You can add new lines here.',
					'new_lines' => 'br',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'locations-settings-banner',
					),
				),
			),
		));
		/*
			Coupons Settings Fields
		 */
		acf_add_local_field_group(array(
			'key' => 'group_8',
			'title' => ' ',
			'fields' => array (
				array(
					'key' => 'field_bx9ehdf',
					'label' => 'Expiration Date',
					'type' => 'date_time_picker',
					'name' => 'coupon-expiration-date',
					'display_format' => 'M jS, Y g:i a',
					'return_format' => 'M jS, Y g:i a',
					'first_day' => 0,
				),
				array(
					'key' => 'field_bx9dehdf',
					'label' => 'Coupon Code',
					'type' => 'text',
					'name' => 'coupon-code',
					'instructions' => 'Please use only capital letters and numbers for ease of translation across platforms.',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'coupon',
					),
				),
			),
		));
		/*
			Menu Settings Fields
		 */
		acf_add_local_field_group(array(
			'key' => 'group_9',
			'title' => 'Add and Setup Menus',
			'fields' => array (
				array(
					'key' => 'field_weqr123h',
					'label' => 'Menu Categories/Items',
					'type' => 'tab',
				),
				// repeater of menus
				array(
					'key' => 'field_nsdhaeawf',
					'label' => 'Menu Categories/Items',
					'name' => 'menu-repeater',
					'type' => 'repeater',
					'button_label' => 'Add Menu Category',
					'layout' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'field_nn111aa',
							'label' => 'Menu Category Name',
							'type' => 'text',
							'name' => 'menu-category-name',
						),
						array(
							'key' => 'field_nn11z1aa',
							'label' => 'Menu Category Description',
							'type' => 'textarea',
							'name' => 'menu-category-description',
						),
						array(
							'key' => 'field_9sinfalka09ng',
							'label' => 'Menu Category Type',
							'type' => 'select',
							'name' => 'menutype',
							'choices' => array(
								'masonry' => 'Photo Style',
								'list' => 'List Style',
								'pdf' => 'PDF',
								'gallery' => 'Gallery',
							),
							'instructions' => 'Use Photo Style if you have images and List Style if you don\'t.',
							'default_value' => array(
								0 => 'masonry',
							),
							'layout' => 'horizontal',
							'allow_null' => 1,
							'toggle' => 0,
							'return_format' => 'value',
							'ui' => 1,
							'ajax' => 1,
						),
						// masonry style
						array(
							'key' => 'field_yfhawhfoea',
							'label' => 'Menu Category Items',
							'type' => 'repeater',
							'name' => 'menu-category-repeater',
							'button_label' => 'Add New Menu Item',
							'sub_fields' => array(
								array(
									'key' => 'field_nb12h12321',
									'label' => 'Use Menu Item Picture?',
									'name' => 'menu-item-picture-toggle',
									'type' => 'true_false',
								),
								array(
									'key' => 'field_idahf122',
									'label' => 'Menu Item Picture',
									'name' => 'menu-item-picture',
									'type' => 'image',
									'return_format' => 'url',
								),
								array(
									'key' => 'field_ndkfwp23',
									'label' => 'Menu Item Name',
									'name' => 'menu-item-name',
									'type' => 'text',
								),
								array(
									'key' => 'field_ndhahyawefe',
									'label' => 'Menu Item Description',
									'name' => 'menu-item-description',
									'type' => 'textarea',
								),
								array(
									'key' => 'field_eihfiwehap',
									'label' => 'Menu Item Price',
									'name' => 'menu-item-price',
									'type' => 'text',
									'instructions' => '<br/><strong>Examples:</strong><br/><br/>$24.99<br/>€30/hr<br/>$10-20 Sliding Scale',
								),
							),
							'conditional_logic' => array(
								array(
									array(
										// 'field' => 'field_nnnffff',
										'field' => 'field_9sinfalka09ng',
										'operator' => '==',
										'value' => 'masonry',
									),
								),
							),
						),
						// list style
						array(
							'key' => 'field_nfhpzkdfa',
							'label' => 'Menu Category Items',
							'type' => 'repeater',
							'name' => 'menu-category-list-repeater',
							'button_label' => 'Add New List Menu Item',
							'sub_fields' => array(
								array(
									'key' => 'field_npahaweef',
									'label' => 'Menu Item Name',
									'type' => 'text',
									'name' => 'menu-list-item-name',
								),
								array(
									'key' => 'field_npahawaeef',
									'label' => 'Menu Item Description',
									'type' => 'text',
									'name' => 'menu-list-item-description',
								),
								array(
									'key' => 'field_npaahaweef',
									'label' => 'Menu Item Price',
									'type' => 'text',
									'name' => 'menu-list-item-price',
								),
							),
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_9sinfalka09ng',
										'operator' => '==',
										'value' => 'list',
									),
								),
							),
						),
						// pdf style
						array(
							'key' => 'field_oiggnilss3fs',
							'label' => 'Menu PDF file',
							'name' => 'pdfmenu',
							'type' => 'file',
							'return_format' => 'url',
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_9sinfalka09ng',
										'operator' => '==',
										'value' => 'pdf',
									),
								),
							),
						),
						array(
							'key' => 'field_n22oiinsksoakif',
							'label' => 'Gallery Style',
							'type' => 'gallery',
							'name' => 'menu-gallery',
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_9sinfalka09ng',
										'operator' => '==',
										'value' => 'gallery',
									),
								),
							),
						)
					),
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'menu-settings',
					),
				),
			),
		));
		/*
			Menu Settings Banner Fields
		 */
		acf_add_local_field_group(array(
			'key' => 'group_n09jops423io3ta',
			'title' => 'Edit Banner',
			'fields' => array(
				array(
					'key' => 'field_71b12312',
					'label' => 'Banner / Background Image',
					'name' => 'menu-bg',
					'type' => 'image',
					'return_format' => 'url',
				),
				array(
					'key' => 'field_t92173af',
					'label' => 'Slogan',
					'name' => 'menu-slogan',
					'type' => 'textarea',
					'new_lines' => 'br',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'menu-settings-banner',
					),
				),
			),
		));
	}
}

	// 
	if( !function_exists('my_acf_input_admin_footer') ){
		function my_acf_input_admin_footer() {
		?>
			<script type="text/javascript">
				
				acf.add_filter('color_picker_args', function( args, $field ){
					
					// do something to args
					args = {
						color: false,
					    mode: 'hsl',
					    controls: {
					        horiz: 's', // horizontal defaults to saturation
					        vert: 'h', // vertical defaults to lightness
					        strip: 'l' // right strip defaults to hue
					    },
					    hide: true, // hide the color picker by default
					    border: true, // draw a border around the collection of UI elements
					    target: false, // a DOM element / jQuery selector that the element will be appended within. Only used when called on an input.
					    width: 400, // the width of the collection of UI elements
					    palettes: false // show a palette of basic colors beneath the square.
					}
					// return
					return args;
				});
			</script>
		<?php
		}
	}
	// 
	if( !function_exists('acf_update_site_title') ){
		function acf_update_site_title( $value, $post_id, $field ){
			if( !empty($value) ){
				update_option( 'blogname', stripslashes($value) );
			}
			return $value;
		}
	}
	// 
	if( !function_exists('acf_update_tagline') ){
		function acf_update_tagline( $value, $post_id, $field ){
			if( !empty($value) ){
				update_option( 'blogdescription', stripslashes($value) );
			}
			return $value;
		}
	}
	// 
	if( !function_exists('acf_validate_phone_numbers') ){
		function acf_validate_phone_numbers( $valid, $value, $field, $input ){
			$fields = array(
				'field_8378888',
				'field_8378ddf888',
				'field_26',
				'field_25',
				'field_27',
				'field_928137z',
			);
			if( in_array($field['key'], $fields) ){
				// bail early if value is already invalid
				if( !$valid ) return $valid;
				// is formatted phone number or empty?
				preg_match("/^[(]\d{3}[)][\ ]\d{3}[-]\d{4}$/", $value, $matches, PREG_OFFSET_CAPTURE, 0);
				// allow the return of an empty field for conditionals on the view
				if( !empty($matches) || empty($value) ){
					return $valid;
				}
				else{
					return $valid = 'Phone number must be formated to (555) 555-5555';
				}
			}
			return $valid;
		}
	}
	// 
	if( !function_exists('acf_update_popup_emails') ){
		function acf_update_popup_emails( $value, $post_id, $field ){
			$fields = array(
				'field_212o8afdh', // contact us form : id = 1
				'field_89zv213gd', // topbar popup : id = 2
				'field_89zv09876gd', // timed popup : id = 3
				'field_2hdaf89ads', // estimate popup : id = 4
			);

			if( in_array($field['key'], $fields) && !empty($value) ){
				global $wpdb;
				// get form id
				$id = array_search($field['key'], $fields) + 1;
				// get row data
				$row = $wpdb->get_results('SELECT notifications FROM wp_rg_form_meta WHERE form_id = ' . $id . ';');
				// json decode row data
				$json = json_decode($row[0]->notifications, JSON_OBJECT_AS_ARRAY);
				// saves at 'to' key in last array in $json
				$json[array_keys($json)[count($json)-1]]['to'] = $value;
				// set updated json
				$wpdb->query('UPDATE wp_rg_form_meta SET notifications = \'' . json_encode($json) . '\' WHERE form_id = ' . $id . ';');
			}

			return $value;
		}
	}
	// 
	if( !function_exists('acf_disable_terms_page') ){
		function acf_disable_terms_page( $value, $post_id, $field ){
			$page = get_page_by_path( 'terms' );
			if( $value == true ){
				wp_update_post( array(
					'ID' => $page->ID,
					'post_status' => 'private',
				) );
			}
			else{
				wp_update_post( array(
					'ID' => $page->ID,
					'post_status' => 'publish',
				) );	
			}
			return $value;
		}
	}



// Hooks
	add_action('acf/init', 'add_acf_fields', 1);
	add_action('acf/input/admin_footer', 'my_acf_input_admin_footer');
	add_action('acf/update_value/key=field_npy320af', 'acf_update_site_title', 10, 3);
	add_action('acf/update_value/key=field_npy320zdfa1212af', 'acf_update_tagline', 10, 3);
	add_action( 'acf/validate_value', 'acf_validate_phone_numbers', 10, 4 );
	add_action( 'acf/update_value', 'acf_update_popup_emails', 10, 3 );
	add_action( 'acf/update_value/key=field_ocozvzcvh213', 'acf_disable_terms_page', 10, 3 );

?>