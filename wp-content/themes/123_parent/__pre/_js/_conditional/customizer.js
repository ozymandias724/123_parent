/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
(function ($) {


    wp.customize('link_textcolor', function (value) {
        value.bind(function (newval) {
            $('html body a').css('color', newval);
        });
    });

    wp.customize('header_bgcolor', function (value) {
        value.bind(function (newval) {
            $('header.header > div:first-child').css('background-color', newval);
        });
    });

    wp.customize('header_nav_bgcolor', function (value) {
        value.bind(function (newval) {
            $('header.header > nav > ul, header.header > nav > ul:before, header.header > nav > ul:after').css('background-color', newval);
        });
    });

})(jQuery);