<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<?php if( is_single() ): ?>
		<meta property="og:image" content="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>"/>
		<meta property="og:title" content="<?php the_title(); ?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
		<meta property="og:url" content="<?php global $wp;
		echo home_url(add_query_arg(array(),$wp->request)); ?>"/>
		<?php else: ?>
		<meta property="og:image" content="<?php // echo get_logo(); ?>"/> 
		<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
		<meta property="og:url" content="<?php global $wp; echo home_url(add_query_arg(array(),$wp->request)); ?>"/>
	<?php endif; ?>
	<title><?php echo get_bloginfo('name');?></title>
	
	<?php 
		// wp_enqueue_scripts runs on the wp_head hook which is called by wp_head()
	    wp_head();
	 ?>
</head>

<body <?php body_class( ( !empty( get_field('header', 'options')['long_scroll'] ) ? 'js__smoothscroll' : '' ) ); ?>>
<?php 

    // if the banner popup is enabled
    if( !empty( get_field('popups', 'options')['banner']['status'] ) ){
        // include the banner popup
        include_once(get_template_directory() . '/parts/popups/popup.banner.php' );
	}
	// if the header popup is enabled 
	if( !empty( get_field('popups', 'options')['header']['status'] ) ){
		// include the header popup
		include_once(get_template_directory() . '/parts/popups/popup.header.php' );
	}
	// if the timed overlay popup is enabled 
	if( !empty( get_field('popups', 'options')['timed_overlay']['status'] ) ){
		// include the timed overlay popup
		include_once(get_template_directory() . '/parts/popups/popup.timed.php' );
	}


	if( $post->post_name !== 'disabled' ) {
		include('parts/nav/header/nav-desktop.php');
		include('parts/nav/header/nav-mobile.php');
    }
?>