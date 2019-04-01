import $ from 'jquery';
var Theme = {};
var Hero = {};
var Headers = {};
import slick from 'slick-carousel-browserify';

$('#slick_slider').slick();






Headers.Desktop = {
    _init: function () {
        Headers.Desktop.Address_Link._init();
        Headers.Desktop.One._init();
        Headers.Desktop.Eight._init();
        Headers.Desktop.Ten._init();
        

    },

    Address_Link: {
        address_link: $(".google-search-address"),
        address_text: $(".google-search-address").text(),

        _init: function () {
            Headers.Desktop.Address_Link.address_link.on("click", Headers.Desktop.Address_Link._open_google_search);
        },
        _open_google_search: function (e) {
            event.preventDefault();
            window.open('https://google.com/search?q=' + Headers.Desktop.Address_Link.address_text);
        },

    },
    One: {

        header: $("header.header#opt_header_one"),
        div_two: $("header#opt_header_one > div:nth-of-type(2)"),

        _init: function () {

            if ($(Headers.Desktop.One.header).length) {

                Headers.Desktop.One.div_two_offset_top = $("header#opt_header_one > div:nth-of-type(2)").offset().top;

                window.onscroll = function () {

                    Headers.Desktop.One._sticky_header();

                }

                Headers.Desktop.One._sticky_header();

            }
        },
        _sticky_header: function () {

            if (window.pageYOffset >= Headers.Desktop.One.div_two_offset_top) {

                Headers.Desktop.One.div_two.addClass("sticky");

            } else {

                Headers.Desktop.One.div_two.removeClass("sticky");

            }

        },

    },
    Eight: {

        header: $("header.header#opt_header_eight"),

        _init: function () {

            if ($(Headers.Desktop.Eight.header).length) {

                Headers.Desktop.Eight.offset_top = Headers.Desktop.Eight.header.offset().top;

                window.onscroll = function () {
                    Headers.Desktop.Eight._sticky_header();
                }
                Headers.Desktop.Eight._sticky_header();

            }

        },
        _sticky_header: function () {

            if (window.pageYOffset >= Headers.Desktop.Eight.offset_top) {
                Headers.Desktop.Eight.header.addClass("sticky");
            } else {
                Headers.Desktop.Eight.header.removeClass("sticky");
            }

        },

    },
    Ten: {
        header: $("header#opt_header_ten"),
        hamburger_icon: $("header#opt_header_ten > div:first-of-type > div > div:first-of-type > a"),
        sidebar: $(".header_sidebar_menu_1"),
        outside: $(".header_sidebar_menu_1, #opt_header_ten > div:first-of-type div, #opt_header_ten ul, #opt_header_ten"),

        _init: function () {

            Headers.Desktop.Ten.hamburger_icon.on("click", Headers.Desktop.Ten._hamburger_icon_click);

            Headers.Desktop.Ten.outside.on("click", Headers.Desktop.Ten._outside_click);

            Headers.Desktop.Ten.sidebar.on("blur", Headers.Desktop.Ten._close_sidebar);

            //On browser resize
            window.addEventListener('resize', function () {
                Headers.Desktop.Ten._close_sidebar();
            });

        },

        _hamburger_icon_click: function () {
            //If header 10 hamburger icon link has class of ...
            if (!Headers.Desktop.Ten.hamburger_icon.hasClass("header_10_hamburger_icon_changed")) {
                Headers.Desktop.Ten._open_sidebar();
            } else {
                Headers.Desktop.Ten._close_sidebar();
            }
        },
        _outside_click: function (e) {
            if (e.target === this) {
                Headers.Desktop.Ten._close_sidebar();
            }
        },
        _close_sidebar: function () {
            //Add hamburger icon link class
            Headers.Desktop.Ten.hamburger_icon.removeClass("header_10_hamburger_icon_changed");

            //Open sidebar navigational menu
            Headers.Desktop.Ten.sidebar.removeClass("header_sidebar_cover_all");
        },
        _open_sidebar: function () {
            //Remove hamburger icon link class
            Headers.Desktop.Ten.hamburger_icon.addClass("header_10_hamburger_icon_changed");

            //Close sidebar navigational menu
            Headers.Desktop.Ten.sidebar.addClass("header_sidebar_cover_all");
        }

    }

}
Headers.Desktop._init();
Headers.Mobile = {

    _init: function () {
        Headers.Mobile.Sidebar._init();
    },

    Sidebar: {

        //Mobile header sidebar menu
        sidebar: $(".mobile_header_sidebar_menu_1"),
        //Mobile header sidebar and mobile header first div element
        outside: $(".mobile_header_sidebar_menu_1, .mobileheader > div:first-of-type"),
        //Link which is the parent of the hamburger icons (spans)
        toggle: $("header.mobileheader > div:first-of-type > a"),

        _init: function () {

            //When hamburger icon spans link is clicked
            Headers.Mobile.Sidebar.toggle.on("click", Headers.Mobile.Sidebar._clickHandler);
            Headers.Mobile.Sidebar.outside.on("click", Headers.Mobile.Sidebar._outside_click_close_sidebar);
            Headers.Mobile.Sidebar.sidebar.on("blur", Headers.Mobile.Sidebar._close_sidebar);

            //On resize of browser
            window.addEventListener('resize', function () {
                //Remove mobile nav sidebar menu width
                Headers.Mobile.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
                //Remove mobile nav hamburger icon class
                Headers.Mobile.Sidebar.toggle.removeClass("mobile_nav_sidebar_menu_1");
            });

        },
        _clickHandler: function () {
            //If the hamburger icon spans link does not have class of mobile_nav_sidebar_menu_1
            if (!Headers.Mobile.Sidebar.toggle.hasClass("mobile_nav_sidebar_menu_1")) {
                //Open sidebar
                Headers.Mobile.Sidebar._open_sidebar();
            } else {
                //Close sidebar
                Headers.Mobile.Sidebar._close_sidebar();
            }
        },
        _outside_click_close_sidebar: function (e) {
            if (e.target === this) {
                Headers.Mobile.Sidebar._close_sidebar();
            }
        },
        _open_sidebar: function () {
            //Hamburger icon link add class
            Headers.Mobile.Sidebar.toggle.addClass("mobile_nav_sidebar_menu_1");
            //Make the sidebar menu cover the whole page
            Headers.Mobile.Sidebar.sidebar.addClass("mobile_sidebar_cover_all");
        },
        _close_sidebar: function () {
            //Hamburger icon link remove class
            Headers.Mobile.Sidebar.toggle.removeClass("mobile_nav_sidebar_menu_1");
            //Make the sidebar menu to not cover the whole page
            Headers.Mobile.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
        }
    }
}
Headers.Mobile._init();

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

