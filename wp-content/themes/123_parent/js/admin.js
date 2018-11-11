var Admin = {};

;(function ( $, Admin, window, document, undefined ) {

	$(document).ready(function(){

		Admin.SiteSetup = {
			sections : $('#acf-group_sitesetup_intro, #acf-group_sitesetup_1, #acf-group_sitesetup_2, #acf-group_sitesetup_3, #acf-group_sitesetup_4'),
			pagination : $('#setup-pagination'),
			nextprev : $('#setup-nextprev span'),
			_init : function(){
				Admin.SiteSetup.sections.addClass('setup-section--hidden');
				Admin.SiteSetup.sections.first().removeClass('setup-section--hidden');
				Admin.SiteSetup._doBuildNav();
				Admin.SiteSetup.pagination.on('click', 'span', Admin.SiteSetup._clickedNavhandler);
				Admin.SiteSetup.nextprev.on('click', Admin.SiteSetup._doNextPrev);
			},
			_doNextPrev : function(e){
				var nextprev = $(e.target).data('name');
				var currentPage = Admin.SiteSetup.sections.not('.setup-section--hidden');

				var activeButton = Admin.SiteSetup.pagination.find('span.active');


				activeButton.removeClass('active');

				if( nextprev == 'prev' && currentPage[0] != Admin.SiteSetup.sections[0] ){
					currentPage.addClass('setup-section--hidden');
					currentPage.prev().removeClass('setup-section--hidden');
					activeButton.prev().addClass('active');
				}
				if( nextprev == 'next' && currentPage[0] != Admin.SiteSetup.sections.last() ){
					currentPage.addClass('setup-section--hidden');
					currentPage.next().removeClass('setup-section--hidden');
					activeButton.next().addClass('active');
				}
			},
			_doBuildNav : function(){

				Admin.SiteSetup.sections.each(function(index){

					var active = 'active';
					if( index === 0 ){
						var button = '<span id="'+index+'" class="'+active+'">1. Theme</span>';
					}
					if( index === 1 ){
						var button = '<span id="'+index+'" class="">2. Company Info</span>';
					}
					if( index === 2 ){
						var button = '<span id="'+index+'" class="">3. Media</span>';
					}
					if( index === 3 ){
						var button = '<span id="'+index+'" class="">4. Verify Content</span>';
					}
					if( index === 4 ){
						var button = '<span id="'+index+'" class="">5. Finalize</span>';
					}
					
					Admin.SiteSetup.pagination.append(button);

				});
			},
			_clickedNavhandler : function(e){
				// wipe active status
				Admin.SiteSetup.pagination.find('span').removeClass('active');
				// add active status
				$(this).addClass('active');
				// determine
				var index = $(this).index();
				Admin.SiteSetup.sections.addClass('setup-section--hidden');

				$(Admin.SiteSetup.sections[index]).removeClass('setup-section--hidden');

			}

		}
		Admin.SiteSetup._init();







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
