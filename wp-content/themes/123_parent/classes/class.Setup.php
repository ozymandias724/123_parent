<?php 
/**
 * 	Setup The Theme
 */
class SetupTheme
{
	public static function _init(){
		// 
		SetupTheme::clean_head();
		// 
		add_action( "setup_theme", "SetupTheme::before_setup_theme");
		// 
		add_action( "after_setup_theme", "SetupTheme::after_setup_theme");
		// 
		add_action(" init", "SetupTheme::init" );
		// 
		add_action( 'login_enqueue_scripts', 'SetupTheme::enqueue_login_scripts' );
		// 
		add_action( 'admin_enqueue_scripts', 'SetupTheme::enqueue_admin_scripts' );
		// 
		add_action( 'wp_enqueue_scripts', 'SetupTheme::wp_enqueue_scripts', 10 );
		add_action( 'wp_enqueue_scripts', 'SetupTheme::wp_enqueue_remote_css', 101);
		// 
		add_filter( 'show_admin_bar', '__return_false' );
	}
	// 
	public static function after_setup_theme(){
		add_theme_support( 'html5' );
		add_theme_support( 'post-thumbnails' );
	}
	// 
	public static function init(){
		add_post_type_support( 'page', 'excerpt' );
		register_nav_menu( 'main-nav', 'Main Navigation' );
	}

	/**
	 * Enqueue Login Scripts on login_enqueue_scripts
	 */
	public static function enqueue_login_scripts(){
		update_login_styles();
		wp_enqueue_style('parent-login', get_template_directory_uri() . '/build/css/login.css' ); 
	}
	/**
	 * Enqueue Admin Scripts (on admin_enqueue_scripts)
	 */
	public static function enqueue_admin_scripts(){
		wp_enqueue_script( 'parent-login', get_template_directory_uri() . '/build/js/admin.js' );
		wp_enqueue_style( 'parent-admin', get_template_directory_uri() . '/build/css/admin.css' );
	}

	// Enqueue Scripts (hook)
	public static function wp_enqueue_scripts(){
	    SetupTheme::register_styles();
	    SetupTheme::enqueue_styles();
	    SetupTheme::register_javascript();
	    SetupTheme::enqueue_javascript();
	    SetupTheme::localize_javascript();
	}


	public static function wp_enqueue_remote_css(){
		wp_enqueue_style( 'remote-override-parent' );
		wp_enqueue_style( 'remote-override-child' );
	}


	public static function register_javascript(){
	    wp_register_script( 'parent-main'
	    	, get_template_directory_uri() . '/build/js/build.js'
	    	, false
	    	, filemtime(get_template_directory() . '/build/js/build.js')
    	);
	    wp_register_script( 'parent-exec'
	    	, get_template_directory_uri() . '/build/js/exec.js'
	    	, false
	    	, filemtime(get_template_directory() . '/build/js/exec.js')
	    );
	}
	public static function register_styles(){
	    wp_register_style( 'parent'
	    	, get_template_directory_uri() . '/build/css/build.css'
	    	, false
	    	, filemtime(get_template_directory() . '/build/css/build.css')
    	);

	    // remote css files
		wp_register_style( 'remote-override-parent'
			, "https://123websites.com/css-themes/123_parent.css"
			, array('parent')
		);
        $theme_name = wp_get_theme()->get_stylesheet();
    	wp_register_style( 'remote-override-child'
    		, "https://123websites.com/css-themes/${theme_name}.css"
    		, array('parent')
    	);
	}
	// 
	public static function enqueue_javascript(){
	    // reqs
	    wp_enqueue_script('gmaps','https://maps.googleapis.com/maps/api/js?key=' . get_gmap_api_key(), array(), null, false);
		wp_enqueue_script('gstatic', 'https://www.gstatic.com/charts/loader.js');
		// theme
	    wp_enqueue_script( 'parent-main' );
	    wp_enqueue_script( 'parent-exec' );
	}
	public static function enqueue_styles(){
		wp_enqueue_style( 'parent' );
	}

