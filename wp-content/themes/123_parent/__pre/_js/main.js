/**
*  The Main JS File
*/


// get libraries
import $ from 'jquery';                         // latest jquery prereq
import slick from 'slick-carousel-browserify';  // slick slider (carousels)
import magnific from 'magnific-popup';          // magnific popup (lightboxes)
import zenscroll from 'zenscroll';              // smoothscroll
import { setTimeout } from 'timers';            // discuss what this is and why it is here


// create some 'classes'
var Theme = {};     // tbd
var Hero = {};      // tbd
var Headers = {};   // tbd
var Blocks = {};    // tbd




// certain things should wait until the document is ready
$(document).ready(function()
{

    /**
     * 
     *      This is NOT DRY
     * 
     *  If Header Six Exists
     */
    if ($('header').length) {
        var offset = $('header').height() + $('#popups__banner').height() ;
        $('main#page_home').css('margin-top', offset);
    }
    

    /**
     * FadeEffects
     * @type {Object}
     */
    Theme.FadeEffects = {
        elements: $('.site__fade'),
        _init: function () {
            $(window).on('scroll load', Theme.FadeEffects._scrollLoadHandler);
        },
        _scrollLoadHandler: function (e) {
            for (let index = 0; index < Theme.FadeEffects.elements.length; index++) {
                const element = Theme.FadeEffects.elements[index];
                if ($(window).scrollTop() + $(window).height() > ($(element).offset().top + 50)) {
                    $(element).removeClass('site__fade-up site__fade-in site__fade-left site__fade-right');
                }
            }
        }
    }
    Theme.FadeEffects._init();

    /**
     * 
     */
    Theme.Slick = {
        _init: function () {
            Theme.Slick._hero_slider();
            Theme.Slick._testimonials_slider();
        },
        _hero_slider: function () {
            $('#slick_slider_hero').slick({
                autoplay: Boolean(hero_fields.autoplay)
                ,adaptiveHeight: true
                ,arrows: !Boolean(hero_fields.autoplay)
                ,fade: Boolean(hero_fields.fade)
                ,autoplaySpeed: hero_fields.speed * 1000
                ,pauseOnHover: false
                ,pauseOnFocus: false
                ,prevArrow: ( Boolean(hero_fields.autoplay) == false ? '<div class="slick_prev_arrow">'+hero_fields.left_icon+'</div>' : '')
                ,nextArrow: ( Boolean(hero_fields.autoplay) == false ? '<div class="slick_next_arrow">'+hero_fields.right_icon+'</div>' : '')
            });
        },
        _testimonials_slider: function () {
            $('section.block__testimonials ul').slick({
                autoplay: false
                ,adaptiveHeight: true
                ,arrows: true
                ,fade: true
                ,autoplaySpeed: 5000
                ,pauseOnHover: true
                ,pauseOnFocus: true
                ,initialSlider: true
                // ,nextArrow: '<i class="testimonial_next fas fa-chevron-right"></i>'
                // ,prevArrow: '<i class="testimonial_prev fas fa-chevron-left"></i>'
                ,nextArrow: '<img class="testimonial_next" src="wp-content/themes/123_parent/library/img/left-arrow-3.png" />'
                ,prevArrow: '<img class="testimonial_prev" src="wp-content/themes/123_parent/library/img/left-arrow-3.png" />'
            });
        }
    }
    Theme.Slick._init();
    /**
     * 
     *      If we have a Banner PopUp
     * 
     * 
     */
    // if banner popup bar is present 
    if ($('#popups__banner').length) {
        
        var PopUps = {};
    
        /**
         * This baby is semantic. No description needed.
         */
        PopUps.Banner = {
            overlay: $('#popups__banner_overlay')
            ,_init : function(){
                $('#popups__banner > a').on('click', PopUps.Banner._openPopUp);
                PopUps.Banner.overlay.on('click', PopUps.Banner._clickedOverlayBG);
                $('.overlay__closebutton').on('click', PopUps.Banner._closePopUp);
            }
            ,_openPopUp : function(e){
                $('body').addClass('js__noscroll');
                PopUps.Banner.overlay.addClass('popups__banner_active');
            }
            ,_closePopUp : function(){
                $('body').removeClass('js__noscroll');
                PopUps.Banner.overlay.removeClass('popups__banner_active');
            }
            ,_clickedOverlayBG : function(e){
                if(e.target === e.currentTarget){
                    $('body').removeClass('js__noscroll');
                    PopUps.Banner.overlay.removeClass('popups__banner_active');
                }
            }
        }
        
        PopUps.Banner._init();
    }
    // can we combined some of this so that its listening for multiple things i.e., $('overlay1bg, overlay2bg).on(click)???
    // this code isnt DRY
    /**
     * 
     */
    if ($('#popups__header_overlay').length) {
        PopUps.Header = {
            overlay: $('#popups__header_overlay'),
            _init: function () {
                $('.site__button-quote').on('click', PopUps.Header._openPopUp);
                PopUps.Header.overlay.on('click', PopUps.Header._clickedOverlayBG);
                $('.overlay__closebutton').on('click', PopUps.Header._closePopUp);
            },
            _openPopUp: function (e) {
                $('body').addClass('js__noscroll');
                PopUps.Header.overlay.addClass('popups__header_active');
            },
            _closePopUp: function () {
                $('body').removeClass('js__noscroll');
                PopUps.Header.overlay.removeClass('popups__header_active');
            },
            _clickedOverlayBG: function (e) {
                if (e.target === e.currentTarget) {
                    $('body').removeClass('js__noscroll');
                    PopUps.Header.overlay.removeClass('popups__header_active');
                }
            }
        }
        PopUps.Header._init();
    }
    /**
     * 
     */
    if ($('#popups__timed_overlay').length) {

        PopUps.Timed = {
            overlay : $('#popups__timed_overlay')
            ,_init : function(){
                if(PopUps.Timed.overlay.length){
                    setTimeout( function(){ 
                        $('body').addClass('js__noscroll');
                        PopUps.Timed.overlay.addClass('popups__timed_active');
                    }, timed_overlay.first_view * 1000);
                }
                PopUps.Timed.overlay.on('click', PopUps.Timed._clickedOverlayBG);
                $('.overlay__closebutton').on('click', PopUps.Timed._closePopUp);
            }
            ,_closePopUp : function(){
                $('body').removeClass('js__noscroll');
                PopUps.Timed.overlay.removeClass('popups__timed_active');
            }
            ,_clickedOverlayBG : function(){
                $('body').removeClass('js__noscroll');
                PopUps.Timed.overlay.removeClass('popups__timed_active');
            }
        }
        // PopUps.Timed._init();
    }
    /**
     * 
     *  If we have a gallery block
     * 
     */
    if($('section.block__galleries').length && $('section.block__galleries div.tabs').length) {

        $('.galleries ul li .image').magnificPopup({
            'type' : 'image'
        });
        
        Blocks.Gallery = {
            tabs: $('.block__galleries div.tabs > ul > li'),
            galleries: $('.block__galleries div.galleries > .site__grid'),
            _init: function () {
                // when clicking tabs
                Blocks.Gallery.tabs.on('click', '>a', Blocks.Gallery._didClickTab);
            },
            _didClickTab: function (e) {
                // toggle visible gallery
                Blocks.Gallery.galleries.addClass('hidden_gallery');
                Blocks.Gallery.galleries.removeClass('current_gallery');
                $(Blocks.Gallery.galleries[$(this).parent('li').index()]).addClass('current_gallery');
                // toggle tab
                Blocks.Gallery.tabs.removeClass('tab_active');
                $(this).parent('li').addClass('tab_active')
            }
        }
        Blocks.Gallery._init();
    }

    /**
     * Handle the basics of the nav unspecific to a header style
     */
    Theme.Nav = {
        links: $(".navlinks-item-link"),

        _init: function () {
            Theme.Nav.links.on("click", Theme.Nav._clickedNavLink);
        },
        _clickedNavLink: function (e) {
            Theme.Nav.links.removeClass("active_menu_link");
            $(this).addClass("active_menu_link");
        }
    }
    Theme.Nav._init();

});




