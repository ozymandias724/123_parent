/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
*/


// Main Colors
wp.customize('colors__main_body_bg', function (value) {
    value.bind(function (newval) {
        $('.colors__body_bg, body').css('background-color', newval);
    });
});
wp.customize('colors__main_header_bg', function (value) {
    value.bind(function (newval) {
        $('.colors__header_bg, header').css('background-color', newval);
    });
});
wp.customize('colors__main_footer_bg', function (value) {
    value.bind(function (newval) {
        $('.colors__footer_bg, footer').css('background-color', newval);
    });
});
wp.customize('colors__main_accent_bg', function (value) {
    value.bind(function (newval) {
        $('.colors__accent_bg').css('background-color', newval);
    });
});

// Text / Type Colors
wp.customize('colors__type_headings', function (value) {
    value.bind(function (newval) {
        $('.colors__type_headings, h1, h2, h3, h4, h5, h6').css('color', newval);
    });
});
wp.customize('colors__type_body', function (value) {
    value.bind(function (newval) {
        $('.colors__type_body, body').css('color', newval);
    });
});
wp.customize('colors__type_navlinks', function (value) {
    value.bind(function (newval) {
        $('.colors__type_navlinks, .navlinks-item-link').css('color', newval);
    });
});
wp.customize('colors__type_herotext', function (value) {
    value.bind(function (newval) {
        $('.colors__type_herotext, section.hero').css('color', newval);
    });
});
wp.customize('colors__type_dividers', function (value) {
    value.bind(function (newval) {
        $('.colors__type_dividers').css('color', newval);
    });
});
wp.customize('colors__type_footertext', function (value) {
    value.bind(function (newval) {
        $('.colors__type_footertext, footer').css('color', newval);
    });
});

// Link Colors
wp.customize('links_button_bg', function (value) {
    value.bind(function (newval) {
        $('.links_button_bg').css('background-color', newval);
    });
});
wp.customize('links_button_bg_hover', function (value) {
    value.bind(function (newval) {
        $('.links_button_bg:hover').css('background-color', newval);
    });
});
wp.customize('links_button_text', function (value) {
    value.bind(function (newval) {
        $('.links_button_text').css('color', newval);
    });
});
wp.customize('links_anylink', function (value) {
    value.bind(function (newval) {
        $('.links_anylink, a').css('color', newval);
    });
});
wp.customize('links_anylink_hover', function (value) {
    value.bind(function (newval) {
        $('.links_anylink_hover, a:hover').css('color', newval);
    });
});

// Fonts
wp.customize('fonts__body', function (value) {
    value.bind(function (newval) {
        $('.fonts__body, body').css('font-family', newval);
    });
});
wp.customize('fonts__headings', function (value) {
    value.bind(function (newval) {
        $('.fonts__headings, h1, h2, h3, h4, h5, h6').css('font-family', newval);
    });
});