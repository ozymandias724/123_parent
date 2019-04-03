<?php 

// built-in acf
include_once('reqs/localize-acf.php');

// acf handler for page publish/private status
include_once('classes/Pagedata.php');

// general theme setup
include_once('classes/class.Setup.php');
// nav handler
include_once('classes/class.NavUtil.php');

// custom users
include_once('classes/class.UserRoles.php');

// php image (to be cut)
include_once('PHPImage.php');

// tbd
include_once('components/reqs/misc-helpers.php');

// custom post types
include_once('components/reqs/custompts.php');

// reseller stuff
include_once('components/reqs/resellers.php');

// footer stuff
include_once('components/reqs/footer-helpers.php');

include_once('classes/class.Customizer.php');

include_once('classes/class.NavHandler.php');


/**
 * adjusting site-setup clone fields to have new instructions, labels, etc
 * @param  array $field 'this' field passed by add_filter
 * @return array        the edited field
 */
function modacf_adjust_labelInstructions($field){

	switch ($field['name']) {
	
		case 'sitesetup_hero_services':
			$instructions = '';
			# code...
			break;
		case 'sitesetup_socials':
			$label = '7. Social Media';
			# code...
			break;
		case 'sitesetup_logo':
			# code...
			$instructions = '';
			break;
		case 'sitesetup_address':
			# code...
		$label = '1. Choose Address';
		$instructions = 'So the address you want on your new 123Website is,';
			break;
		case 'sitesetup_services_repeater':
			$label = '2. Services';
			# code...
			break;
		case 'sitesetup_email':
			# code...
		$label = '4. Email';
		$instructions = 'What\'s the best email address to reach you on?';
			break;
		case 'sitesetup_phone':
			# code...
		$instructions = 'And the phone number you want listed is ? ';
		$label = '2. Phone Number';
			break;
		case 'sitesetup_phone_secondary':
			# code...
		$label = '3. Secondary Phone Number';
		$instructions = 'Can I get a secondary number from you? Preferably a cell phone number?Our software will text message remind you for your appointment we set with your Website Consultant';
			break;
		case 'sitesetup_gallery_repeater':
			$label = '11. Gallery';
			# code...
			break;
		default:
			# code...
			break;
	}

	$items = array(
		'sitesetup_areas_repeater_zips',
		'sitesetup_areas_repeater_counties',
		'sitesetup_areas_repeater_countries',
		'sitesetup_areas_repeater_states'
	);
	if( in_array($field['name'], $items)){
		$instructions = '';
		$label = 'Areas Served Locations';
	}


	$field['sub_fields'][0]['instructions'] = $instructions;
	$field['sub_fields'][0]['label'] = $label;
	return $field;
}
function adjust_payment_type_clones($field){
	$dir = get_template_directory_uri() . '/library/img/payment_types/';	
	for ($i=0; $i < count($field['sub_fields']); $i++) { 
		# code...
		$field['sub_fields'][$i]['wrapper'] = array(
			'width' => '13',
			'class' => 'sitesetup_payment_togs',
			'id' => '',
		);
		switch ($field['sub_fields'][$i]['name'] ) {
			case 'mastercard':
				$png_path = $dir . 'mc.png';
				break;
			case 'amex':
				$png_path = $dir . 'amex.png';
				break;
			case 'cash':
				$png_path = $dir . 'cash.png';
				break;
			case 'check':
				$png_path = $dir . 'check.png';
				break;	
			case 'discover':
				$png_path = $dir . 'discover.png';
				break;
			case 'paypal':
				$png_path = $dir . 'pp.png';
				break;
			case 'visa':
				$png_path = $dir . 'visa.png';
				break;			
			default:
				# code...
				break;
		}
		$png_string = '<img src="'.$png_path.'">';
		$field['sub_fields'][$i]['label'] = $png_string;
	}
	return $field;
}
function adjust_company_info_clones($field){

	for ($i=0; $i < count($field['sub_fields']); $i++) { 
		$instructions = null;
		$label = null;

		switch ($field['sub_fields'][$i]['name']) {
			// 2: Company Info
			case 'social-address':
				$label = '1. Choose Address';
				$instructions = 'So the address you want on your new 123Website is,';
				break;
			case 'social-phone-number':
				$instructions = 'And the phone number you want listed is ? ';
				$label = '2. Phone Number';
				break;
			case 'social-fax-number':
				$label = '3. Secondary Phone Number';
				$instructions = 'Can I get a secondary number from you? Preferably a cell phone number? Our software will text message remind you for your appointment we set with your Website Consultant';
				break;
			case 'sitesetup_services_repeater':
				$label = '2. Services';
				break;
			case 'company-email':
				$label = '4. Email';
				$instructions = 'What\'s the best email address to reach you on?';
				break;
			// 3: Media
			case 'general-logo':
				$label = '1. Choose Site Logo';
				$instructions = '';
				break;
			case 'areas-served-bg':
				$label = 'Areas Served';
				$instructions = '';
				break;
			case 'contact-bg':
				$label = 'Contact';
				$instructions = '';
				break;
			case 'general-coupons-bg':
				$label = 'Coupons';
				$instructions = '';
				break;
			case 'general-blog-bg':
				$label = 'Blog';
				$instructions = '';
				break;
			case 'gallery-bg':
				$label = 'Gallery';
				$instructions = '';
				break;
			case 'menu-bg':
				$label = 'Menu';
				$instructions = '';
				break;
			case 'services-bg':
				$label = 'Services';
				$instructions = '';
				break;
			case 'testimonials-bg':
				$label = 'Testimonials';
				$instructions = '';
				break;
			case 'contact-bg':
				$label = 'Contact';
				$instructions = '';
				break;
			case 'gallery-repeater':
				$label = '3. Setup Gallery Page';
				break;
			// 4?
			case 'services-repeater':
				$instructions = '';
				break;
			case 'social-repeater':
				$label = '7. Social Media';
				break;
			default:
				break;
		}
		( $label !== null ) ? $field['sub_fields'][$i]['label'] = $label : null;
		( $label !== null ) ? $field['sub_fields'][$i]['__label'] = $label : null;
		( $instructions !== null ) ? $field['sub_fields'][$i]['instructions'] = $instructions : null;
	}
	return $field;
}
add_filter('acf/load_field/key=field_sitesetup_clones_2_a', 'adjust_payment_type_clones');
add_filter('acf/load_field/key=field_sitesetup_clones_2', 'adjust_company_info_clones');
add_filter('acf/load_field/key=field_sitesetup_clones_2_a', 'adjust_company_info_clones');
add_filter('acf/load_field/key=field_sitesetup_clones_2_b', 'adjust_company_info_clones');
add_filter('acf/load_field/key=field_sitesetup_clones_3', 'adjust_company_info_clones');
add_filter('acf/load_field/key=field_sitesetup_clones_3_0', 'adjust_company_info_clones');
add_filter('acf/load_field/key=field_sitesetup_clones_3_1', 'adjust_company_info_clones');



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

