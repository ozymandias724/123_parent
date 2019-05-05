<?php 
/*
	Add Options Pages and Subpages
*/
if( function_exists('acf_add_options_page') ) {

	// Main Theme Settings
	acf_add_options_page(array(
		'page_title' 	=> 'Sitewide Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'read_private_posts',
		'icon_url'      => 'dashicons-admin-settings',
		'redirect'		=> false,
        'position' 		=> 3,
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
	}
}




// Hooks
	add_action('acf/init', 'add_acf_fields');
?>