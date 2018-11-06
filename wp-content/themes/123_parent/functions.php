<?php 
/**
 * 	Deactivate ACF Plugins if Installed, and use Integrated ACF
 */

	include_once('classes/class.CustomFields.php');
	require_once('reqs/localize-acf.php');
/**
 * 	Verify Active Pages
 */
	add_action('init', 'manage_page_requirements', 1);
	require_once('classes/Pagedata.php');
	if( !function_exists( 'manage_page_requirements' ) ){
		function manage_page_requirements(){
			new Pagedata();
		}
	}
/**
 * 	FusionTables...
 */

	require_once('fusiontables/handler.php');

/**
 * 	Pre_Setup Theme
 */
if( !function_exists('get_gmap_api_key') ){
	function get_gmap_api_key(){
		return 'AIzaSyBOKWaxjiKG_kyx9exUfs32OFb8fwEqVBY';
	}
}
include_once('classes/class.GooMaps.php');
/**
 * 	Setup Theme :
 */
require_once('classes/class.MultiSiteSetup.php');
require_once('classes/class.Setup.php');
include_once('classes/class.NavUtil.php');

/**
 * 	Organize this craziness ASAP
 */
require_once('PHPImage.php');
require_once('components/reqs/color-helpers.php');
require_once('components/reqs/misc-helpers.php');
require_once('components/reqs/custompts.php');
require_once('components/reqs/roles.php');
require_once('components/reqs/resellers.php');
require_once('components/reqs/footer-helpers.php');
/**
 * 	Organize this craziness ASAP
 */








/**
 * adjusting site-setup clone fields to have new instructions, labels, etc
 * @param  array $field 'this' field passed by add_filter
 * @return array        the edited field
 */
function do_adjust_field_on_load($field){

	$field['sub_fields'][0]['instructions'] = '';

	return $field;
}

add_filter('acf/load_field/name=sitesetup_logo', 'do_adjust_field_on_load');
add_filter('acf/load_field/name=sitesetup_address', 'do_adjust_field_on_load');
add_filter('acf/load_field/name=sitesetup_email', 'do_adjust_field_on_load');





























if( !function_exists( 'hide_the_acf_field' ) ){
	function hide_the_acf_field( $field ){
		return false;
	}
}
// hide theme 4 specific acf fields here:
$cp_t4_fields = [
	'cp-t4-accent-bg',
	'cp-t4-accent-bg-toggle',
	'cp-t4-accent-text',
	'cp-t4-accent-text-toggle',
	'cp-t4-site-bg',
	'cp-t4-site-bg-toggle',
	'cp-t4-site-bg-text',
	'cp-t4-site-bg-text-toggle',
	'cp-t4-general-text',
	'cp-t4-general-text-toggle',
	'cp-t4-element-bg',
	'cp-t4-element-bg-toggle',
	'cp-t4-element-bg-text',
	'cp-t4-element-bg-text-toggle',
	'cp-t4-element-bg-dark',
	'cp-t4-element-bg-dark-toggle'
];
if( wp_get_theme()->Name != '123_four' ){
	foreach ($cp_t4_fields as $field) {
		add_filter("acf/prepare_field/name=$field", "hide_the_acf_field");
	}
}