/**
 * Logo Text Image Stuff
 */
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
		function hex_to_rgb($hex){
			$hex = str_replace("#", "", $hex);

			if(strlen($hex) == 3) {
			  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
			  $r = hexdec(substr($hex,0,2));
			  $g = hexdec(substr($hex,2,2));
			  $b = hexdec(substr($hex,4,2));
			}
			$rgb = array($r, $g, $b);
			//return implode(",", $rgb); // returns the rgb values separated by commas
			return $rgb; // returns an array with the rgb values
		}

		$active_theme = wp_get_theme()->Name;
		// if(  $active_theme == '123_three' ){

		// }

		$bg = get_template_directory() . '/library/img/logo-canvas.png';

		$phpimg = new PHPImage();

		$phpimg->setDimensionsFromImage($bg);
		$phpimg->setQuality(9);
		if(  $active_theme == '123_three' ){
			$phpimg->setFont(get_stylesheet_directory() . '/library/fonts/Montserrat-Black.ttf');
		} else {
			$phpimg->setFont(get_template_directory() . '/library/fonts/GothamHTF-Medium.ttf');
		}

		$text_color = array(255, 255, 255);

		if(  $active_theme == '123_three' ){
			if( get_field('add_extra_theme_colors_header-logotoggle', 'option') ){
				$text_color = hex_to_rgb(get_field('add_extra_theme_colors_header-logopicker', 'option'));
			}
		} else {
			if( get_field('navs-text-toggle', 'option') ){
				$text_color = hex_to_rgb(get_field('navs-text', 'option'));
			}
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
// 
// 
// 

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