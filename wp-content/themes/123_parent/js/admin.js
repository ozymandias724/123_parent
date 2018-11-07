var Admin = {};

;(function ( $, Admin, window, document, undefined ) {

	$(document).ready(function(){


		Admin.SiteSetup = {

			pagination : $('#setup-pagination .dashicons'),

			sections : $('#acf-group_sitesetup_1, #acf-group_sitesetup_2, #acf-group_sitesetup_3, #acf-group_sitesetup_4, #acf-group_sitesetup_5'),

			_init : function(){


				// hide all the sections
				Admin.SiteSetup.sections.addClass('setup-section--hidden');
				// add the visible class to the first section
				Admin.SiteSetup.sections.first().removeClass('setup-section--hidden');


				Admin.SiteSetup.pagination.on('click', Admin.SiteSetup._doPageHandler);

			},
			_doPageHandler : function(e){

				if( $(e.target).hasClass('dashicons-arrow-right-alt') ){
						$hideSection = Admin.SiteSetup.sections.not('.setup-section--hidden');
						$revealSection = Admin.SiteSetup.sections.not('.setup-section--hidden').next();
						$hideSection.addClass('setup-section--hidden');
						$revealSection.removeClass('setup-section--hidden');
				} else {

						$hideSection = Admin.SiteSetup.sections.not('.setup-section--hidden');
						$revealSection = Admin.SiteSetup.sections.not('.setup-section--hidden').prev();
						$hideSection.addClass('setup-section--hidden');
					}
				}
			}
		}
		Admin.SiteSetup._init();




		// Admin.SiteSetup = {

		// 	form : $('#sitesetup'),
		// 	formPages : $('#sitesetup section'),
		// 	formPagination : $('#form-pagination span'),
		// 	submitButton : $('#sitesetup-submit'),

		// 	_init : function(){
		// 		if( Admin.SiteSetup.form.length > 0 ){
		// 			$(window).on('load', Admin.SiteSetup._buildFormPages);
		// 			Admin.SiteSetup.formPagination.on('click', Admin.SiteSetup._changePageHandler);
		// 			Admin.SiteSetup.form.on('submit', Admin.SiteSetup._submitHandler);
		// 		}
		// 	},
		// 	_changePageHandler : function(e){
		// 		// Clicked Next:
		// 		if( $(this).hasClass('dashicons-arrow-right-alt') ){
		// 			var current = Admin.SiteSetup.formPages.not('.js__sections--hidden');
		// 			if( current.nextSibling !== null ){
		// 				$(current).addClass('js__sections--hidden');
		// 				$(current).next().removeClass('js__sections--hidden');
		// 			}
		// 		}
		// 		else if( $(this).hasClass('dashicons-arrow-left-alt') ){
		// 			var current = Admin.SiteSetup.formPages.not('.js__sections--hidden');
		// 			if( current.previousSibling !== null ){
		// 				$(current).addClass('js__sections--hidden');
		// 				$(current).prev().removeClass('js__sections--hidden');
		// 			}
		// 		}
		// 	},
		// 	_buildFormPages : function(e){
		// 		Admin.SiteSetup.formPages.each(function(){
		// 			$(this).addClass('js__sections--hidden');
		// 		});
		// 		Admin.SiteSetup.formPages.first().removeClass('js__sections--hidden');
		// 	},
		// 	_submitHandler : function(e){
		// 		e.preventDefault();
		// 		$.post( ajaxurl , {
		// 			// action hook in class.MultiSiteSetup.php
		// 			action : 'do_site_setup',
		// 			// Form Fields - To Translate to ACF Fields
		// 			logo : Admin.SiteSetup.form.find('input[name=logo]').val(),
		// 			addressone : Admin.SiteSetup.form.find('input[name=addressone]').val(),
		// 			email : Admin.SiteSetup.form.find('input[name=email]').val(),

		// 		}, Admin.SiteSetup._responseHandler);
		// 	},
		// 	_responseHandler : function(response){
		// 		// console.log(JSON.parse(response));
		// 		console.log(response);

		// 	}

		// }

		// Admin.SiteSetup._init();






		Admin.Training = {
			_init: function(){
				if( $('body').is('.toplevel_page_general-settings') ){
					$('#side-sortables').append(
						'<style>' +
							'@media only screen{' +
								'.training-ad-desktop{ display: none; width: 100%;}' +
								'.training-ad-mobile{ display: block; width: 100%;}' +
							'}' +
							'@media only screen and (min-width: 851px){' +
								'.training-ad-desktop{ display: block;}' +
								'.training-ad-mobile{ display: none;}' +
							'}' +
						'</style>' +
						'<div class="postbox">' +
							'<a target="_blank" href="http://www.123websites.com/training">' +
								'<img class="training-ad-desktop" src="http://123websites.com/images/training-ad.png"/>' +
								'<img class="training-ad-mobile" src="http://123websites.com/images/training-ad-dashboard.png"/>' +
							'</a>' +
						'</div>'
					);
				}
				$('html').css('overflow-y', 'scroll');
			},
		};

		Admin.Training._init();

	});

})( jQuery, Admin, window, document );
