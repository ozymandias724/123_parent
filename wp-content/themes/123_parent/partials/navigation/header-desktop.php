<?php 

$invertlogo = get_field('general-theme-invert-headerfooter-logo-colors', 'option') ? ' invertlogo' : '';
$fadenav = get_field('nav-fadein-toggle', 'option') ? ' removefadein' : '';

$topbar_toggle = get_field('remove-topbar', 'option');
$topbar_text = get_field('header-bar-text', 'option');
$logo_src = get_logo();

$quote_toggle = get_field('quickquote-disable', 'option');
$quote_text = get_field('quickquote-button-text', 'option');

// (structure)
// header wrapper
// tint background overlay 1
// content wrapper overlay 2
// logo section
// nav section
	// page links
	// call to action
	// phone number

if( !$remove_topbar ){
	$topbar = '<div class="header-topbar"><a class="header-topbar-link">'.$topbar_text.'</a></div>';
} else {
	$topbar = null;
}
if( !$quote_toggle ){
	// need to cut these extra classes!
	$quote = '<a href="#" class="estimate-toggle header-content-quickquote button-quote">'.$quote_text.'</a>';
} else {
	$quote = null;
}

$tel = '';
$format_tel = '<a href="%s">%s</a>';
$tel .= sprintf(
	$format_tel
	,get_the_phone('tel')
	,get_the_phone('tel')
);


$format_nav = '<nav>%s%s</nav>';
$nav = '';
$nav .= sprintf(
	$format_nav
	,$tel
	,NavUtil::get_nav_links()
);


$logo = '<a><img src="'.get_logo().'" alt="'.bloginfo('sitename').'"></a>';

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
 ?>