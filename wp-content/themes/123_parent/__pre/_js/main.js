var Theme = {};
var Headers = {};
import $ from 'jquery';
import Slick from 'slick-carousel-browserify';
import navDesktop from './classes/nav.desktop';
import navMobile from './classes/nav.mobile';


Theme.FadeEffects = {
    elements: $('.fade-up, .fade-left, .fade-right, .fade-in'),
    _resizeLoadScrollHandler: function () {
        for (var i = 0; i < Theme.FadeEffects.elements.length; i++) {
            if ($(window).scrollTop() + $(window).height() > $(Theme.FadeEffects.elements[i]).offset().top) {
                $(Theme.FadeEffects.elements[i]).removeClass('fade-up fade-left fade-right fade-in');
            }
        }
    },
    _init: function () {
        $(window).on('resize load scroll', Theme.FadeEffects._resizeLoadScrollHandler);
    },
}

Theme.FadeEffects._init();