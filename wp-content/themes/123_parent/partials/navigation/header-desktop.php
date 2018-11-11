<?php 

$invertlogo = get_field('general-theme-invert-headerfooter-logo-colors', 'option') ? ' invertlogo' : '';
$fadenav = get_field('nav-fadein-toggle', 'option') ? ' removefadein' : '';

$topbar_toggle = get_field('remove-topbar', 'option');
$topbar_text = get_field('header-bar-text', 'option');
$logo_src = get_logo();

$quote_toggle = get_field('quickquote-disable', 'option');
$quote_text = get_field('quickquote-button-text', 'option');

/**
 * if topbar is enabled or disabled, set the content string
 */
$topbar = null;
if( !$remove_topbar ){
	$topbar = '<div class="header-topbar"><a class="header-topbar-link">'.$topbar_text.'</a></div>';
}

/**
 * if quickquote is enabled, set the content string
 */
$quote = null;
if( !$quote_toggle ){
	$quote = '<a href="#" class="estimate-toggle header-content-quickquote button-quote">'.$quote_text.'</a>';
}


$tel = '';
$format_tel = '<a href="%s" class="header-content-menus-pages-menu-item-link">%s</a>';
$tel .= sprintf(
	$format_tel
	,get_the_phone('tel')
	,get_the_phone('tel')
);


$format_nav = '<nav class="header-content-nav">%s%s</nav>';
$nav = '';
$nav .= sprintf(
	$format_nav
	,$tel
	,NavUtil::get_nav_links('header-content-nav-links')
);


$logo = '<a class="header-content-logo"><img src="'.get_logo().'" alt="'.bloginfo('sitename').'"></a>';

$format_header = '
	<header class="header %s %s">
		<div class="header-tint"></div>
		%s
		<div class="header-content">
			%s
			%s
			%s
		</div>
	</header>
';
$header = '';
$header .= sprintf(
	$format_header
	,$invertlogo
	,$fadenav
	,$topbar
	,$logo
	,$nav
	,$quote
);


echo $topbar;
echo $header;

die();
 ?>