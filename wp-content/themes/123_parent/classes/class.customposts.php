<?php 
/**
* 
*/
class CustomPosts
{
    
    function __construct(){
        $this->_init();
    }

    function _init(){

        $this->_register_post_types();
        
    }

    function _register_post_types(){


        $labels = array(
            'name'               => _x( 'Testimonials', 'post type general name', '123_parent' ),
            'singular_name'      => _x( 'Testimonial', 'post type singular name', '123_parent' ),
            'menu_name'          => _x( 'Testimonials', 'admin menu', '123_parent' ),
            'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', '123_parent' ),
            'add_new'            => _x( 'Add New', 'Testimonial', '123_parent' ),
            'add_new_item'       => __( 'Add New Testimonial', '123_parent' ),
            'new_item'           => __( 'New Testimonial', '123_parent' ),
            'edit_item'          => __( 'Edit Testimonial', '123_parent' ),
            'view_item'          => __( 'View Testimonial', '123_parent' ),
            'all_items'          => __( 'All Testimonials', '123_parent' ),
            'search_items'       => __( 'Search Testimonials', '123_parent' ),
            'parent_item_colon'  => __( 'Parent Testimonials:', '123_parent' ),
            'not_found'          => __( 'No Testimonials found.', '123_parent' ),
            'not_found_in_trash' => __( 'No Testimonials found in Trash.', '123_parent' )
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', '123_parent' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type('testimonials', $args);

        
        
        $labels = array(
            'name'               => _x( 'Food Menus', 'post type general name', '123_parent' ),
            'singular_name'      => _x( 'Food Menu', 'post type singular name', '123_parent' ),
            'menu_name'          => _x( 'Food Menus', 'admin menu', '123_parent' ),
            'name_admin_bar'     => _x( 'Food Menu', 'add new on admin bar', '123_parent' ),
            'add_new'            => _x( 'Add New', 'Food Menu', '123_parent' ),
            'add_new_item'       => __( 'Add New Food Menu', '123_parent' ),
            'new_item'           => __( 'New Food Menu', '123_parent' ),
            'edit_item'          => __( 'Edit Food Menu', '123_parent' ),
            'view_item'          => __( 'View Food Menu', '123_parent' ),
            'all_items'          => __( 'All Food Menus', '123_parent' ),
            'search_items'       => __( 'Search Food Menus', '123_parent' ),
            'parent_item_colon'  => __( 'Parent Food Menus:', '123_parent' ),
            'not_found'          => __( 'No Food Menus found.', '123_parent' ),
            'not_found_in_trash' => __( 'No Food Menus found in Trash.', '123_parent' )
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', '123_parent' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type('food_menus', $args);
        
        
        

        $labels = array(
            'name'               => _x( 'Areas Served', 'post type general name', '123_parent' ),
            'singular_name'      => _x( 'Area Served', 'post type singular name', '123_parent' ),
            'menu_name'          => _x( 'Areas Served', 'admin menu', '123_parent' ),
            'name_admin_bar'     => _x( 'Area Served', 'add new on admin bar', '123_parent' ),
            'add_new'            => _x( 'Add New', 'Area Served', '123_parent' ),
            'add_new_item'       => __( 'Add New Area Served', '123_parent' ),
            'new_item'           => __( 'New Area Served', '123_parent' ),
            'edit_item'          => __( 'Edit Area Served', '123_parent' ),
            'view_item'          => __( 'View Area Served', '123_parent' ),
            'all_items'          => __( 'All Areas Served', '123_parent' ),
            'search_items'       => __( 'Search Areas Served', '123_parent' ),
            'parent_item_colon'  => __( 'Parent Areas Served:', '123_parent' ),
            'not_found'          => __( 'No Areas Served found.', '123_parent' ),
            'not_found_in_trash' => __( 'No Areas Served found in Trash.', '123_parent' )
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', '123_parent' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type('areas-served', $args);
        
        
        
        $labels = array(
            'name'               => _x( 'Services', 'post type general name', '123_parent' ),
            'singular_name'      => _x( 'Service', 'post type singular name', '123_parent' ),
            'menu_name'          => _x( 'Services', 'admin menu', '123_parent' ),
            'name_admin_bar'     => _x( 'Service', 'add new on admin bar', '123_parent' ),
            'add_new'            => _x( 'Add New', 'Service', '123_parent' ),
            'add_new_item'       => __( 'Add New Service', '123_parent' ),
            'new_item'           => __( 'New Service', '123_parent' ),
            'edit_item'          => __( 'Edit Service', '123_parent' ),
            'view_item'          => __( 'View Service', '123_parent' ),
            'all_items'          => __( 'All Services', '123_parent' ),
            'search_items'       => __( 'Search Services', '123_parent' ),
            'parent_item_colon'  => __( 'Parent Services:', '123_parent' ),
            'not_found'          => __( 'No Services found.', '123_parent' ),
            'not_found_in_trash' => __( 'No Services found in Trash.', '123_parent' )
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', '123_parent' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type('services', $args);
        
        

        $labels = array(
            'name'               => _x( 'Staff Members', 'post type general name', '123_parent' ),
            'singular_name'      => _x( 'Staff Member', 'post type singular name', '123_parent' ),
            'menu_name'          => _x( 'Staff Members', 'admin menu', '123_parent' ),
            'name_admin_bar'     => _x( 'Staff Member', 'add new on admin bar', '123_parent' ),
            'add_new'            => _x( 'Add New', 'Staff Member', '123_parent' ),
            'add_new_item'       => __( 'Add New Staff Member', '123_parent' ),
            'new_item'           => __( 'New Staff Member', '123_parent' ),
            'edit_item'          => __( 'Edit Staff Member', '123_parent' ),
            'view_item'          => __( 'View Staff Member', '123_parent' ),
            'all_items'          => __( 'All Staff Members', '123_parent' ),
            'search_items'       => __( 'Search Staff Members', '123_parent' ),
            'parent_item_colon'  => __( 'Parent Staff Members:', '123_parent' ),
            'not_found'          => __( 'No Staff Members found.', '123_parent' ),
            'not_found_in_trash' => __( 'No Staff Members found in Trash.', '123_parent' )
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', '123_parent' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type('staff', $args);


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
				'labels'              => $labels,
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
				'has_archive'         => false,
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

new CustomPosts();    
?>