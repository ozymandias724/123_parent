<?php 

// instantiate navhandler class
$navHandler = new NavHandler();

// required vars
$enabled_theme = wp_get_theme()->Name;
$use_custom_header = get_field('enable-choose-header', 'options');
$selected_header = get_field('choose-header-style', 'options');


// use default header
if (  $use_custom_header != '1' ) {

    if( $enabled_theme === '123_one' || $enabled_theme === '123_two' || $enabled_theme === '123_parent' ){
        echo $navHandler->header_two;
    }
    else if( $enabled_theme === '123_three' ){
        echo $navHandler->header_three;
    }
    else if( $enabled_theme === '123_four' ){
        echo $navHandler->header_four;
    }
}
// use custom header
else if( $use_custom_header == '1' ){

    if( $selected_header === 'one' ){
        echo $navHandler->header_one;
    }
    else if( $selected_header === 'two' ){
        echo $navHandler->header_two;
    }
    else if( $selected_header === 'three' ){
        echo $navHandler->header_three;
    }
    else if( $selected_header === 'four' ){
        echo $navHandler->header_four;
    }
    
}

die();
 ?>