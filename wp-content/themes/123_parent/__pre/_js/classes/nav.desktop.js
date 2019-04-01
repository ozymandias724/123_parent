import $ from 'jquery';

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