(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

var Admin = {};
;

(function ($, Admin, window, document, undefined) {
  $(document).ready(function () {
    Admin.SiteSetup = {
      sections: $('#acf-group_sitesetup_intro, #acf-group_sitesetup_1, #acf-group_sitesetup_2, #acf-group_sitesetup_3, #acf-group_sitesetup_4'),
      activeSectionIndex: undefined,
      pagination: $('#setup-pagination'),
      nextprev: $('#setup-nextprev span'),
      nextPrevGroup: $('#acf-group_sitesetup_5'),
      _init: function _init() {
        Admin.SiteSetup.sections.addClass('setup-section--hidden');
        Admin.SiteSetup.sections.first().removeClass('setup-section--hidden');

        Admin.SiteSetup._doBuildNav();

        Admin.SiteSetup.pagination.on('click', 'span', Admin.SiteSetup._clickedNavhandler);
        Admin.SiteSetup.nextprev.on('click', Admin.SiteSetup._doNextPrev);
      },
      _trackSectionIndex: function _trackSectionIndex() {
        Admin.SiteSetup.sections.each(function (index, el) {
          if (!$(el).hasClass('setup-section--hidden')) {
            Admin.SiteSetup.activeSectionIndex = index;
          }
        });

        if (Admin.SiteSetup.activeSectionIndex == 0) {
          Admin.SiteSetup.nextPrevGroup.find('span[data-name="prev"]').hide();
        } else {
          Admin.SiteSetup.nextPrevGroup.find('span[data-name="prev"]').show();
        }

        if (Admin.SiteSetup.activeSectionIndex == 4) {
          Admin.SiteSetup.nextPrevGroup.find('span[data-name="next"]').hide();
        } else {
          Admin.SiteSetup.nextPrevGroup.find('span[data-name="next"]').show();
        }
      },

      /**
       * handle the prev/next buttons
       * @param  {event} e the click event object
       * @return {none}
       */
      _doNextPrev: function _doNextPrev(e) {
        // clicked prev or next
        if (e.target.dataset.name == 'prev' || e.target.dataset.name == 'next') {
          Admin.SiteSetup._trackSectionIndex(); // save visible page before click


          var currentPage = Admin.SiteSetup.sections.not('.setup-section--hidden'); // save active button before click

          var activeButton = Admin.SiteSetup.pagination.find('span.active'); // clicked prev

          if (e.target.dataset.name == 'prev' && Admin.SiteSetup.activeSectionIndex != 0) {
            // clear active button
            activeButton.removeClass('active'); // hide visible page

            currentPage.addClass('setup-section--hidden'); // do prev

            currentPage.prev().removeClass('setup-section--hidden');
            activeButton.prev().addClass('active');
          } // clicked next


          if (e.target.dataset.name == 'next' && Admin.SiteSetup.activeSectionIndex != 4) {
            // clear active button
            activeButton.removeClass('active'); // hide visible page

            currentPage.addClass('setup-section--hidden'); // do next

            currentPage.next().removeClass('setup-section--hidden');
            activeButton.next().addClass('active');
          }

          Admin.SiteSetup._trackSectionIndex();
        }
      },

      /**
       * create the breadcrumb nav above the setup form
       * @return {null} appends html to acf message field
       */
      _doBuildNav: function _doBuildNav() {
        Admin.SiteSetup._trackSectionIndex();

        Admin.SiteSetup.sections.each(function (index) {
          var active = 'active';

          if (index === 0) {
            var button = '<span id="' + index + '" class="' + active + '">1. Theme</span>';
          }

          if (index === 1) {
            var button = '<span id="' + index + '" class="">2. Company Info</span>';
          }

          if (index === 2) {
            var button = '<span id="' + index + '" class="">3. Media</span>';
          }

          if (index === 3) {
            var button = '<span id="' + index + '" class="">4. Verify Content</span>';
          }

          if (index === 4) {
            var button = '<span id="' + index + '" class="">5. Finalize</span>';
          }

          Admin.SiteSetup.pagination.append(button);
        });
      },
      _clickedNavhandler: function _clickedNavhandler(e) {
        Admin.SiteSetup._trackSectionIndex(); // wipe active status


        Admin.SiteSetup.pagination.find('span').removeClass('active'); // add active status

        $(this).addClass('active'); // determine

        var index = $(this).index();
        Admin.SiteSetup.sections.addClass('setup-section--hidden');
        $(Admin.SiteSetup.sections[index]).removeClass('setup-section--hidden');

        Admin.SiteSetup._trackSectionIndex();
      }
    };

    Admin.SiteSetup._init();

    Admin.Training = {
      _init: function _init() {
        if ($('body').is('.toplevel_page_general-settings')) {
          $('#side-sortables').append('<style>' + '@media only screen{' + '.training-ad-desktop{ display: none; width: 100%;}' + '.training-ad-mobile{ display: block; width: 100%;}' + '}' + '@media only screen and (min-width: 851px){' + '.training-ad-desktop{ display: block;}' + '.training-ad-mobile{ display: none;}' + '}' + '</style>' + '<div class="postbox">' + '<a target="_blank" href="http://www.123websites.com/training">' + '<img class="training-ad-desktop" src="http://123websites.com/images/training-ad.png"/>' + '<img class="training-ad-mobile" src="http://123websites.com/images/training-ad-dashboard.png"/>' + '</a>' + '</div>');
        }

        $('html').css('overflow-y', 'scroll');
      }
    };

    Admin.Training._init();
  });
})(jQuery, Admin, window, document);

},{}]},{},[1])
//# sourceMappingURL=admin.js.map
