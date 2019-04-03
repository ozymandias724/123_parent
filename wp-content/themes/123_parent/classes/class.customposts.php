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
            // 'rewrite'            => array( 'slug' => 'staff-member' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
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

new CustomPosts();    
?>