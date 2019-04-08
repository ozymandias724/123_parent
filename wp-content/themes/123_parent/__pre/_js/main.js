import $ from 'jquery';
var Theme = {};
var Hero = {};
var Headers = {};
import slick from 'slick-carousel-browserify';

var rand = Math.floor(Math.random() * $(".img-slick").length);


Theme.Slick = {
    _init : function(){
        $('#slick_slider').slick({
            autoplay : Boolean(hero_fields.autoplay)
            ,adaptiveHeight : true
            ,arrows : false
            ,fade : Boolean(hero_fields.fade)
            ,autoplaySpeed : hero_fields.speed 
            ,pauseOnHover : false
            ,pauseOnFocus : false
            ,initialSlider : Boolean(hero_fields.random) ? rand : ''
        });
    }
}
Theme.Slick._init();


Theme.Open_Address = {

    address_link: $(".google-address"), 
    address_text: $(".google-address").text(),

    _init : function(){
        Theme.Open_Address.address_link.on("click", Theme.Open_Address._open_google_search);
    },
    _open_google_search: function () {
        window.open('https://google.com/search?q=' + Theme.Open_Address.address_text);
    },

},
Theme.Open_Address._init(); 


Headers.One = {

    header: $("header.header#opt_header_one"),

    _init: function(){

        if ($(Headers.One.header).length) {
            Headers.One.div_two_offset_top = $("header#opt_header_one > div:nth-of-type(2)").offset().top;
            window.onscroll = function () {
                Headers.One._sticky_header();
            }
            Headers.One._sticky_header();
        }
    },

    _sticky_header: function() {

        if (window.pageYOffset >= Headers.One.div_two_offset_top) {
            Headers.One.div_two.addClass("sticky");
        } else {
            Headers.One.div_two.removeClass("sticky");
        }

    },

},
Headers.One._init();


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

},
Headers.Eight._init();


Headers.Ten = {

    header: $("header#opt_header_ten"),
    hamburger_icon: $("header#opt_header_ten > div:first-of-type > div > div:first-of-type > a"),
    sidebar: $(".header_sidebar_menu_1"),
    outside: $('.header_sidebar_menu_1, #opt_header_ten > div:first-of-type div, #opt_header_ten ul, #opt_header_ten'),

    _init: function () {

        Headers.Ten.hamburger_icon.on("click", Headers.Ten._hamburger_icon_click);

        Headers.Ten.outside.on("click", Headers.Ten._outside_click);

        Headers.Ten.sidebar.on("blur", Headers.Ten._close_sidebar);

        //On browser resize
        window.addEventListener('resize', function () {
            Headers.Ten._close_sidebar();
        });

    },

    _hamburger_icon_click: function () {
        //If header 10 hamburger icon link has class of ...
        if (!Headers.Ten.hamburger_icon.hasClass("header_10_hamburger_icon_changed")) {
            Headers.Ten._open_sidebar();
        } else {
            Headers.Ten._close_sidebar();
        }
    },
    _outside_click: function (e) {
        if (e.target === this) {
            Headers.Ten._close_sidebar();
        }
    },
    _close_sidebar: function () {
        //Add hamburger icon link class
        Headers.Ten.hamburger_icon.removeClass("header_10_hamburger_icon_changed");

        //Open sidebar navigational menu
        Headers.Ten.sidebar.removeClass("header_sidebar_cover_all");
    },
    _open_sidebar: function () {
        //Remove hamburger icon link class
        Headers.Ten.hamburger_icon.addClass("header_10_hamburger_icon_changed");

        //Close sidebar navigational menu
        Headers.Ten.sidebar.addClass("header_sidebar_cover_all");
    }

}
Headers.Ten._init();


