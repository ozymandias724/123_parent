<?php 
	/**
	* Registers a new post type
	* @uses $wp_post_types Inserts new post type object into the list
	*
	* @param string  Post type key, must not exceed 20 characters
	* @param array|string  See optional args description above.
	* @return object|WP_Error the registered post type object, or an error object
	*/
	if( !function_exists('register_coupon_cpt') ){
		function register_coupon_cpt() {
			$labels = array(
				'name'                => 'Coupon',
				'singular_name'       => 'Coupon',
				'add_new'             => 'Add Coupon',
				'add_new_item'        => 'Add New Coupon',
				'edit_item'           => 'Edit Coupon',
				'new_item'            => 'New Coupon',
				'view_item'           => 'View Coupon',
				'search_items'        => 'Search Coupons',
				'not_found'           => 'No Coupons Found',
				'not_found_in_trash'  => 'No Coupons Found in Trash',
				'parent_item_colon'   => 'Parent Coupon',
				'menu_name'           => 'Coupons',
				'all_items'           => 'All Coupons',
			);

			$args = array(
				'labels'                   => $labels,
				'hierarchical'        => false,
				'description'         => 'description',
				'taxonomies'          => array(),
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 84,
				'menu_icon'           => 'dashicons-tickets',
				'show_in_nav_menus'   => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'has_archive'         => true,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite'             => array(
					'slug' => 'coupons',
				),
				'capability_type'     => 'post',
				'supports'            => array(
					'title', 'revisions', 'page-attributes', 'post-formats'
					)
			);

			register_post_type( 'coupon', $args );
		}
	}
	add_action( 'init', 'register_coupon_cpt' );
 ?>