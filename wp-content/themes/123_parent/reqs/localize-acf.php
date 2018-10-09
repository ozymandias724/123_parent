<?php 
/**
 * 	Manually Integrate ACF into the Theme
 */

// Remove ACF as a plugin (it cannot be enabled)
add_action('admin_init', 'check_for_acf_plugin');
if( !function_exists('check_for_acf_plugin')){
    function check_for_acf_plugin(){
        if( class_exists('acf')){
            if ( is_plugin_active('advanced-custom-fields-pro/acf.php') ) {
                deactivate_plugins('advanced-custom-fields-pro/acf.php');    
            }
        }
    }
}

// Customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    // update path
    $path = get_template_directory() . '/components/acf/';
    // return
    return $path;
}

// Customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
    // update path
    $dir = get_template_directory_uri() . '/components/acf/';
    // return
    return $dir;
}
// Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');
// Include ACF
require_once( get_template_directory() . '/components/acf/acf.php' );

// Include Groups and Fields
require_once( dirname(__FILE__) . '/acf-groups/acf-groups.php');
/**
 * 
 */
 ?>
