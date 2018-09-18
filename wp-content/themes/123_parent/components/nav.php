<?php 

require get_template_directory() . '/classes/NavWalker.php';

wp_nav_menu(array(
	'container' => 'nav',
	'container_class' => 'nav',
	'items_wrap' => '<ul class="nav-menu">%3$s</ul>',
	'walker' => new NavWalker(),
));

?>