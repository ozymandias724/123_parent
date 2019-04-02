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
        add_action( "after_setup_theme", "SetupTheme::after_setup_theme");
        // 
        add_action(" init", "SetupTheme::init" );
        // 
        add_action( 'login_enqueue_scripts', 'SetupTheme::enqueue_login_scripts' );
        //
        add_action( 'admin_enqueue_scripts', 'SetupTheme::enqueue_admin_scripts' );
        // 
		add_action( 'wp_enqueue_scripts', 'SetupTheme::wp_enqueue_scripts');
        // 
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
        wp_enqueue_script( 'login', get_template_directory_uri() . '/__build/_js/_conditional/login.js' );
        wp_enqueue_style('login', get_template_directory_uri() . '/__build/_css/_conditional/login.css' ); 
	}
	/**
	 * Enqueue Admin Scripts (on admin_enqueue_scripts)
	 */
	public static function enqueue_admin_scripts(){
		wp_enqueue_script( 'admin', get_template_directory_uri() . '/__build/_js/_conditional/admin.js' );
		wp_enqueue_style( 'admin', get_template_directory_uri() . '/__build/_css/_conditional/admin.css' );
	}

	// Enqueue Scripts (hook)
	public static function wp_enqueue_scripts(){
	    SetupTheme::register_javascript();
	    SetupTheme::enqueue_javascript();
	    SetupTheme::localize_javascript();
	    SetupTheme::register_styles();
	    SetupTheme::enqueue_styles();
	}

    /**
     * register javascript
     *
     * @return void
     */
	public static function register_javascript(){

        wp_deregister_script('jquery');
        
	    wp_register_script( 'main'
	    	, get_template_directory_uri() . '/__build/_js/main.js'
	    	, false
            , filemtime(get_template_directory() . '/__build/_js/main.js')
            , true
    	);
    }

	public static function register_styles(){
	    wp_register_style( 'main'
	    	, get_template_directory_uri() . '/__build/_css/main.css'
            , false
	    	, filemtime(get_template_directory() . '/__build/_css/main.css')
        );   
    }
    
	// 
	public static function enqueue_javascript(){
	    wp_enqueue_script( 'main' );
	}
	public static function enqueue_styles(){
        wp_enqueue_style( 'main' );
	}

	// remove junk from the header
	public static function clean_head(){
        add_filter( 'show_admin_bar', '__return_false' );
	    add_filter( 'emoji_svg_url', '__return_false' );
	    remove_action( 'wp_head', 'rsd_link' );
	    remove_action( 'wp_head', 'wp_generator' );
	    remove_action( 'wp_head', 'feed_links', 2 );
	    remove_action( 'wp_head', 'feed_links_extra', 3 );
	    remove_action( 'wp_head', 'wlwmanifest_link' );
	    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	    remove_action( 'admin_print_styles', 'print_emoji_styles' );
	    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	    remove_action( 'wp_print_styles', 'print_emoji_styles' );
	    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	    remove_action( 'wp_head', 'wp_resource_hints', 2 );
	}

	// Localize Extra JavaScript Variables
	public static function localize_javascript(){
        
        // 
		$val = var_export(get_field('nav-fadein-toggle', 'option'), true);
        wp_localize_script( 'main', 'DisableNavTintFadein', $val);
        
		// 
		wp_localize_script( 'main', 'Home_URL', get_site_url());
        
        // 
		wp_localize_script('main', 'PopupTimes', array(
			'short' => !empty( get_field('popuptime-short', 'option') ) ? get_field('popuptime-short', 'option') : 30,
			'long' => !empty( get_field('popuptime-long', 'option') ) ? get_field('popuptime-long', 'option') : 3600,
        ));

        // 
		wp_localize_script( 'main', 'DisableTimedPopup', json_encode(get_field('ad-disable', 'option')) );

		//Pass acf fields from Hero section to main.js
		wp_localize_script('main', 'hero_fields', array(
            //'title' => get_field('hero_title', 'options')
			'speed' => 5000,
			'fade' => true,
			'random' => true,
			'autoplay' => false 
		)); 
		// end localize scripts
	}
}
SetupTheme::_init();
 ?>