(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

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
}); // Text / Type Colors

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
}); // Link Colors

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
/**
 * 
 *      FONTS
 * 
*/
// family

wp.customize('fonts__body', function (value) {
  value.bind(function (newval) {
    $('.fonts__body, body').css('font-family', newval);
  });
}); // weight

wp.customize('fonts__body_weight', function (value) {
  value.bind(function (newval) {
    $('.fonts__body, body').css('font-weight', newval);
  });
}); // italics

wp.customize('fonts__body_italics', function (value) {
  value.bind(function (newval) {
    $('.fonts__body, body').css('font-style', newval);
  });
}); // family

wp.customize('fonts__headings', function (value) {
  value.bind(function (newval) {
    $('.fonts__headings, h1, h2, h3, h4, h5, h6').css('font-family', newval);
  });
}); // weight

wp.customize('fonts__headings_weight', function (value) {
  value.bind(function (newval) {
    $('.fonts__headings, h1, h2, h3, h4, h5, h6').css('font-weight', newval);
  });
}); // italics

wp.customize('fonts__headings_italics', function (value) {
  value.bind(function (newval) {
    if (newval) {
      $('.fonts__headings, h1, h2, h3, h4, h5, h6').css('font-style', 'italic');
    } else {
      $('.fonts__headings, h1, h2, h3, h4, h5, h6').css('font-style', 'normal');
    }
  });
});
/**
 * 
 *      HERO
 * 
 */