Headers.Eight = {

    header: $("header.header#opt_header_eight"),

    _init: function () {

        if ($(Headers.Eight.header).length) {
            Headers.Eight.offset_top = Headers.Eight.header.offset().top;
            window.onscroll = function () {
                Headers.Eight._sticky_header();
            }
            Headers.Eight._sticky_header();
        }

    },
    _sticky_header: function () {

        if (window.pageYOffset >= Headers.Eight.offset_top) {
            Headers.Eight.header.addClass("sticky");
        } else {
            Headers.Eight.header.removeClass("sticky");
        }

    },

}
Headers.Eight._init();


Headers.Site_Bars = {

    site_bars: $(".site__bars"),
    sidebar: $(".sidebar_menu"),
    outside: $("body, html"),

    _init: function () {

        Headers.Site_Bars.site_bars.on("click", Headers.Site_Bars._site_bars_click);

        Headers.Site_Bars.outside.on("click", Headers.Site_Bars._close_sidebar);

        Headers.Site_Bars.sidebar.on("blur", Headers.Site_Bars._close_sidebar);

        //On browser resize
        window.addEventListener('resize', function () {
            Headers.Site_Bars._close_sidebar();
        });

    },

    _site_bars_click: function (e) {
        e.stopPropagation();
        //If header 10 hamburger icon link has class of ...
        if (!Headers.Site_Bars.site_bars.hasClass("site_bars_changed")) {
            Headers.Site_Bars._open_sidebar();
        } else {
            Headers.Site_Bars._close_sidebar();
        }
    },
    _close_sidebar: function () {
        //Add hamburger icon link class
        Headers.Site_Bars.site_bars.removeClass("site_bars_changed");

        //Open sidebar navigational menu
        Headers.Site_Bars.sidebar.removeClass("header_sidebar_cover_all");
    },
    _open_sidebar: function () {
        //Remove hamburger icon link class
        Headers.Site_Bars.site_bars.addClass("site_bars_changed");

        //Close sidebar navigational menu
        Headers.Site_Bars.sidebar.addClass("header_sidebar_cover_all");
    }

}
Headers.Site_Bars._init();


