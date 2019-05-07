<?php 

// built-in acf
include_once('reqs/localize-acf.php');
include_once('reqs/ext/acfext.address.php');

// acf handler for page publish/private status
include_once('classes/Pagedata.php');

// general theme setup
include_once('classes/class.Setup.php');

// custom users
include_once('classes/class.UserRoles.php');

// custom post types
include_once( 'classes/class.customposts.php' );

// footer stuff
include_once('components/reqs/footer-helpers.php');

include_once('classes/class.Customizer.php');

include_once('classes/class.NavHandler.php');


function _get_full_address_br(){
	$company_info = get_field('company_info','options');
        
	$location = ($company_info['location'] ? $company_info['location'] : '');

	$street_1 = $location['address_street'];
	$street_2 = $location['address_street_2'];
	$city = $location['address_city'];
	$state = $location['address_state'];
	$postcode = $location['address_postcode'];
	$country = $location['address_country'];

	$format_full_address_br = '%s %s <br/>%s, %s, %s'; 

	$full_address_br = sprintf(
		$format_full_address_br
		,$street_1
		,$street_2
		,$city
		,$state
		,$postcode
		// ,$country
	);
	return $full_address_br; 
}



function _get_site_logo(){
    // look for a 'custom logo'
    $content_logo = '';
    // if we have a custom logo
    // if( !empty($header['logo']) ){
    if( !empty( get_theme_mod( 'custom_logo' ) ) ){
        // $logo_src = wp_get_attachment_image_src($header['logo']['id'])[0];
        // $logo_src = wp_get_attachment_image_src($header['logo']['id'])[0];
        $logo_srcset = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ));
        $logo_srcset = wp_get_attachment_image_srcset(get_theme_mod( 'custom_logo' ));
        $format_logo = '
            <a class="header-logo" href="%s" title="Logo button">
                <img src="%s" srcset="%s" alt="%s">
            </a>
        ';
        $content_logo .= sprintf(
            $format_logo
            ,site_url()
            ,$logo_src
            ,$logo_srcset
            ,get_bloginfo('sitename')
        );
    }
    return $content_logo;
}

function _get_site_nav($pre = 'navlinks'){
    $return_nav = '';
    $page = get_page_by_path('home-page', OBJECT, 'page');
    $fields = get_fields($page->ID);
    $longscroll = $fields['long_scroll'];
    $sections = $fields['sections'];
    // if long scroll is enabled
    if (!empty($longscroll) && !empty($sections) ) {
        $return_nav = '<ul class="'.$pre.'">';
        $format_nav_item = '
            <li class="'.$pre.'-item"><a class="'.$pre.'-item-link" href="%s" title="Scroll to the %s section">%s</a></li>
        ';
        // each page object reference module
        foreach($sections as $section){
            $section = $section['section'];
            // create the nav
            $href = '#mod_'.$section->post_name;
            $title = $section->post_title;
            $return_nav .= sprintf(
                $format_nav_item
                ,$href
                ,$title
                ,$title
            );
        }
        $return_nav .= '</ul>';
        return $return_nav;
    }
    // if long scroll is disabled
    else {
        $return_nav = '<ul class="'.$pre.'">';
        $format_nav_item = '
            <li class="'.$pre.'-item"><a class="'.$pre.'-item-link" href="%s" title="Scroll to the %s section">%s</a></li>
        ';
        // each page object reference module
        foreach($sections as $section){
            $section = $section['section'];
            // create the nav
			$href = 'mod_'.$section->post_name;
			$href = site_url($section->post_name);
            $title = $section->post_title;
            $return_nav .= sprintf(
                $format_nav_item
                ,$href
                ,$title
                ,$title
            );
        }
        $return_nav .= '</ul>';
        return $return_nav;
    }
}

function get_section_banner($title = null, $text = null){

    $title = ( !empty($title) ) ? $title : $post->post_title;
    $text = ( !empty($text) ) ? $text : '';
    
    $format_banner = '
        <div class="banner">
            %s
            %s
        </div>
    ';
    $return_banner .= sprintf(
        $format_banner
        ,'<h1>'.$title.'</h1>'
        ,( !empty($text) ) ? '<h3>'.$text.'</h3>' : ''
    );
    return $return_banner;
}