Hero = {
    _init: function () {
        Hero.Padding._init();
        Hero.Slider._init();
        Hero.Video._init();
    },

    Padding: {

        header_id: $("header").attr("id"),

        header_height: $("header").height(),

        mobile_header_height: $(".mobileheader").height(),

        main: $(".mobileheader").next(),

        _init: function () {

            //On init, if browser width is greater than 1280
            if (window.innerWidth >= 1280) {

                Hero.Padding._header_function();

            } else {

                Hero.Padding._mobile_header_function();

            }

            //On resize, if browser width is greater than 1280 
            window.addEventListener('resize', function () {

                if (window.innerWidth >= 1280) {

                    Hero.Padding._header_function();

                } else {

                    Hero.Padding._mobile_header_function();

                }
            });

        },
        _header_function: function () {

            //Get header position value
            Hero.Padding.header_position = $("header").css("position");

            //If header has a position of fixed and not header 4
            if (Hero.Padding.header_position === "fixed" && Hero.Padding.header_id !== "opt_header_four" && Hero.Padding.header_id !== "opt_header_nine") {

                Hero.Padding.header_height = $("header").height();

                Hero.Padding.main.css("padding-top", Hero.Padding.header_height);

                //If header has a position of fixed and is header 4
            } else if (
                Hero.Padding.header_position === "fixed" &&
                Hero.Padding.header_id === "opt_header_four" ||
                Hero.Padding.header_id === "opt_header_nine"
            ) {
                Hero.Padding.header_first_div_height = $("header#" + Hero.Padding.header_id + " > div").height();

                Hero.Padding.main.css("padding-top", Hero.Padding.header_first_div_height);

            } else {
                //Do not adding padding-top to hero
                Hero.Padding.main.css("padding-top", "0");
            }

        },
        _mobile_header_function: function () {
            Hero.Padding.mobiler_header_height = $(".mobileheader").height();
            Hero.Padding.main.css("padding-top", Hero.Padding.mobile_header_height);
        }

    },

    Slider: {
        slick_slider: $("#slick-images"),
        rand: Math.floor(Math.random() * $(".img-slick").length),
        slick_pause: $("#slick-pause"),
        slick_play: $("#slick-play"),

        _init: function () {
            Hero.Slider._start_slider();
            Hero.Slider.slick_pause.on("click", Hero.Slider._pause_slider);
            Hero.Slider.slick_play.on("click", Hero.Slider._play_slider);
        },
        _start_slider: function () {
            // $("#slick_slider").slick({
                // autoplay: Boolean(hero_fields.hero_slider_autoplay),
                // // adaptiveHeight: true,
                // arrows: true,
                // infinite: true,
                // // mobileFirst: true,
                // slidesToShow: 1,
                // fade: Boolean(hero_fields.hero_slider_fade),
                // autoplaySpeed: hero_fields.hero_slider_speed,
                // pauseOnHover: false,
                // pauseOnFocus: false,
                // initialSlide: Boolean(hero_fields.hero_slider_random) ? Hero.Slider.rand : '',
                // nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>',
                // prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>'
            // });
        },
        _pause_slider: function () {
            Hero.Slider.slick_slider.slick("slickPause");
            Hero.Slider.slick_pause.fadeOut(100, function () {
                Hero.Slider.slick_play.fadeIn(100);
            });
        },
        _play_slider: function () {
            Hero.Slider.slick_slider.slick("slickPlay");
            Hero.Slider.slick_play.fadeOut(100, function () {
                Hero.Slider.slick_pause.fadeIn(100);
            });
        },
    },

    Video: {
        video: $("#video_tag"),
        pause_button: $("#video_pause"),
        play_button: $("#video_play"),

        _init: function () {
            Hero.Video.pause_button.on("click", Hero.Video._pause_video);
            Hero.Video.play_button.on("click", Hero.Video._play_video);
        },
        _pause_video: function () {
            Hero.Video.video.get(0).pause();
            Hero.Video.pause_button.fadeOut(100, function () {
                Hero.Video.play_button.fadeIn(100);
            });
        },
        _play_video: function () {
            Hero.Video.video.get(0).play();
            Hero.Video.play_button.fadeOut(100, function () {
                Hero.Video.pause_button.fadeIn(100);
            });
        }
    }
}
// Hero._init();

Theme.Headers = {
    tint: $(".header-tint"),
    estimate: $(".estimate-toggle, .topbanner-quickquote, .site__button-quote"),
    estimate_popup: $(".estimate"),
    estimate_close: $(".estimate.popupcontainer, .estimate-content-times.popupcontainer-times"),

    _init: function () {
        $(Headers.Mobile.estimate).on("click", Theme.Headers._click_handler);

        $(Headers.Mobile.estimate_close).on("click", Theme.Headers._close_popup);
    },

    _click_handler: function (event) {
        event.preventDefault();
        Theme.Headers.estimate_popup.fadeIn(250);
    },
    _close_popup: function (event) {
        if ($(event.target).hasClass("estimate") ||
            $(event.target).hasClass("estimate-content-times") ||
            $(event.target).hasClass("topbanner-quickquote") ||
            $(event.target).hasClass("site__button-quote")
        ) {
            event.preventDefault();
            Theme.Headers.estimate_popup.fadeOut(250);
        }
    },

}
Theme.Headers._init();

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
};

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