Headers.Sidebar = {

    //Mobile header sidebar menu
    sidebar: $(".mobile_header_sidebar"),
    //Mobile header sidebar and mobile header first div element
    outside: $("body, html"),
    //Link which is the parent of the hamburger icons (spans)
    toggle: $("header.mobileheader > div:first-of-type > a"),

    _init: function () {

        //When hamburger icon spans link is clicked
        Headers.Sidebar.toggle.on("click", Headers.Sidebar._clickHandler);
        Headers.Sidebar.outside.on("click", Headers.Sidebar._close_sidebar);
        Headers.Sidebar.sidebar.on("blur", Headers.Sidebar._close_sidebar);

        //On resize of browser
        window.addEventListener('resize', function () {
            //Remove mobile nav sidebar menu width
            Headers.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
            //Remove mobile nav hamburger icon class
            Headers.Sidebar.toggle.removeClass("mobile_nav_sidebar");
        });

    },
    _clickHandler: function (e) {
        e.stopPropagation();
        //If the hamburger icon spans link does not have class of mobile_nav_sidebar_menu_1
        if (!Headers.Sidebar.toggle.hasClass("mobile_nav_sidebar")) {
            //Open sidebar
            Headers.Sidebar._open_sidebar();
        } else {
            //Close sidebar
            Headers.Sidebar._close_sidebar();
        }
    },
    _open_sidebar: function () {
        //Hamburger icon link add class
        Headers.Sidebar.toggle.addClass("mobile_nav_sidebar");
        //Make the sidebar menu cover the whole page
        Headers.Sidebar.sidebar.addClass("mobile_sidebar_cover_all");
    },
    _close_sidebar: function () {
        //Hamburger icon link remove class
        Headers.Sidebar.toggle.removeClass("mobile_nav_sidebar");
        //Make the sidebar menu to not cover the whole page
        Headers.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
    }

}
Headers.Sidebar._init();

Theme.Menu = {
    tab_link: $(" .food_menus .button_group a "),
    menu_section: $(" .menu_section "),

    _init: function () {
        Theme.Menu.tab_link.on("click", Theme.Menu._tab_link_click);
        Theme.Menu._show_menu_sections();
        Theme.Menu._activate_menu_links();
    },
    _tab_link_click: function () {

        var tab_link_index = $(this).parent().index();

        Theme.Menu.menu_section.each(function () {

            if ($(this).index() !== tab_link_index) {
                $(this).removeClass("active_menu_section");
            } else {
                $(this).addClass("active_menu_section");
            }

        });
        Theme.Menu.tab_link.each(function () {

            $(this).removeClass("active_menu_link");

        });
        $(this).addClass("active_menu_link");
    },
    _show_menu_sections: function () {
        Theme.Menu.menu_section.each(function (index) {
            if (index == 0) {
                $(this).addClass("active_menu_section");
            }
        });
    },
    _activate_menu_links: function () {
        Theme.Menu.tab_link.each(function (index) {
            if (index == 0) {
                $(this).addClass("active_menu_link");
            }
        })
    }
}
Theme.Menu._init();


Headers.One = {

    header: $("header.header#opt_header_one"),
    div_two: $("header.header#opt_header_one>div:last-of-type"),

    _init: function () {

        if ($(Headers.One.header).length) {
            Headers.One.div_two_offset_top = $("header#opt_header_one > div:nth-of-type(2)").offset().top;
            window.onscroll = function () {
                Headers.One._sticky_header();
            }
            Headers.One._sticky_header();
        }
    },

    _sticky_header: function () {
        if (window.pageYOffset >= Headers.One.div_two_offset_top) {
            Headers.One.div_two.addClass("sticky");
        } else {
            Headers.One.div_two.removeClass("sticky");
        }

    },

}
Headers.One._init();