// adds the training ad dashboard widget
if( !function_exists('add_dashboard_widgets') ){
	function add_dashboard_widgets() {
		wp_add_dashboard_widget('dashboard_questions_comments_widget', 'Questions, Comments, Concerns ?', 'dashboard_questions_comments_widget_function');
	}
}
add_action('wp_dashboard_setup', 'add_dashboard_widgets' );

// Function that outputs the contents of the dashboard widget
if( !function_exists('dashboard_questions_comments_widget_function') ){
	function dashboard_questions_comments_widget_function( $post, $callback_args ) {
		?>
			<a target="_blank" href="http://www.123websites.com/training">
				<img style="width: 100%;" src="http://www.123websites.com/images/training-ad-dashboard.png">
			</a>
		<?php
	}
}

// are we on a login-esque page? 
if( !function_exists('is_login_page') ){
	function is_login_page() {
	    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
	}
}
// add some styles to the login page
if( !function_exists('update_login_styles') ){
	function update_login_styles(){
		if(is_login_page()){?>
			<style type="text/css">
				.login{
					background-image: url('http://123websites.com/images/theme-login-bg.jpg');
					background-size: cover;
					background-repeat: no-repeat;
				}
				#login h1 a, .login h1 a {	
		            background-image: url('<?php echo get_field('webx-logo', 'option'); ?>');
		            background-size: contain;
		            min-width: 300px;
		        }
			</style>
		<?php }
	}
}
// modify login form bottom
if( !function_exists('action_login_footer') ){
	function action_login_footer(){
		?>
			<script type="text/javascript">
				document.querySelector('#backtoblog a').innerHTML = '&larr; Back to Theme';
			</script>
		<?php
	}
}
add_action('login_footer', 'action_login_footer');
// update gravity forms menu position
if( !function_exists('update_gform_menu_position') ){
	function update_gform_menu_position( $position ) {
	    return 99;
	}
}
add_filter( 'gform_menu_position', 'update_gform_menu_position' );