Headers.Sidebar = {

    //Mobile header sidebar menu
    sidebar: $(".mobile_header_sidebar_menu_1"),
    //Mobile header sidebar and mobile header first div element
    outside: $(".mobile_header_sidebar_menu_1, .mobileheader > div:first-of-type"),
    //Link which is the parent of the hamburger icons (spans)
    toggle: $("header.mobileheader > div:first-of-type > a"),

    _init: function () {

        //When hamburger icon spans link is clicked
        Headers.Sidebar.toggle.on("click", Headers.Sidebar._clickHandler);
        Headers.Sidebar.outside.on("click", Headers.Sidebar._outside_click_close_sidebar);
        Headers.Sidebar.sidebar.on("blur", Headers.Sidebar._close_sidebar);

        //On resize of browser
        window.addEventListener('resize', function () {
            //Remove mobile nav sidebar menu width
            Headers.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
            //Remove mobile nav hamburger icon class
            Headers.Sidebar.toggle.removeClass("mobile_nav_sidebar_menu_1");
        });

    },
    _clickHandler: function () {
        //If the hamburger icon spans link does not have class of mobile_nav_sidebar_menu_1
        if (!Headers.Sidebar.toggle.hasClass("mobile_nav_sidebar_menu_1")) {
            //Open sidebar
            Headers.Sidebar._open_sidebar();
        } else {
            //Close sidebar
            Headers.Sidebar._close_sidebar();
        }
    },
    _outside_click_close_sidebar: function (e) {
        if (e.target === this) {
            Headers.Sidebar._close_sidebar();
        }
    },
    _open_sidebar: function () {
        //Hamburger icon link add class
        Headers.Sidebar.toggle.addClass("mobile_nav_sidebar_menu_1");
        //Make the sidebar menu cover the whole page
        Headers.Sidebar.sidebar.addClass("mobile_sidebar_cover_all");
    },
    _close_sidebar: function () {
        //Hamburger icon link remove class
        Headers.Sidebar.toggle.removeClass("mobile_nav_sidebar_menu_1");
        //Make the sidebar menu to not cover the whole page
        Headers.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
    }
    
}
Headers.Sidebar._init();


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


Hero.Padding_Top = {

    header_id: $("header").attr("id"),
    header_height: $("header").height(),
    mobile_header_height: $(".mobileheader").height(),
    main: $(".mobileheader").next(),

    _init: function () {

        //On init, if browser width is greater than 1280
        if (window.innerWidth >= 1280) {
            Hero.Padding_Top._header_function();
        } else {
            Hero.Padding_Top._mobile_header_function();
        }

        //On resize, if browser width is greater than 1280 
        window.addEventListener('resize', function () {

            if (window.innerWidth >= 1280) {
                Hero.Padding_Top._header_function();
            } else {
                Hero.Padding_Top._mobile_header_function();
            }

        });
    },

    _header_function: function () {
        
        //Get header position value
        Hero.Padding_Top.header_position = $("header").css("position");

        //If header has a position of fixed and not header 1, 4, 9 or 3
        if (
            Hero.Padding_Top.header_position === "fixed" && 
            Hero.Padding_Top.header_id !== "opt_header_one" && 
            Hero.Padding_Top.header_id !== "opt_header_four" && 
            Hero.Padding_Top.header_id !== "opt_header_nine" && 
            Hero.Padding_Top.header_id !== "opt_header_three") {

            Hero.Padding_Top.header_height = $("header").height();

            Hero.Padding_Top.main.css("padding-top", Hero.Padding_Top.header_height);

        //If header has a position of fixed and is either header 1, 4, or 9
        } else if (
            Hero.Padding_Top.header_position === "fixed" &&
            Hero.Padding_Top.header_id === "opt_header_one" ||
            Hero.Padding_Top.header_id === "opt_header_four" ||
            Hero.Padding_Top.header_id === "opt_header_nine"
        ) {
            Hero.Padding_Top.header_first_div_height = $("header#" + Hero.Padding_Top.header_id + " > div").height();

            Hero.Padding_Top.main.css("padding-top", Hero.Padding_Top.header_first_div_height);

        } else {
            //Do not adding padding-top to hero
            Hero.Padding_Top.main.css("padding-top", "0");
        }

    },
    _mobile_header_function: function () {
        Hero.Padding_Top.mobiler_header_height = $(".mobileheader").height();
        Hero.Padding_Top.main.css("padding-top", Hero.Padding_Top.mobile_header_height);
    }

},
Hero.Padding_Top._init();


Theme.Estimate = {
    tint: $(".header-tint"),
    estimate: $(".estimate-toggle, .topbanner-quickquote, .site__button-quote"),
    estimate_popup: $(".estimate"),
    estimate_close: $(".estimate.popupcontainer, .estimate-content-times.popupcontainer-times"),

    _init: function () {
        $(Theme.Estimate.estimate).on("click", Theme.Estimate._click_handler);

        $(Theme.Estimate.estimate_close).on("click", Theme.Estimate._close_popup);
    },

    _click_handler: function (event) {
        event.preventDefault();
        Theme.Estimate.estimate_popup.fadeIn(250);
    },
    _close_popup: function (event) {
        if ($(event.target).hasClass("estimate") ||
            $(event.target).hasClass("estimate-content-times") ||
            $(event.target).hasClass("topbanner-quickquote") ||
            $(event.target).hasClass("site__button-quote")
        ) {
            event.preventDefault();
            Theme.Estimate.estimate_popup.fadeOut(250);
        }
    },

}
Theme.Estimate._init();


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