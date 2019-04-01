import $ from 'jquery';

let Headers = {};

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