if( !function_exists('acf_set_custom_homepage')){
	function acf_set_custom_homepage(){
		// if field is selected, set options
		if( !empty( get_field('field_8naniasm2jbnlaf', 'options') ) ){
			$selected_page = get_field('field_8naniasm2jbnlaf', 'options');
			update_option( 'page_on_front', $selected_page->ID );
			update_option( 'show_on_front', 'page' );
			// if selected page is not blog, use blog for posts page
			if( $selected_page->post_title != 'Blog' ){
				$page_for_posts = get_page_by_title( 'Blog' );
				update_option( 'page_for_posts', $page_for_posts->ID );
			}
			// if selected page is blog page, set nothing as the posts page 
			else {
				update_option( 'page_for_posts', 0);
			}
		}
		// if field is not selected, reset options
		else {
			update_option( 'page_on_front', 0);
			update_option( 'show_on_front', 'posts' );
			update_option( 'page_for_posts', 0);
		}
	}
	add_action( 'init', 'acf_set_custom_homepage', 99 );
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


////////////////////////////////////////////////////////////////
// Render Parallax Background Image by Slug or ACF Field Name //
////////////////////////////////////////////////////////////////
if(!function_exists('the_bg')){
	function the_bg($slug, $useslug = true){
		if(!$useslug){
			$bg = get_field($slug, 'option');
		}
		else{
			$bg = get_field($slug . '-bg', 'option');	
		}
		$output = '';
		if( !empty($bg) ){
			$output .= '<div class="parallax">';
			$output .=     '<img class="parallax-image" src="' . $bg . '">';
			$output .= '</div>';
			echo $output;
		}
	}
}




// gets the image for the blog post with the placeholder image as the fallback
if( !function_exists('get_blog_image') ){	
	function get_blog_image($post_id){
		$image_url = '';
		if( !empty( wp_get_attachment_url( get_post_thumbnail_id($post_id) ) ) ){
			$image_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
		}
		else{
			$image_url = get_field('featured-placeholder', 'option');
		}
		return $image_url;
	}
}
// generates Logo text when logo type switch is set to text
if( !function_exists('update_logo_text_image') ){
	function update_logo_text_image(){
		if( basename($_SERVER['REQUEST_URI']) == 'admin.php?page=general-settings' && get_field('logo-type-switch', 'option') == 'text' ){
			do_update_logo_text_image();
		}
	}
}
add_action('save_post', 'update_logo_text_image');


if( !function_exists('do_update_logo_text_image') ){
	function do_update_logo_text_image(){
		$bg = get_template_directory() . '/library/img/logo-canvas.png';

		$phpimg = new PHPImage();

		$phpimg->setDimensionsFromImage($bg);
		$phpimg->setQuality(9);
		$phpimg->setFont(get_template_directory() . '/library/fonts/GothamHTF-Medium.ttf');

		$text_color = array(255, 255, 255);

		if( get_field('navs-text-toggle', 'option') ){
			$text_color = hex_to_rgb(get_field('navs-text', 'option'));
		}

		$phpimg->setTextColor($text_color);

		$phpimg->text(get_field('site_title', 'option'), array(
	        'fontSize' => 60, 
	        'x' => 0,
	        'y' => 0,
	        'width' => 560,
	        'height' => 128,
	        'alignHorizontal' => 'center',
	        'alignVertical' => 'center',
	    ));

		$phpimg->imagetrim();

		$phpimg->setOutput('png');

		$phpimg->save(wp_upload_dir()['basedir'] . '/logo-text.png');
		chmod(wp_upload_dir()['basedir'] . '/logo-text.png', 0755);
	}
}

// returns the logo based on the logo type switch set in Theme Settings > 1. Company Info
if( !function_exists( 'get_logo' ) ){
	function get_logo(){
		if(get_field( 'logo-type-switch', 'option' ) == 'text'){
			return wp_upload_dir()['baseurl'] . '/logo-text.png';
		}
		else{
			return get_field('general-logo', 'option');
		}
	}
}
add_action('init', 'myprefix_unregister_tags');



// removes Post's tag taxonomy
if( !function_exists('myprefix_unregister_tags') ){
	function myprefix_unregister_tags() {
	    unregister_taxonomy_for_object_type('post_tag', 'post');
	}
}
add_action('admin_menu', 'wpse_233129_admin_menu_items');


// rearranges position and name of Posts
if( !function_exists('wpse_233129_admin_menu_items') ){
	function wpse_233129_admin_menu_items() {
	    global $menu;
	    $menu[5][0] = 'Blog Posts';
	    foreach ( $menu as $key => $value ) {
	        if ( 'edit.php' == $value[2] ) {
	            $oldkey = $key;
	        }
	    }
	    // change Posts menu position in the backend
	    $newkey = 83; // use whatever index gets you the position you want
	    // if this key is in use you will write over a menu item!
	    $menu[$newkey]=$menu[$oldkey];
	    unset($menu[$oldkey]);
	}
}



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

// remove toolbar new post from agent & client
add_action('admin_init', 'remove_admin_toolbar_items' );

if( !function_exists('remove_admin_toolbar_items') ){
	function remove_admin_toolbar_items(){
		$user = wp_get_current_user();

		if( !array_intersect(array('administrator'), $user->roles) ){
			add_action('admin_bar_menu', 'remove_topbar_new_content', 999);
		}

	}
}

if( !function_exists('remove_topbar_new_content') ){
	function remove_topbar_new_content($wp_admin_bar){
		$wp_admin_bar->remove_node( 'new-content' );
	}
}



// remove flyout from google analytics plugin
add_action( 'admin_menu', 'remove_ga_flyout', 999 );

if( !function_exists('remove_ga_flyout') ){
	function remove_ga_flyout(){
		remove_submenu_page( 'google-analyticator', 'google-analyticator-other-plugins' );
	}
}

// regenerate logo-text.png on push-to-deploy
add_action( 'wppusher_theme_was_updated', function(){
	if( function_exists( 'do_update_logo_text_image' )){
		do_update_logo_text_image();
	}
});

// regenerate logo-text.png on theme switch
add_action( 'after_switch_theme', function(){
	if( function_exists( 'do_update_logo_text_image' )){
		do_update_logo_text_image();
	}
});


// checks if logo-text.png exists in uploads dir if it doesn't then generate it
add_action( 'after_setup_theme', 'check_logo_text_exists' );

if( !function_exists('check_logo_text_exists') ){
	function check_logo_text_exists(){
		if( !file_exists(wp_upload_dir()['basedir'] . '/logo-text.png') ){
			do_update_logo_text_image();
		}
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


if( !function_exists('return_areas_served_grid_items') ){
	function return_areas_served_grid_items(){
		$grid_items = array();
		switch ( get_field('areas_served_select', 'options') ) {
			case 'zips':
				# code...
				$rows = get_field('locations', 'option'); 
				foreach($rows as $index => $row) {	
					$address_explosion = explode(',', $row['zip']['address']);
					$address_slice = array_slice($address_explosion, count($address_explosion) - 3);
					$city_name = $address_slice[0];
					$state_name = $address_slice[1];
					$grid_items[$index]['header'] = $city_name . ', ' . $state_name;
					$grid_items[$index]['image']['id'] = $row['area-image']['id'];
				}
				break;
			case 'states':
				# code...
				$rows = get_field('states', 'option');
				foreach($rows as $index => $row) {
					$grid_items[$index]['header'] = $row['state']['label'];
					$grid_items[$index]['image']['id'] = $row['image']['id'];
				}
				break;
			case 'countries':
				# code...
				$rows = get_field('countries', 'option');
				foreach($rows as $index => $row) {
					$grid_items[$index]['header'] = $row['country']['label'];
					$grid_items[$index]['image']['id'] = $row['country_image']['id'];
				}
				break;
			case 'counties':
				# code...
				$rows = get_field('counties', 'option');
				foreach($rows as $index => $row) {
					preg_match_all('/(.*)(?=\,)/', $row['county']['address'], $matches);
					$grid_items[$index]['header'] = $matches[0][0];
					$grid_items[$index]['image']['id'] = $row['image']['id'];
				}
				break;
		}
		return $grid_items;
	}
}



?>