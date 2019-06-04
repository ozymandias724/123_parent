(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
wp.customize('link_textcolor', function (value) {
  value.bind(function (newval) {
    $('.site__colors_links').css('color', newval);
  });
});
wp.customize('header_bgcolor', function (value) {
  value.bind(function (newval) {
    $('.site_colors_header_bg').css('background-color', newval);
  });
});
wp.customize('header_nav_bgcolor', function (value) {
  value.bind(function (newval) {
    $('.site_colors_header_nav_bg').css('background-color', newval);
  });
});
wp.customize('site__fonts_body', function (value) {
  value.bind(function (newval) {
    $('body, .site__fonts_body').css('font-family', newval);
  });
});
wp.customize('site__fonts_headers', function (value) {
  value.bind(function (newval) {
    $('h1, h2, h3, h4, h5, h6, .site__fonts_headers').css('font-family', newval);
  });
});
wp.customize('site__colors_buttons_bg', function (value) {
  value.bind(function (newval) {
    $('.site__colors_buttons_bg').css('background-color', newval);
  });
});

},{}]},{},[1])
//# sourceMappingURL=customizer.js.map
