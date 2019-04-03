<?php 
class Pagedata
{
	public static $active_pages = [];
	function __construct(){
		add_action('init', array($this, '_init'));
	}
	function _init(){
		// get the active pages and store it as a variable
		Pagedata::$active_pages = get_field('field_naaolkn23oin', 'options');
		// Pagedata::ensure_required_pages_exist();
	}
	// slug => [ title, template]
	public static $required_pages = array(
		'locations' => [
			'title' => 'Areas Served',
			'template' => 'locations.php'
		],
		'blog' => [
			'title' => 'Blog',
			'template' => 'blog.php'
		],
		'about' => [
			'title' => 'About',
			'template' => 'about.php'
		],
		'contact' => [
			'title' => 'Contact',
			'template' => 'contact.php'
		],
		'coupons' => [
			'title' => 'Coupons',
			'template' => 'coupons.php'
		],
		'disabled' => [
			'title' => 'Disabled',
			'template' => false
		],
		'gallery' => [
			'title' => 'Gallery',
			'template' => 'gallery.php'
		],
		'menu' => [
			'title' => 'Menu',
			'template' => 'menu.php'
		],
		'services' => [
			'title' => 'Services',
			'template' => 'services.php'
		],
		'terms' => [
			'title' => 'Terms and Conditions',
			'template' => false
		],
		'reviews' => [
			'title' => 'Testimonials',
			'template' => 'reviews.php'
		],
	);
	public static function ensure_required_pages_exist(){
		foreach(Pagedata::$required_pages as $slug => $info ) {
			// check for the required page (returns false or the page object)
			$obj = get_page_by_path($slug, ARRAY_A);
			// If the page exists already
			if( !empty($obj) ){
				// set default required values for the page
				$args = array(
					'ID' => $obj['ID'],
					'post_title' => '',
					'post_name' => $slug,
					'post_status' => 'private',
					'post_type' => 'page',
				);
				// check for any active pages
				if( !empty(Pagedata::$active_pages) ){
					// check if this page is active
					if( in_array( $slug , array_column(Pagedata::$active_pages, 'page-template')) ){
						$args['post_status'] = 'publish';

						$i = array_search($slug, array_column(Pagedata::$active_pages, 'page-template'));

						if( !empty(Pagedata::$active_pages[$i]['page-altname']) ){
							$custom_title = Pagedata::$active_pages[$i]['page-altname'];
							$args['post_title'] = $custom_title;
						}
						
						else {
							$args['post_title'] = $info['title'];
						}
					}
					// if this page is not active
					else {
						$args['post_status'] = 'private';
						$args['post_title'] = $info['title'];
					}
					// update the customized page
					$success = wp_insert_post($args);
				}
			}
			else {
				$args = array(
					'post_title' => $info['title'],
					'post_name' => $slug,
					'post_status' => 'private',
					'post_type' => 'page',
				);
				$success = wp_insert_post($args);
			}
		}
	}
	// Check True/False for Page Status by Slug
	public static function is_active_page($slug = ''){
		$obj = get_page_by_path($slug, ARRAY_A);
		if( $obj['post_status'] == 'publish'){
			return true;
		}
		else if($obj['post_status'] == 'private') {
			return false;
		}
		else {
			return 'Something went wrong... see:' . $obj['post_status'];
		}
	}
	// Check for Page Title/Altname by Slug
	public static function the_active_page_name($slug = ''){
		$obj = get_page_by_path($slug, ARRAY_A);
		echo $obj['post_title'];
	}

}
new Pagedata();
 ?>