wp.customize('hero__height', function (value) {
  value.bind(function (newval) {
    $('section.hero').css('height', newval + 'vh');
  });
});
wp.customize('hero__image_height', function (value) {
  value.bind(function (newval) {
    $('section.hero .hero_foreground img').css('height', newval + '%');
  });
});
wp.customize('hero__fg_placement', function (value) {
  value.bind(function (newval) {
    $('section.hero .hero_foreground ').removeClass('topleft topcenter topright middleleft middlecenter middleright bottomleft bottomcenter bottomright');
    $('section.hero .hero_foreground ').addClass(newval);
  });
});

},{}]},{},[1])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJfX3ByZS9fanMvX2NvbmRpdGlvbmFsL2N1c3RvbWl6ZXIuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7OztBQ0FBOzs7Ozs7QUFRQTtBQUNBLEVBQUUsQ0FBQyxTQUFILENBQWEsc0JBQWIsRUFBcUMsVUFBVSxLQUFWLEVBQWlCO0FBQ2xELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsd0JBQUQsQ0FBRCxDQUE0QixHQUE1QixDQUFnQyxrQkFBaEMsRUFBb0QsTUFBcEQ7QUFDSCxHQUZEO0FBR0gsQ0FKRDtBQUtBLEVBQUUsQ0FBQyxTQUFILENBQWEsd0JBQWIsRUFBdUMsVUFBVSxLQUFWLEVBQWlCO0FBQ3BELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsNEJBQUQsQ0FBRCxDQUFnQyxHQUFoQyxDQUFvQyxrQkFBcEMsRUFBd0QsTUFBeEQ7QUFDSCxHQUZEO0FBR0gsQ0FKRDtBQUtBLEVBQUUsQ0FBQyxTQUFILENBQWEsd0JBQWIsRUFBdUMsVUFBVSxLQUFWLEVBQWlCO0FBQ3BELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsNEJBQUQsQ0FBRCxDQUFnQyxHQUFoQyxDQUFvQyxrQkFBcEMsRUFBd0QsTUFBeEQ7QUFDSCxHQUZEO0FBR0gsQ0FKRDtBQUtBLEVBQUUsQ0FBQyxTQUFILENBQWEsd0JBQWIsRUFBdUMsVUFBVSxLQUFWLEVBQWlCO0FBQ3BELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3QixHQUF4QixDQUE0QixrQkFBNUIsRUFBZ0QsTUFBaEQ7QUFDSCxHQUZEO0FBR0gsQ0FKRCxFLENBTUE7O0FBQ0EsRUFBRSxDQUFDLFNBQUgsQ0FBYSx1QkFBYixFQUFzQyxVQUFVLEtBQVYsRUFBaUI7QUFDbkQsRUFBQSxLQUFLLENBQUMsSUFBTixDQUFXLFVBQVUsTUFBVixFQUFrQjtBQUN6QixJQUFBLENBQUMsQ0FBQyxnREFBRCxDQUFELENBQW9ELEdBQXBELENBQXdELE9BQXhELEVBQWlFLE1BQWpFO0FBQ0gsR0FGRDtBQUdILENBSkQ7QUFLQSxFQUFFLENBQUMsU0FBSCxDQUFhLG1CQUFiLEVBQWtDLFVBQVUsS0FBVixFQUFpQjtBQUMvQyxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLDBCQUFELENBQUQsQ0FBOEIsR0FBOUIsQ0FBa0MsT0FBbEMsRUFBMkMsTUFBM0M7QUFDSCxHQUZEO0FBR0gsQ0FKRDtBQUtBLEVBQUUsQ0FBQyxTQUFILENBQWEsdUJBQWIsRUFBc0MsVUFBVSxLQUFWLEVBQWlCO0FBQ25ELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsNkNBQUQsQ0FBRCxDQUFpRCxHQUFqRCxDQUFxRCxPQUFyRCxFQUE4RCxNQUE5RDtBQUNILEdBRkQ7QUFHSCxDQUpEO0FBS0EsRUFBRSxDQUFDLFNBQUgsQ0FBYSx1QkFBYixFQUFzQyxVQUFVLEtBQVYsRUFBaUI7QUFDbkQsRUFBQSxLQUFLLENBQUMsSUFBTixDQUFXLFVBQVUsTUFBVixFQUFrQjtBQUN6QixJQUFBLENBQUMsQ0FBQyxzQ0FBRCxDQUFELENBQTBDLEdBQTFDLENBQThDLE9BQTlDLEVBQXVELE1BQXZEO0FBQ0gsR0FGRDtBQUdILENBSkQ7QUFLQSxFQUFFLENBQUMsU0FBSCxDQUFhLHVCQUFiLEVBQXNDLFVBQVUsS0FBVixFQUFpQjtBQUNuRCxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLHdCQUFELENBQUQsQ0FBNEIsR0FBNUIsQ0FBZ0MsT0FBaEMsRUFBeUMsTUFBekM7QUFDSCxHQUZEO0FBR0gsQ0FKRDtBQUtBLEVBQUUsQ0FBQyxTQUFILENBQWEseUJBQWIsRUFBd0MsVUFBVSxLQUFWLEVBQWlCO0FBQ3JELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsa0NBQUQsQ0FBRCxDQUFzQyxHQUF0QyxDQUEwQyxPQUExQyxFQUFtRCxNQUFuRDtBQUNILEdBRkQ7QUFHSCxDQUpELEUsQ0FNQTs7QUFDQSxFQUFFLENBQUMsU0FBSCxDQUFhLGlCQUFiLEVBQWdDLFVBQVUsS0FBVixFQUFpQjtBQUM3QyxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0IsR0FBdEIsQ0FBMEIsa0JBQTFCLEVBQThDLE1BQTlDO0FBQ0gsR0FGRDtBQUdILENBSkQ7QUFLQSxFQUFFLENBQUMsU0FBSCxDQUFhLHVCQUFiLEVBQXNDLFVBQVUsS0FBVixFQUFpQjtBQUNuRCxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLHdCQUFELENBQUQsQ0FBNEIsR0FBNUIsQ0FBZ0Msa0JBQWhDLEVBQW9ELE1BQXBEO0FBQ0gsR0FGRDtBQUdILENBSkQ7QUFLQSxFQUFFLENBQUMsU0FBSCxDQUFhLG1CQUFiLEVBQWtDLFVBQVUsS0FBVixFQUFpQjtBQUMvQyxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0IsR0FBeEIsQ0FBNEIsT0FBNUIsRUFBcUMsTUFBckM7QUFDSCxHQUZEO0FBR0gsQ0FKRDtBQUtBLEVBQUUsQ0FBQyxTQUFILENBQWEsZUFBYixFQUE4QixVQUFVLEtBQVYsRUFBaUI7QUFDM0MsRUFBQSxLQUFLLENBQUMsSUFBTixDQUFXLFVBQVUsTUFBVixFQUFrQjtBQUN6QixJQUFBLENBQUMsQ0FBQyxtQkFBRCxDQUFELENBQXVCLEdBQXZCLENBQTJCLE9BQTNCLEVBQW9DLE1BQXBDO0FBQ0gsR0FGRDtBQUdILENBSkQ7QUFLQSxFQUFFLENBQUMsU0FBSCxDQUFhLHFCQUFiLEVBQW9DLFVBQVUsS0FBVixFQUFpQjtBQUNqRCxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLCtCQUFELENBQUQsQ0FBbUMsR0FBbkMsQ0FBdUMsT0FBdkMsRUFBZ0QsTUFBaEQ7QUFDSCxHQUZEO0FBR0gsQ0FKRDtBQU1BOzs7OztBQUtBOztBQUNBLEVBQUUsQ0FBQyxTQUFILENBQWEsYUFBYixFQUE0QixVQUFVLEtBQVYsRUFBaUI7QUFDekMsRUFBQSxLQUFLLENBQUMsSUFBTixDQUFXLFVBQVUsTUFBVixFQUFrQjtBQUN6QixJQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCLEdBQXhCLENBQTRCLGFBQTVCLEVBQTJDLE1BQTNDO0FBQ0gsR0FGRDtBQUdILENBSkQsRSxDQUtBOztBQUNBLEVBQUUsQ0FBQyxTQUFILENBQWEsb0JBQWIsRUFBbUMsVUFBVSxLQUFWLEVBQWlCO0FBQ2hELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3QixHQUF4QixDQUE0QixhQUE1QixFQUEyQyxNQUEzQztBQUNILEdBRkQ7QUFHSCxDQUpELEUsQ0FLQTs7QUFDQSxFQUFFLENBQUMsU0FBSCxDQUFhLHFCQUFiLEVBQW9DLFVBQVUsS0FBVixFQUFpQjtBQUNqRCxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0IsR0FBeEIsQ0FBNEIsWUFBNUIsRUFBMEMsTUFBMUM7QUFDSCxHQUZEO0FBR0gsQ0FKRCxFLENBS0E7O0FBQ0EsRUFBRSxDQUFDLFNBQUgsQ0FBYSxpQkFBYixFQUFnQyxVQUFVLEtBQVYsRUFBaUI7QUFDN0MsRUFBQSxLQUFLLENBQUMsSUFBTixDQUFXLFVBQVUsTUFBVixFQUFrQjtBQUN6QixJQUFBLENBQUMsQ0FBQywwQ0FBRCxDQUFELENBQThDLEdBQTlDLENBQWtELGFBQWxELEVBQWlFLE1BQWpFO0FBQ0gsR0FGRDtBQUdILENBSkQsRSxDQUtBOztBQUNBLEVBQUUsQ0FBQyxTQUFILENBQWEsd0JBQWIsRUFBdUMsVUFBVSxLQUFWLEVBQWlCO0FBQ3BELEVBQUEsS0FBSyxDQUFDLElBQU4sQ0FBVyxVQUFVLE1BQVYsRUFBa0I7QUFDekIsSUFBQSxDQUFDLENBQUMsMENBQUQsQ0FBRCxDQUE4QyxHQUE5QyxDQUFrRCxhQUFsRCxFQUFpRSxNQUFqRTtBQUNILEdBRkQ7QUFHSCxDQUpELEUsQ0FLQTs7QUFDQSxFQUFFLENBQUMsU0FBSCxDQUFhLHlCQUFiLEVBQXdDLFVBQVUsS0FBVixFQUFpQjtBQUNyRCxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLFFBQUksTUFBSixFQUFZO0FBQ1IsTUFBQSxDQUFDLENBQUMsMENBQUQsQ0FBRCxDQUE4QyxHQUE5QyxDQUFrRCxZQUFsRCxFQUFnRSxRQUFoRTtBQUNILEtBRkQsTUFFTztBQUNILE1BQUEsQ0FBQyxDQUFDLDBDQUFELENBQUQsQ0FBOEMsR0FBOUMsQ0FBa0QsWUFBbEQsRUFBZ0UsUUFBaEU7QUFDSDtBQUNKLEdBTkQ7QUFPSCxDQVJEO0FBVUE7Ozs7OztBQUtBLEVBQUUsQ0FBQyxTQUFILENBQWEsY0FBYixFQUE2QixVQUFVLEtBQVYsRUFBaUI7QUFDMUMsRUFBQSxLQUFLLENBQUMsSUFBTixDQUFXLFVBQVUsTUFBVixFQUFrQjtBQUN6QixJQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0IsR0FBbEIsQ0FBc0IsUUFBdEIsRUFBZ0MsTUFBTSxHQUFDLElBQXZDO0FBQ0gsR0FGRDtBQUdILENBSkQ7QUFLQSxFQUFFLENBQUMsU0FBSCxDQUFhLG9CQUFiLEVBQW1DLFVBQVUsS0FBVixFQUFpQjtBQUNoRCxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLG1DQUFELENBQUQsQ0FBdUMsR0FBdkMsQ0FBMkMsUUFBM0MsRUFBcUQsTUFBTSxHQUFDLEdBQTVEO0FBQ0gsR0FGRDtBQUdILENBSkQ7QUFLQSxFQUFFLENBQUMsU0FBSCxDQUFhLG9CQUFiLEVBQW1DLFVBQVUsS0FBVixFQUFpQjtBQUNoRCxFQUFBLEtBQUssQ0FBQyxJQUFOLENBQVcsVUFBVSxNQUFWLEVBQWtCO0FBQ3pCLElBQUEsQ0FBQyxDQUFDLGdDQUFELENBQUQsQ0FBb0MsV0FBcEMsQ0FBZ0Qsb0dBQWhEO0FBQ0EsSUFBQSxDQUFDLENBQUMsZ0NBQUQsQ0FBRCxDQUFvQyxRQUFwQyxDQUE2QyxNQUE3QztBQUNILEdBSEQ7QUFJSCxDQUxEIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiLyoqXHJcbiAqIFRoaXMgZmlsZSBhZGRzIHNvbWUgTElWRSB0byB0aGUgVGhlbWUgQ3VzdG9taXplciBsaXZlIHByZXZpZXcuIFRvIGxldmVyYWdlXHJcbiAqIHRoaXMsIHNldCB5b3VyIGN1c3RvbSBzZXR0aW5ncyB0byAncG9zdE1lc3NhZ2UnIGFuZCB0aGVuIGFkZCB5b3VyIGhhbmRsaW5nXHJcbiAqIGhlcmUuIFlvdXIgamF2YXNjcmlwdCBzaG91bGQgZ3JhYiBzZXR0aW5ncyBmcm9tIGN1c3RvbWl6ZXIgY29udHJvbHMsIGFuZCBcclxuICogdGhlbiBtYWtlIGFueSBuZWNlc3NhcnkgY2hhbmdlcyB0byB0aGUgcGFnZSB1c2luZyBqUXVlcnkuXHJcbiovXHJcblxyXG5cclxuLy8gTWFpbiBDb2xvcnNcclxud3AuY3VzdG9taXplKCdjb2xvcnNfX21haW5fYm9keV9iZycsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmNvbG9yc19fYm9keV9iZywgYm9keScpLmNzcygnYmFja2dyb3VuZC1jb2xvcicsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbndwLmN1c3RvbWl6ZSgnY29sb3JzX19tYWluX2hlYWRlcl9iZycsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmNvbG9yc19faGVhZGVyX2JnLCBoZWFkZXInKS5jc3MoJ2JhY2tncm91bmQtY29sb3InLCBuZXd2YWwpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG53cC5jdXN0b21pemUoJ2NvbG9yc19fbWFpbl9mb290ZXJfYmcnLCBmdW5jdGlvbiAodmFsdWUpIHtcclxuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKG5ld3ZhbCkge1xyXG4gICAgICAgICQoJy5jb2xvcnNfX2Zvb3Rlcl9iZywgZm9vdGVyJykuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgbmV3dmFsKTtcclxuICAgIH0pO1xyXG59KTtcclxud3AuY3VzdG9taXplKCdjb2xvcnNfX21haW5fYWNjZW50X2JnJywgZnVuY3Rpb24gKHZhbHVlKSB7XHJcbiAgICB2YWx1ZS5iaW5kKGZ1bmN0aW9uIChuZXd2YWwpIHtcclxuICAgICAgICAkKCcuY29sb3JzX19hY2NlbnRfYmcnKS5jc3MoJ2JhY2tncm91bmQtY29sb3InLCBuZXd2YWwpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG5cclxuLy8gVGV4dCAvIFR5cGUgQ29sb3JzXHJcbndwLmN1c3RvbWl6ZSgnY29sb3JzX190eXBlX2hlYWRpbmdzJywgZnVuY3Rpb24gKHZhbHVlKSB7XHJcbiAgICB2YWx1ZS5iaW5kKGZ1bmN0aW9uIChuZXd2YWwpIHtcclxuICAgICAgICAkKCcuY29sb3JzX190eXBlX2hlYWRpbmdzLCBoMSwgaDIsIGgzLCBoNCwgaDUsIGg2JykuY3NzKCdjb2xvcicsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbndwLmN1c3RvbWl6ZSgnY29sb3JzX190eXBlX2JvZHknLCBmdW5jdGlvbiAodmFsdWUpIHtcclxuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKG5ld3ZhbCkge1xyXG4gICAgICAgICQoJy5jb2xvcnNfX3R5cGVfYm9keSwgYm9keScpLmNzcygnY29sb3InLCBuZXd2YWwpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG53cC5jdXN0b21pemUoJ2NvbG9yc19fdHlwZV9uYXZsaW5rcycsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmNvbG9yc19fdHlwZV9uYXZsaW5rcywgLm5hdmxpbmtzLWl0ZW0tbGluaycpLmNzcygnY29sb3InLCBuZXd2YWwpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG53cC5jdXN0b21pemUoJ2NvbG9yc19fdHlwZV9oZXJvdGV4dCcsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmNvbG9yc19fdHlwZV9oZXJvdGV4dCwgc2VjdGlvbi5oZXJvJykuY3NzKCdjb2xvcicsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbndwLmN1c3RvbWl6ZSgnY29sb3JzX190eXBlX2RpdmlkZXJzJywgZnVuY3Rpb24gKHZhbHVlKSB7XHJcbiAgICB2YWx1ZS5iaW5kKGZ1bmN0aW9uIChuZXd2YWwpIHtcclxuICAgICAgICAkKCcuY29sb3JzX190eXBlX2RpdmlkZXJzJykuY3NzKCdjb2xvcicsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbndwLmN1c3RvbWl6ZSgnY29sb3JzX190eXBlX2Zvb3RlcnRleHQnLCBmdW5jdGlvbiAodmFsdWUpIHtcclxuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKG5ld3ZhbCkge1xyXG4gICAgICAgICQoJy5jb2xvcnNfX3R5cGVfZm9vdGVydGV4dCwgZm9vdGVyJykuY3NzKCdjb2xvcicsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcblxyXG4vLyBMaW5rIENvbG9yc1xyXG53cC5jdXN0b21pemUoJ2xpbmtzX2J1dHRvbl9iZycsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmxpbmtzX2J1dHRvbl9iZycpLmNzcygnYmFja2dyb3VuZC1jb2xvcicsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbndwLmN1c3RvbWl6ZSgnbGlua3NfYnV0dG9uX2JnX2hvdmVyJywgZnVuY3Rpb24gKHZhbHVlKSB7XHJcbiAgICB2YWx1ZS5iaW5kKGZ1bmN0aW9uIChuZXd2YWwpIHtcclxuICAgICAgICAkKCcubGlua3NfYnV0dG9uX2JnOmhvdmVyJykuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgbmV3dmFsKTtcclxuICAgIH0pO1xyXG59KTtcclxud3AuY3VzdG9taXplKCdsaW5rc19idXR0b25fdGV4dCcsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmxpbmtzX2J1dHRvbl90ZXh0JykuY3NzKCdjb2xvcicsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbndwLmN1c3RvbWl6ZSgnbGlua3NfYW55bGluaycsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmxpbmtzX2FueWxpbmssIGEnKS5jc3MoJ2NvbG9yJywgbmV3dmFsKTtcclxuICAgIH0pO1xyXG59KTtcclxud3AuY3VzdG9taXplKCdsaW5rc19hbnlsaW5rX2hvdmVyJywgZnVuY3Rpb24gKHZhbHVlKSB7XHJcbiAgICB2YWx1ZS5iaW5kKGZ1bmN0aW9uIChuZXd2YWwpIHtcclxuICAgICAgICAkKCcubGlua3NfYW55bGlua19ob3ZlciwgYTpob3ZlcicpLmNzcygnY29sb3InLCBuZXd2YWwpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG5cclxuLyoqXHJcbiAqIFxyXG4gKiAgICAgIEZPTlRTXHJcbiAqIFxyXG4qL1xyXG4vLyBmYW1pbHlcclxud3AuY3VzdG9taXplKCdmb250c19fYm9keScsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmZvbnRzX19ib2R5LCBib2R5JykuY3NzKCdmb250LWZhbWlseScsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbi8vIHdlaWdodFxyXG53cC5jdXN0b21pemUoJ2ZvbnRzX19ib2R5X3dlaWdodCcsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmZvbnRzX19ib2R5LCBib2R5JykuY3NzKCdmb250LXdlaWdodCcsIG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7XHJcbi8vIGl0YWxpY3Ncclxud3AuY3VzdG9taXplKCdmb250c19fYm9keV9pdGFsaWNzJywgZnVuY3Rpb24gKHZhbHVlKSB7XHJcbiAgICB2YWx1ZS5iaW5kKGZ1bmN0aW9uIChuZXd2YWwpIHtcclxuICAgICAgICAkKCcuZm9udHNfX2JvZHksIGJvZHknKS5jc3MoJ2ZvbnQtc3R5bGUnLCBuZXd2YWwpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG4vLyBmYW1pbHlcclxud3AuY3VzdG9taXplKCdmb250c19faGVhZGluZ3MnLCBmdW5jdGlvbiAodmFsdWUpIHtcclxuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKG5ld3ZhbCkge1xyXG4gICAgICAgICQoJy5mb250c19faGVhZGluZ3MsIGgxLCBoMiwgaDMsIGg0LCBoNSwgaDYnKS5jc3MoJ2ZvbnQtZmFtaWx5JywgbmV3dmFsKTtcclxuICAgIH0pO1xyXG59KTtcclxuLy8gd2VpZ2h0XHJcbndwLmN1c3RvbWl6ZSgnZm9udHNfX2hlYWRpbmdzX3dlaWdodCcsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnLmZvbnRzX19oZWFkaW5ncywgaDEsIGgyLCBoMywgaDQsIGg1LCBoNicpLmNzcygnZm9udC13ZWlnaHQnLCBuZXd2YWwpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG4vLyBpdGFsaWNzXHJcbndwLmN1c3RvbWl6ZSgnZm9udHNfX2hlYWRpbmdzX2l0YWxpY3MnLCBmdW5jdGlvbiAodmFsdWUpIHtcclxuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKG5ld3ZhbCkge1xyXG4gICAgICAgIGlmKCBuZXd2YWwgKXtcclxuICAgICAgICAgICAgJCgnLmZvbnRzX19oZWFkaW5ncywgaDEsIGgyLCBoMywgaDQsIGg1LCBoNicpLmNzcygnZm9udC1zdHlsZScsICdpdGFsaWMnKTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAkKCcuZm9udHNfX2hlYWRpbmdzLCBoMSwgaDIsIGgzLCBoNCwgaDUsIGg2JykuY3NzKCdmb250LXN0eWxlJywgJ25vcm1hbCcpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTtcclxuXHJcbi8qKlxyXG4gKiBcclxuICogICAgICBIRVJPXHJcbiAqIFxyXG4gKi9cclxud3AuY3VzdG9taXplKCdoZXJvX19oZWlnaHQnLCBmdW5jdGlvbiAodmFsdWUpIHtcclxuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKG5ld3ZhbCkge1xyXG4gICAgICAgICQoJ3NlY3Rpb24uaGVybycpLmNzcygnaGVpZ2h0JywgbmV3dmFsKyd2aCcpO1xyXG4gICAgfSk7XHJcbn0pO1xyXG53cC5jdXN0b21pemUoJ2hlcm9fX2ltYWdlX2hlaWdodCcsIGZ1bmN0aW9uICh2YWx1ZSkge1xyXG4gICAgdmFsdWUuYmluZChmdW5jdGlvbiAobmV3dmFsKSB7XHJcbiAgICAgICAgJCgnc2VjdGlvbi5oZXJvIC5oZXJvX2ZvcmVncm91bmQgaW1nJykuY3NzKCdoZWlnaHQnLCBuZXd2YWwrJyUnKTtcclxuICAgIH0pO1xyXG59KTtcclxud3AuY3VzdG9taXplKCdoZXJvX19mZ19wbGFjZW1lbnQnLCBmdW5jdGlvbiAodmFsdWUpIHtcclxuICAgIHZhbHVlLmJpbmQoZnVuY3Rpb24gKG5ld3ZhbCkge1xyXG4gICAgICAgICQoJ3NlY3Rpb24uaGVybyAuaGVyb19mb3JlZ3JvdW5kICcpLnJlbW92ZUNsYXNzKCd0b3BsZWZ0IHRvcGNlbnRlciB0b3ByaWdodCBtaWRkbGVsZWZ0IG1pZGRsZWNlbnRlciBtaWRkbGVyaWdodCBib3R0b21sZWZ0IGJvdHRvbWNlbnRlciBib3R0b21yaWdodCcpO1xyXG4gICAgICAgICQoJ3NlY3Rpb24uaGVybyAuaGVyb19mb3JlZ3JvdW5kICcpLmFkZENsYXNzKG5ld3ZhbCk7XHJcbiAgICB9KTtcclxufSk7Il19
