<?php 


	
	// Add a custom user role
	remove_role( 'sales' );
	$result = add_role( 'sales', __('Sales' ), array(
		'read' => true,
		'install_themes' => true,
		'switch_themes' => true,
		'manage_options' => true,
	));
	error_log(print_r($result, true));

	$userdata = array(
		'user_login' => 'Sales',
		'user_url' => '123websites.com',
		'user_pass' => '123sales',
		'role' => 'sales',
		'display_name' => 'Sales Person'
	);

	$user_id = wp_insert_user( $userdata );

	if( !is_wp_error( $user_id ) ){
		error_log(print_r('Sales User Exists', true));

	}



	// changes author names
	if( !function_exists('action_change_role_names') ){
		function action_change_role_names(){
			global $wp_roles;
			if( !isset($wp_roles) ){
				$wp_roles = new WP_Roles();
			}
			$wp_roles->roles['editor']['name'] = 'Agent';
		    $wp_roles->role_names['editor'] = 'Agent';
		    $wp_roles->roles['author']['name'] = 'Client';
		    $wp_roles->role_names['author'] = 'Client';
		}
	}
	add_action('init', 'action_change_role_names');

	
	// setup editor and author admin backend
	add_action('admin_menu','setup_admin_menus_all_roles', 99);

	if( !function_exists('setup_admin_menus_all_roles') ){
		function setup_admin_menus_all_roles(){
		    global $menu;
		    $user = wp_get_current_user();

		    if( array_intersect(array('sales'), $user->roles) ){
		    	// add_menu_page( 'Setup Site', 'Setup Site', 'switch_themes', 'admin.php?page=site-setup' );	
		    }





		    $allowed_roles = array('editor', 'author');
		    // agent
		    if ( array_intersect( array('editor'), $user->roles ) ) {
				$user->add_cap('gform_full_access');
				remove_menu_page( 'edit.php?post_type=page' );
				remove_menu_page( 'edit.php?post_type=acf-field-group' );
				remove_menu_page( 'tools.php' );
				remove_menu_page( 'profile.php' );
				remove_menu_page( 'edit-comments.php' );
				$user->add_cap('ga_activate');
				$user->add_cap('manage_options');
				$user->add_cap('ga_reset');
				$user->add_cap('activate_plugins');
				remove_menu_page( 'options-general.php' );
				remove_menu_page( 'plugins.php' );
				remove_menu_page( 'upload.php' );
				remove_menu_page( 'wppusher' );
				// remove wordfence from menu
				if( !is_null($menu) ){
					$menu = array_filter($menu, function($value, $key){
						if( strpos(implode(' ', $value), 'wordfence') === false ){
							return $value;
						}
					}, ARRAY_FILTER_USE_BOTH);
				}
				// Add Theme Menu Item & Functionality for Agents
				$user->add_cap('edit_theme_options');
				$user->add_cap('edit_themes');
				$user->add_cap('install_themes');
				$user->add_cap('switch_themes');
				$user->add_cap('update_themes');
				$user->add_cap('manage_options');
				$user->add_cap('customize');
				add_menu_page( 'Themes', 'Themes', 'edit_posts', 'themes.php?noconflict=yeah', '', 'dashicons-star-filled', 8 );
		    }
		    // client
		    elseif ( array_intersect( array('author'), $user->roles ) ) {
		    	$user->remove_cap('gform_full_access');
		    	$user->remove_cap('ga_activate');
				$user->remove_cap('manage_options');
				$user->remove_cap('ga_reset');
				$user->remove_cap('activate_plugins');
				$user->add_cap( 'delete_published_coupon' );
				$user->add_cap( 'delete_others_coupon' );
				$user->add_cap( 'delete_coupon' );
				$user->add_cap( 'edit_others_coupon' );
				$user->add_cap( 'edit_published_coupon' );
				$user->add_cap( 'edit_coupon' );
				$user->add_cap( 'publish_coupon' );
				$user->add_cap( 'delete_published_coupons' );
				$user->add_cap( 'delete_others_coupons' );
				$user->add_cap( 'delete_coupons' );
				$user->add_cap( 'edit_others_coupons' );
				$user->add_cap( 'edit_published_coupons' );
				$user->add_cap( 'edit_coupons' );
				$user->add_cap( 'publish_coupons' );
				$user->add_cap( 'delete_published_post' );
				$user->add_cap( 'delete_others_post' );
				$user->add_cap( 'delete_post' );
				$user->add_cap( 'edit_others_post' );
				$user->add_cap( 'edit_published_post' );
				$user->add_cap( 'edit_post' );
				$user->add_cap( 'publish_post' );
				$user->add_cap( 'delete_published_posts' );
				$user->add_cap( 'delete_others_posts' );
				$user->add_cap( 'delete_posts' );
				$user->add_cap( 'edit_others_posts' );
				$user->add_cap( 'edit_published_posts' );
				$user->add_cap( 'edit_posts' );
				$user->add_cap( 'publish_post' );
				$user->add_cap( 'upload_files' );
				$user->add_cap( 'upload_files' );

				// Testimonials Page

		    	remove_menu_page( 'edit.php?post_type=page' );
		    	remove_menu_page( 'edit.php?post_type=acf-field-group' );
		    	remove_menu_page( 'tools.php' );
		    	remove_menu_page( 'profile.php' );
		    	remove_menu_page( 'edit-comments.php' );
		    	// remove_menu_page( 'options-general.php' );
		    	remove_menu_page( 'plugins.php' );
		    	remove_menu_page( 'upload.php' );
		    	remove_menu_page( 'wppusher' );
		    }
		    // admin
		    elseif( array_intersect( array('administrator'), $user->roles ) ){
		    	add_menu_page( 'Themes', 'Themes', 'activate_plugins', 'themes.php?noconflict=yeah', '', 'dashicons-star-filled', 8 );

		    	$separator = array('', 'read', 'separator', '', 'wp-menu-separator');

		    	$new_menu_order = array(
		    		'9' => 'about',
		    		'9.1' => 'areas served',
		    		'9.2' => 'blog posts',
		    		'9.3' => 'coupons',
		    		'9.4' => 'gallery',
		    		'9.5' => 'locations',
		    		'9.6' => 'menu',
		    		'9.7' => 'services',
		    		'9.8' => 'testimonials',
		    		'9.9' => 'separator',
		    		'60.05' => 'appearance', // appearance
		    		'60.1' => 'upload.php', // media
		    		'60.2' => 'edit.php?post_type=page', // pages
		    		'60.3' => 'plugins.php', // plugins
		    		'60.4' => 'settings', // settings
		    		'60.5' => 'tools.php', // tools
		    		'60.6' => 'users.php', // users
		    		'99.5' => 'edit-comments.php', // comments
	    		);
	    		foreach($menu as $menu_index => $menu_item) {
					foreach( $new_menu_order as $new_menu_order_index => $new_menu_order_item ){
						if( $new_menu_order_item !== 'separator' && in_array($new_menu_order_item, array_map(function($val){ return strtolower($val); }, array_values($menu_item))) ){
							$menu[$new_menu_order_index] = $menu[$menu_index];
							unset($new_menu_order[$new_menu_order_index]);
							unset($menu[$menu_index]);
							break;
						}
						elseif( $new_menu_order_item == 'separator' ){
							$menu[$new_menu_order_index] = $separator;
						}
					}
	    		}
		    }
		}
	}
 ?>