	// remove junk from the header
	public static function clean_head(){

	    // https://scotch.io/tutorials/removing-wordpress-header-junk
	    remove_action( 'wp_head', 'rsd_link' );
	    remove_action( 'wp_head', 'wp_generator' );
	    remove_action( 'wp_head', 'feed_links', 2 );
	    remove_action( 'wp_head', 'feed_links_extra', 3 );
	    remove_action( 'wp_head', 'wlwmanifest_link' );
	    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	    
	    // http://wordpress.stackexchange.com/a/185578/26817
	    remove_action( 'admin_print_styles', 'print_emoji_styles' );
	    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	    remove_action( 'wp_print_styles', 'print_emoji_styles' );
	    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	    add_filter( 'emoji_svg_url', '__return_false' );
	    // add_filter( 'tiny_mce_plugins', 'rational_tiny_mce_plugins_clean' );
	    
	    // http://wordpress.stackexchange.com/a/211469/26817
	    // remove_action( 'wp_head', 'rest_output_link_wp_head' );
	    // remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

	    // removes dns pre-fetch
	    remove_action( 'wp_head', 'wp_resource_hints', 2 );
	}

	// Localize Extra JavaScript Variables
	public static function localize_javascript(){
		$val = var_export(get_field('nav-fadein-toggle', 'option'), true);
		wp_localize_script( 'parent-main', 'DisableNavTintFadein', $val);
		// 
		$fields = [];
		$rows = get_field('addresses-repeater', 'option');
		foreach($rows as $row){
			array_push($fields, $row['addresses-gmap']);
		}
		wp_localize_script( 'parent-main', 'ContactAddresses', $fields );
		// 
		wp_localize_script( 'parent-main', 'Home_URL', get_site_url());
		
		if( get_field('areas_served_select', 'option') == 'zips' ){
			$fields = get_field('locations', 'option');
			$fields_array = [];
			if( !empty($fields) ){
				foreach( $fields as $field ){
					$fields_array[] = array('lat' => (float) $field['zip']['lat'], 'lng' => (float) $field['zip']['lng']);
				}
			}
			wp_localize_script( 'parent-main', 'AreasServed', $fields_array );
		}
		elseif( get_field('areas_served_select', 'option') == 'states' ){
			$fields = get_field('states', 'option');
			$fields_array = [];
			if( !empty($fields) ){
				foreach($fields as $field){
					array_push($fields_array, $field['state']['value']);
				}
				$fth = new FusionTableHandler();
				wp_localize_script( 'parent-main', 'StatesServed', $fth->get_states_geometry($fields_array) );
			}
		}
		elseif( get_field('areas_served_select', 'option') == 'counties' ){
			$fields = get_field('counties', 'option');
			$fields_array = [];
			if( !empty($fields) ){
				foreach($fields as $field){
					$explosion = explode(', ', $field['county']['address']);
					array_push($fields_array, $explosion[1] . '-' . str_replace(' County', '', $explosion[0]));
				}
			}
			$fth = new FusionTableHandler();
			wp_localize_script( 'parent-main', 'CountiesServed', $fth->get_counties_geometry($fields_array) );
		}
		elseif(get_field('areas_served_select', 'option') == 'countries' ){
			$fields = get_field('countries', 'option');
			$fields_array = [];
			if( !empty($fields) ){
				foreach($fields as $field){
					array_push($fields_array, $field['country']['value']);
				}
			}
			$fth = new FusionTableHandler();
			wp_localize_script( 'parent-main', 'CountriesServed', $fth->get_countries_geometry($fields_array) );
		}

		wp_localize_script('parent-main', 'PopupTimes', array(
			'short' => !empty( get_field('popuptime-short', 'option') ) ? get_field('popuptime-short', 'option') : 30,
			'long' => !empty( get_field('popuptime-long', 'option') ) ? get_field('popuptime-long', 'option') : 3600,
		));
		wp_localize_script( 'parent-main', 'DisableTimedPopup', json_encode(get_field('ad-disable', 'option')) );

		$wphelpers = array(
			//
			'ishome' => (is_home()) ? 'true' : 'false',
		);
		wp_localize_script('parent-main', 'wphelpers', $wphelpers);
		// end localize scripts
	}


}

SetupTheme::_init();

 ?>