// cleans out admin dashboard widgets
if( !function_exists('remove_admin_dashboard_widgets') ){
	function remove_dashboard_widgets(){
		$user = wp_get_current_user();
		// agent
		if ( array_intersect( array('editor'), $user->roles ) ) {
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
			remove_meta_box( 'wordfence_activity_report_widget', 'dashboard', 'normal' );
			remove_meta_box( 'blc_dashboard_widget', 'dashboard', 'normal' );
		}
		// client
		elseif ( array_intersect( array('author'), $user->roles ) ){
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_questions_comments_widget', 'dashboard', 'normal' );
			remove_meta_box( 'wordfence_activity_report_widget', 'dashboard', 'normal' );
			remove_meta_box( 'blc_dashboard_widget', 'dashboard', 'normal' );
		}
		// admin
		else{
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
		}
	}
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets', 20 );


// sets a notice of site being disabled
if( !function_exists('admin_notify_disabled_site') ){
	function admin_notify_disabled_site() {
		 ?>
		<div class="notice notice-error" style="background-color: #ffdadf;">
	    	<p style="text-transform: uppercase; font-size: 24px; color: red; margin-bottom: 0px;">This site has been disabled!</p>
	    	<p style="margin-top: 0px;">To enable it go to the Disable Site tab in <a href="<?php echo admin_url('?page=general-settings') ?>">Theme Settings</a></p>
	    </div>
	    <?php
	}
}

// setup redirects & notices if site-disabled is active
if( !function_exists('handle_disabled_site') ){
	function handle_disabled_site(){
		if( get_field('disable-site', 'option') == true ){
			$slug = get_post_field( 'post_name', get_post() );
			add_action( 'admin_notices', 'admin_notify_disabled_site' );
			if( $slug == 'disabled' || is_admin() ){
				if( is_admin() && !current_user_can('delete_others_pages') ){
					wp_logout();
					wp_redirect( home_url( '/disabled/' ), 301 );
				    exit;	
				}
			}
			else{
				wp_redirect( home_url( '/disabled/' ), 301 );
			    exit;	
			}
		}
	}
}
add_action('get_header', 'handle_disabled_site');
add_action('admin_head', 'handle_disabled_site');




// CUSTOM LOGIN MESSAGES
if( !function_exists('disable_site_login_message') ){
	function disable_site_login_message() {
		if( get_field('disable-site', 'option') ){
	        $message = '<p class="message"><b>Site has been disabled</b><br/>Call ' . get_field("webx-phone", "option") . ' for help.</p>';
	        return $message;
		}
	}
}
add_filter('login_message', 'disable_site_login_message');



// stop user from logging in during site disabled if they're not admin
if( !function_exists('login_during_disable_site') ){
	function login_during_disable_site($user_login, $user){
		if( !in_array('delete_others_pages', $user->allcaps ) ){
			wp_logout();
			wp_redirect( home_url( '/disabled/' ), 301 );
		    exit;	
		}
	}	
}
add_action('wp_login', 'login_during_disable_site', 10, 2);



// remove wordpress footer text
if( !function_exists('action_change_footer_text') ){
	function action_change_footer_text($content) {
	    return "";
	}
}
if( !function_exists('action_change_footer') ){
	function action_change_footer() {
	    add_filter( 'admin_footer_text', 'action_change_footer_text', 11 );
	}
}
add_action( 'admin_init', 'action_change_footer' );


// remove wp logo in the top left
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

if( !function_exists('remove_wp_logo') ){
	function remove_wp_logo( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
		$wp_admin_bar->remove_node( 'comments' );
	}
}


// remove flyout from google analytics plugin
add_action( 'admin_menu', 'remove_ga_flyout', 999 );

if( !function_exists('remove_ga_flyout') ){
	function remove_ga_flyout(){
		remove_submenu_page( 'google-analyticator', 'google-analyticator-other-plugins' );
	}
}


if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) : 
	function wpse_custom_wp_trim_excerpt($wpse_excerpt) {

		function wpse_allowedtags() {
			// Add custom tags to this string
				return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>'; 
			}

		$raw_excerpt = $wpse_excerpt;

		if ( '' == $wpse_excerpt ) {
			$wpse_excerpt = get_the_content('');
			$wpse_excerpt = strip_shortcodes( $wpse_excerpt );
			$wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
			$wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
			/*
				Use the allowedtags filter (to allow certain tags, or none)
				(To strip NO tags - to allow all - comment out the strip_tags line )
			*/
			// $wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags());

			//Set the excerpt word count and only break after sentence is complete.
			$excerpt_word_count = 75;
			$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
			$tokens = array();
			$excerptOutput = '';
			$count = 0;
			// Divide the string into tokens; HTML tags, or words, followed by any whitespace
			preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);
			foreach ($tokens[0] as $token) { 
				if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
				// Limit reached, continue until , ; ? . or ! occur at the end
					$excerptOutput .= trim($token);
					break;
				}
				// Add words to complete sentence
				$count++;
				// Append what's left of the token
				$excerptOutput .= $token;
			}
			$wpse_excerpt = trim(force_balance_tags($excerptOutput));
				if ( $count >= $excerpt_length ) {   
				    $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . 'Read more &nbsp;&raquo;' . '</a>'; 
				    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 

				    //$pos = strrpos($wpse_excerpt, '</');
				    //if ($pos !== false)
				    // Inside last HTML tag
				    //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
				    //else
				    // After the content
				    $wpse_excerpt .= $excerpt_more; /*Add read more in new paragraph */
				}
			return $wpse_excerpt;   
		}
		return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
	}
endif; 
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt'); 



// set a custom excerpt length (at 110 characters instead of 55)
if( !function_exists('wpdocs_custom_excerpt_length')){

	function wpdocs_custom_excerpt_length( $length ) {
	    return 110;
	}
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );




?>