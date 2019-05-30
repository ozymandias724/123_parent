import $ from 'jquery';
import slick from 'slick-carousel-browserify';

var Theme = {};
var Hero = {};
var Headers = {};



$(document).ready(function () {

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

    Theme.Slick = {
        rand: Math.floor(Math.random() * $(".img-slick").length),
        _init: function () {
            Theme.Slick._hero_slider();
            Theme.Slick._testimonials_slider();
        },
        _hero_slider: function () {
            $('#slick_slider_hero').slick({
                autoplay: Boolean(hero_fields.autoplay),
                adaptiveHeight: true,
                arrows: false,
                fade: Boolean(hero_fields.fade),
                autoplaySpeed: hero_fields.speed,
                pauseOnHover: false,
                pauseOnFocus: false,
                initialSlider: Boolean(hero_fields.random) ? Theme.Slick.rand : ''
            });
        },
        _testimonials_slider: function () {
            $('section#block__testimonials .site__grid').slick({
                autoplay: false,
                adaptiveHeight: true,
                arrows: true,
                fade: true,
                autoplaySpeed: 5000,
                pauseOnHover: true,
                pauseOnFocus: true,
                initialSlider: true,
                nextArrow: '<i class="testimonial_next fas fa-chevron-right"></i>',
                prevArrow: '<i class="testimonial_prev fas fa-chevron-left"></i>'
            });
        }
    }
    Theme.Slick._init();
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


Theme.Popups = {
    popups: $(".popup"),
    quote_btn: $(".site__button-quote"),
    header_popup: $("#header_popup"),
    timed_popup: $("#timed_overlay_popup"),
    header_popup_times: $("#header_popup .popup_close"),
    timed_popup_times: $("#timed_overlay_popup .popup_close"),
    timed_first_view: $("#timed_overlay_popup").attr("data-first-view"),
    timed_second_view: $("#timed_overlay_popup").attr("data-second-view"),
    banner_popup: $("#banner_popup"),

    _init: function () {
        $(Theme.Popups.quote_btn).on("click", Theme.Popups._click_handler);
        $(Theme.Popups.header_popup_times).on("click", Theme.Popups._header_popup_close);
        $(Theme.Popups.header_popup).on("click", Theme.Popups._header_popup_section_close);
        if (Theme.Popups.timed_popup.length) Theme.Popups._start_timed_popup();
        $(Theme.Popups.timed_popup_times).on("click", Theme.Popups._timed_popup_close);
        $(Theme.Popups.timed_popup).on("click", Theme.Popups._timed_popup_section_close);
        Theme.Popups._banner_popup();
    },
    _click_handler: function () {
        Theme.Popups.header_popup.fadeIn(250);
    },
    _header_popup_close: function () {
        Theme.Popups.header_popup.fadeOut(250);
    },
    _header_popup_section_close: function (event) {
        if (event.target == event.currentTarget) Theme.Popups.header_popup.fadeOut(250);
    },
    _timed_popup_close: function () {
        Theme.Popups.timed_popup.fadeOut(250);
        Theme.Popups._increase_timed_views();
    },
    _timed_popup_section_close: function (event) {
        if (event.target == event.currentTarget) Theme.Popups.timed_popup.fadeOut(250, function () {
            Theme.Popups._increase_timed_views();
        });
    },
    _resize_close: function () {
        Theme.Popups.popups.hide();
        Theme.Popups._increase_timed_views();
    },
    _increase_timed_views: function () {
        var views = $("#timed_overlay_popup").attr("data-viewed");
        views++;
        $("#timed_overlay_popup").attr("data-viewed", views);
        Theme.Popups._start_timed_popup_second();
    },
    _start_timed_popup: function () {
        setTimeout(function () {
            Theme.Popups.timed_popup.fadeIn(100);
        }, Theme.Popups.timed_first_view * 1000);
    },
    _start_timed_popup_second: function () {
        var views = $("#timed_overlay_popup").attr("data-viewed");
        views = parseInt(views);
        if (!(views > 1)) {
            setTimeout(function () {
                Theme.Popups.timed_popup.fadeIn(100);
            }, Theme.Popups.timed_second_view * 1000);
        }
    },
    _banner_popup: function(){
        $("header.header").prepend(Theme.Popups.banner_popup);
    }
}
Theme.Popups._init();


Theme.PA = {
    container: $('.pa.popupcontainer'),
    submit: $('.pa.popupcontainer input[type="submit"]'),
    _init: function () {
        if (Theme.PA.container.length > 0) {
            Theme.PA.container.click(Theme.PA._clickHandler);
        }
    },
    _clickHandler: function (e) {
        if ($(e.target).hasClass('pa') || $(e.target).hasClass('popupcontainer-times')) {
            if ($(e.target).has('.ginput_container').length == 0) {
                Theme.CookieMonster._setCookie('ad_set', 'active', 30, true);
                Theme.CookieMonster._deleteCookie('ad_notset');
                Theme.CookieMonster._deleteCookie('ad_firsttime');
                Theme.PA.container.off('click');
            }
            Theme.PA._hidePA();
        }
    },
    _hidePA: function () {
        Theme.PA.container.fadeOut(250);
        if (Theme.CookieMonster._cookieExists('ad_set') == false) {
            Theme.CookieMonster._setCookie('ad_notset', 'active', parseInt(PopupTimes.long), false);
            Theme.CookieMonster._listenCookieExpire('ad_notset', Theme.CookieMonster._firstTimeExpire);
        }
    },
    _showPA: function () {
        if (Theme.PA.container.length > 0 && $(window).width() >= 1025) {
            if (Theme.PA.container.css('display') == 'none') {
                Theme.PA.container.fadeIn(250);
            }
        }
    }
}


Theme.Gallery = {
    links: $("#gallery #gallery_titles a"),
    active_link_text: $("a.active_title").text(),
    image_galleries: $(".gallery_row"),
    gallery: $("#gallery"),

    _init: function () {
        Theme.Gallery.links.on("click", Theme.Gallery._tab_click);
        Theme.Gallery._hide_non_active();
    },

    _tab_click: function (e) {
        Theme.Gallery.link_text = e.target.classList[0];
        Theme.Gallery.links.each(function () {
            if ($(this).hasClass(Theme.Gallery.link_text.substring(0, Theme.Gallery.link_text.length - 6) + "_title")) {

                $(this).addClass('active_title');

            } else {

                $(this).removeClass('active_title');

            }
        });
        Theme.Gallery.image_galleries.each(function () {

            if ($(this).hasClass(Theme.Gallery.link_text.substring(0, Theme.Gallery.link_text.length - 6) + "_row")) {
                $(this).css("display", "flex");
            } else {
                $(this).css("display", "none");
            }

        });
    },
    _hide_non_active: function () {
        Theme.Gallery.image_galleries.each(function () {
            if (Theme.Gallery.gallery.hasClass("tab_divider") || Theme.Gallery.gallery.hasClass("tab_pill") || Theme.Gallery.gallery.hasClass("tab_sidebar")) {
                if (!$(this).hasClass("active_row")) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            }
        })
    },
}
Theme.Gallery._init();

Theme.Nav = {
    nav_links: $(".navlinks-item-link"),

    _init: function () {
        Theme.Nav.nav_links.on("click", Theme.Nav._active_nav_link);
    },
    _active_nav_link: function () {
        Theme.Nav.nav_links.each(function () {
            $(this).removeClass("active_menu_link");
        });
        $(this).addClass("active_menu_link");
    }
}
Theme.Nav._init();

Theme.Menu = {
    tab_link: $(" #block__food_menus .button_group a "),
    menu_section: $(" .menu_section "),

    _init: function () {
        Theme.Menu.tab_link.on("click", Theme.Menu._tab_link_click);
        Theme.Menu._show_menu_sections();
        Theme.Menu._activate_menu_links();
    },
    _tab_link_click: function () {

        var tab_link_index = $(this).parent().index();
 
        Theme.Menu.menu_section.each(function () {
            
            if($(this).index() !== tab_link_index){
                $(this).removeClass("active_menu_section");
            }else{
                $(this).addClass("active_menu_section");
            }

        });
        Theme.Menu.tab_link.each(function () {
            
            $(this).removeClass("active_menu_link");

        });
        $(this).addClass("active_menu_link");
    },
    _show_menu_sections: function(){
        Theme.Menu.menu_section.each(function(index){
            if(index == 0){
                $(this).addClass("active_menu_section");
            }
        });
    },
    _activate_menu_links: function(){
        Theme.Menu.tab_link.each(function(index){
            if(index == 0){
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
