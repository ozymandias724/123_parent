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
		<meta property="og:image" content="<?php echo get_logo(); ?>"/>
		<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
		<meta property="og:url" content="<?php global $wp; echo home_url(add_query_arg(array(),$wp->request)); ?>"/>
	<?php endif; ?>
	<title><?php echo get_bloginfo('name');?></title>
	
	<?php 
		// wp_enqueue_scripts runs on the wp_head hook which is called by wp_head()
	    wp_head();
	 ?>
	
	<!-- admin-area css in theme settings -->
	<?php echo !empty(get_field('custom-css', 'option')) ? '<style type="text/css">' . get_field('custom-css', 'option') . '</style>' : ''; ?>
	
	<!-- color pickers in theme settings -->
	<?php include( locate_template( 'partials/color-pickers.php' ) ); ?>
	<?php do_action('123_after_color_pickers'); ?>
	
</head>
<?php 
	$invertlogo_class = (get_field('general-theme-invert-headerfooter-logo-colors', 'option')) ? 'invertlogo' : '';
	$fadein_class = (get_field('nav-fadein-toggle', 'option')) ? 'removefadein' : '';
 ?>
<body <?php body_class([$invertlogo_class, $fadein_class]); ?>>
<?php 
	if( $post->post_name !== 'disabled' ) {
		get_template_part('partials/navigation/nav', 'desktop');
		get_template_part('partials/navigation/nav', 'mobile');
	}
?>