Theme.CookieMonster = {
    _init: function () {
        if (DisableTimedPopup === 'false') {
            // Theme.CookieMonster._deleteCookie('ad_firsttime');
            // Theme.CookieMonster._deleteCookie('ad_notset');

            // if there's no cookies ie. first time on the site
            if (Theme.CookieMonster._cookieExists('ad_notset') == false && Theme.CookieMonster._cookieExists('ad_set') == false && Theme.CookieMonster._cookieExists('ad_firsttime') == false) {
                Theme.CookieMonster._setCookie('ad_firsttime', 'active', parseInt(PopupTimes.short), false);
            }
            // if the other cookies don't exist then listen for the expiration of the firstitme cookie
            if (Theme.CookieMonster._cookieExists('ad_set') == false && Theme.CookieMonster._cookieExists('ad_notset') == false) {
                Theme.CookieMonster._listenCookieExpire('ad_firsttime', Theme.CookieMonster._firstTimeExpire);
            }
        }
    },
    _listenCookieExpire: function (cookieName, callback) {
        var si = setInterval(function () {
            if (Theme.CookieMonster._cookieExists(cookieName) === false) {
                clearInterval(si);
                return callback();
            }
        }, 100);
    },
    _setCookie: function (cname, cvalue, ctime, days) {
        var d = new Date();
        // if days is set to false use seconds
        if (days == undefined || days) {
            days = true;
            d.setTime(d.getTime() + (ctime * 24 * 60 * 60 * 1000));
        } else if (days == false) {
            d.setTime(d.getTime() + (ctime * 1000));
        }
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    },
    _getCookieValue: function (cname) {
        var nameEQ = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    },
    _cookieExists: function (cname) {
        if (Theme.CookieMonster._getCookieValue(cname) != null) {
            return true;
        } else {
            return false;
        }
    },
    _deleteCookie: function (name) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    },
    _firstTimeExpire: function () {
        Theme.PA._showPA();
    },
}


Theme.Parallax = {
    strength: 25,
    stronger: 175,
    imagesections: $('.parallax-image'),
    _init: function () {
        $(window).on('resize scroll load', Theme.Parallax._resizeLoadScrollHandler);
    },
    _map: function (n, i, o, r, t) {
        return i > o ? i > n ? (n - i) * (t - r) / (o - i) + r : r : o > i ? o > n ? (n - i) * (t - r) / (o - i) + r : t : void 0;
    },
    _getAmount: function (el, strength) {
        var windowcenter = $(window).scrollTop() + ($(window).height() / 2);
        var sectioncenter = $(el).offset().top + ($(el).height() / 2);
        var sectiondelta = windowcenter - sectioncenter;
        var scale = Theme.Parallax._map(sectiondelta, 0, $(window).height(), 0, strength);
        return -50 + scale + '%';
    },
    _resizeLoadScrollHandler: function () {
        for (var i = 0; i < Theme.Parallax.imagesections.length; i++) {
            $(Theme.Parallax.imagesections[i]).css('transform', 'translate3d(-50%, ' + Theme.Parallax._getAmount(Theme.Parallax.imagesections[i], Theme.Parallax.strength) + ',0)');
        }
    }
}


// Theme.PA = {
//     container: $('.pa.popupcontainer'),
//     submit: $('.pa.popupcontainer input[type="submit"]'),
//     _init: function () {
//         if (Theme.PA.container.length > 0) {
//             Theme.PA.container.click(Theme.PA._clickHandler);
//         }
//     },
//     _clickHandler: function (e) {
//         if ($(e.target).hasClass('pa') || $(e.target).hasClass('popupcontainer-times')) {
//             if ($(e.target).has('.ginput_container').length == 0) {
//                 Theme.CookieMonster._setCookie('ad_set', 'active', 30, true);
//                 Theme.CookieMonster._deleteCookie('ad_notset');
//                 Theme.CookieMonster._deleteCookie('ad_firsttime');
//                 Theme.PA.container.off('click');
//             }
//             Theme.PA._hidePA();
//         }
//     },
//     _hidePA: function () {
//         Theme.PA.container.fadeOut(250);
//         if (Theme.CookieMonster._cookieExists('ad_set') == false) {
//             Theme.CookieMonster._setCookie('ad_notset', 'active', parseInt(PopupTimes.long), false);
//             Theme.CookieMonster._listenCookieExpire('ad_notset', Theme.CookieMonster._firstTimeExpire);
//         }
//     },
//     _showPA: function () {
//         if (Theme.PA.container.length > 0 && $(window).width() >= 1025) {
//             if (Theme.PA.container.css('display') == 'none') {
//                 Theme.PA.container.fadeIn(250);
//             }
//         }
//     }
// }