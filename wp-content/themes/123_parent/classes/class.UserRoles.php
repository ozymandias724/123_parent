<?php 
/**
 * 
 */
class UserRoles
{
	function __construct()
	{
		$this->_init();
	}
	function _init(){
		add_action('after_switch_theme', array($this, 'manage_roles'));
		
		add_action('after_switch_theme', array($this, 'manage_users'));
		
		$this->manage_admin_menu();

		add_filter( 'login_redirect', array($this, 'redirect_sales_login'), 10, 3 );
	}
	/**
	 * redirect sales user to the setup page
	 * @param  [type] $redirect_to 
	 * @param  [type] $request     
	 * @param  [type] $user        
	 * @return [type]              
	 */		
	function redirect_sales_login($redirect_to, $request, $user){
		if( isset($user->roles) && is_array($user->roles) ){
			if( 'sales' == $user->data->user_nicename ){
				$redirect_to =  admin_url('admin.php?page=site-setup');
			}
		}
		return $redirect_to;
	}
	/**
	 * calls functions that update specific roles
	 * @return none
	 */
	function manage_roles(){
		$this->update_editor_role();
		$this->update_author_role();
	}
	/**
	 * update the editor role
	 * @return none
	 */
	function update_editor_role(){
		$role = get_role( 'editor' );
		$caps_to_add = array(
			'ga_activate'
			,'manage_options'
			,'ga_reset'
			,'activate_plugins'
			,'edit_theme_options'
			,'edit_themes'
			,'install_themes'
			,'switch_themes'
			,'update_themes'
			,'manage_options'
			,'customize'
		);
		$caps_to_remove = array();
		foreach( $caps_to_add as $cap ){
			$role->add_cap($cap);
		}
		foreach( $caps_to_remove as $cap_to_remove ){
			$role->remove_cap($cap);
		}
	}
	/**
	 * update the author role
	 * @return none
	 */
	function update_author_role(){
		$role = get_role( 'author' );

		$caps_to_add = array(
			'delete_published_coupon' 
			,'delete_others_coupon' 
			,'delete_coupon' 
			,'edit_others_coupon' 
			,'edit_published_coupon' 
			,'edit_coupon' 
			,'publish_coupon' 
			,'delete_published_coupons' 
			,'delete_others_coupons' 
			,'delete_coupons' 
			,'edit_others_coupons' 
			,'edit_published_coupons' 
			,'edit_coupons' 
			,'publish_coupons' 
			,'delete_published_post' 
			,'delete_others_post' 
			,'delete_post' 
			,'edit_others_post' 
			,'edit_published_post' 
			,'edit_post' 
			,'publish_post' 
			,'delete_published_posts' 
			,'delete_others_posts' 
			,'delete_posts' 
			,'edit_others_posts' 
			,'edit_published_posts' 
			,'edit_posts' 
			,'publish_post' 
			,'upload_files' 
			,'upload_files' 
		);
		$caps_to_remove = array(
			'gform_full_access'
			,'ga_activate'
			,'manage_options'
			,'ga_reset'
			,'activate_plugins'
		);

		foreach( $caps_to_add as $cap ){
			$role->add_cap($cap);
		}
		foreach( $$caps_to_remove as $cap_to_remove ){
			$role->remove_cap($cap);
		}
	}
	/**
	 * pre-configures required users
	 * @return none
	 */
	function manage_users(){
		if( !username_exists( 'sales' ) ){
			$userdata = array(
				'user_login' => 'Sales',
				'user_url' => '123websites.com',
				'user_pass' => '123sales',
				'role' => 'editor',
				'display_name' => 'Sales Person'
			);
			wp_insert_user( $userdata );
		}
	}
	/**
	 * calls functions that update users admin sidebar
	 * @return none
	 */
	function manage_admin_menu(){
		$user = wp_get_current_user();
		if( array_intersect(array('administrator'), $user->roles ) ){
			add_action('admin_menu', array($this, 'do_adjust_admin_menu'));
		}
		else if( array_intersect(array('editor'), $user->roles ) ){
			add_action('admin_menu', array($this, 'do_adjust_editor_menu'));
			if( 'sales' == $user->data->user_nicename ){
				add_action( 'admin_init', array($this, 'do_adjust_sales_menu') );
			}
		}
		else if( array_intersect(array('author'), $user->roles ) ){
			add_action('admin_menu', array($this, 'do_adjust_author_menu'));
		}
	}
	function do_adjust_admin_menu(){
		global $menu;
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
	function do_adjust_author_menu(){
		global $menu;
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
	function do_adjust_editor_menu(){
		global $menu;

		remove_menu_page( 'edit.php?post_type=page' );
		remove_menu_page( 'edit.php?post_type=acf-field-group' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'profile.php' );
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'options-general.php' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'upload.php' );
		remove_menu_page( 'wppusher' );

		if( !is_null($menu) ){
			$menu = array_filter($menu, function($value, $key){
				if( strpos(implode(' ', $value), 'wordfence') === false ){
					return $value;
				}
			}, ARRAY_FILTER_USE_BOTH);
		}
		add_menu_page( 'Themes', 'Themes', 'edit_posts', 'themes.php?noconflict=yeah', '', 'dashicons-star-filled', 8 );
	}
	function do_adjust_sales_menu(){
		global $menu;
		if( !empty($menu)){
			foreach($menu as $i => $val){
				$shown = array(
					'site-setup',
				);
				// remove every page except setup site
				if( !in_array($val[2],$shown) && !empty($val[2]) ){
					remove_menu_page($val[2]);
				}
			}
		}
	}
}
	new UserRoles();
 ?>