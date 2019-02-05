<?php 
if( get_field('enable-choose-header', 'options') ){
	$selected = get_field('choose-header-style', 'options');
	switch ($selected) {
		case 'one':
			include('includes/themes1_2.php');
			break;
		case 'two':
			include('includes/themes1_2.php');
			break;
			case 'three':
			// include('includes/theme3.php'); // experimenting here
			// include('includes/t3.php'); // experimenting here
			include('includes/themes1_2.php');
			break;
		case 'four':
			include('includes/theme4.php');
			break;
		default:
			# code...
			break;
	}

} else {
	$name = wp_get_theme()->Name;
	switch( $name ){
		case '123_parent':
			include('includes/themes1_2.php');
			# code... 
			break;
		case '123_one':
			include('includes/themes1_2.php');
			# code...
			break;
		case '123_two':
			include('includes/themes1_2.php');
			# code...
			break;
		case '123_three':
			include('includes/theme3.php');
			# code...
			break;
		case '123_four':
			# code...
			include('includes/theme4.php');
			break;
		default:
			# code...
			break;
	}
}
die();
?>