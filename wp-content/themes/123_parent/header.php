<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo get_bloginfo('name'); ?></title>
    <?php if (is_single()) : ?>
        <meta property="og:image" content="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" />
        <meta property="og:title" content="<?php the_title(); ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <meta property="og:url" content="<?php global $wp;
                                            echo home_url(add_query_arg(array(), $wp->request)); ?>" />
    <?php else : ?>
        <meta property="og:image" content="<?php 
                                            ?>" />
        <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <meta property="og:url" content="<?php global $wp;
                                            echo home_url(add_query_arg(array(), $wp->request)); ?>" />
    <?php endif; ?>
    <?php
    // wp_enqueue_scripts runs on the wp_head hook which is called by wp_head()
    wp_head();
    ?>
</head>
<?php
    $header = get_field('header', 'options');
    $selected_header = 'header__' . $header['style'];
    $banner_popup_status = ( get_field('popups', 'options')['banner']['status'] == 1 ? 'banner_popup' : '' );

    $body_classes = array(
        (!empty(get_field('header', 'options')['long_scroll']) ? 'js__smoothscroll' : '')
        ,$selected_header
        ,$banner_popup_status
        ,'normal'
    );
?>

<body <?php body_class($body_classes); ?>>
    <?php
    include_once(get_template_directory() . '/parts/popups/popup.loader.php');
    include('parts/nav.desktop.php');
    include('parts/nav.mobile.php');
    /**
     *  Clean Up 
     */
    unset($body_classes);
    ?>