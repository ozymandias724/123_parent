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
 ?>