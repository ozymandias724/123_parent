var Admin = {};

;(function ( $, Admin, window, document, undefined ) {

	$(document).ready(function(){

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
