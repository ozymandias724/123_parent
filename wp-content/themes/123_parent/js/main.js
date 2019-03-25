var Theme = {};
var Headers = {};
;(function ( $, Theme, Headers, window, document, undefined ) {
	$(document).ready(function(){


        Headers.Mobile = {
			
			_init : function(){
				Headers.Mobile.Sidebar._init();
			},

			Sidebar : {

				//Mobile header sidebar menu
				sidebar : $(".mobile_header_sidebar_menu_1"),
				//Mobile header sidebar and mobile header first div element
				outside : $(".mobile_header_sidebar_menu_1, .mobileheader > div:first-of-type"),
				//Link which is the parent of the hamburger icons (spans)
				toggle : $("header.mobileheader > div:first-of-type > a"),

				_init : function(){
					
					//When hamburger icon spans link is clicked
					Headers.Mobile.Sidebar.toggle.on("click", Headers.Mobile.Sidebar._clickHandler);
					Headers.Mobile.Sidebar.outside.on("click", Headers.Mobile.Sidebar._outside_click_close_sidebar);
					Headers.Mobile.Sidebar.sidebar.on("blur", Headers.Mobile.Sidebar._close_sidebar);

					//On resize of browser
					window.addEventListener('resize', function(){
						//Remove mobile nav sidebar menu width
						Headers.Mobile.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
						//Remove mobile nav hamburger icon class
						Headers.Mobile.Sidebar.toggle.removeClass("mobile_nav_sidebar_menu_1");
					});

				},
				_clickHandler : function(){
					//If the hamburger icon spans link does not have class of mobile_nav_sidebar_menu_1
					if(!Headers.Mobile.Sidebar.toggle.hasClass("mobile_nav_sidebar_menu_1")){
						//Open sidebar
						Headers.Mobile.Sidebar._open_sidebar();
					}else{
						//Close sidebar
						Headers.Mobile.Sidebar._close_sidebar();
					}
				},
				_outside_click_close_sidebar : function(e){
					if(e.target === this){
						Headers.Mobile.Sidebar._close_sidebar();
					}
				},
				_open_sidebar : function(){
					//Hamburger icon link add class
					Headers.Mobile.Sidebar.toggle.addClass("mobile_nav_sidebar_menu_1");
					//Make the sidebar menu cover the whole page
					Headers.Mobile.Sidebar.sidebar.addClass("mobile_sidebar_cover_all");
				},
				_close_sidebar : function(){
					//Hamburger icon link remove class
					Headers.Mobile.Sidebar.toggle.removeClass("mobile_nav_sidebar_menu_1");
					//Make the sidebar menu to not cover the whole page
					Headers.Mobile.Sidebar.sidebar.removeClass("mobile_sidebar_cover_all");
				}
			}
		}
		Headers.Mobile._init();

        Headers.Desktop = {
			_init : function(){
				Headers.Desktop.Address_Link._init();
				Headers.Desktop.One._init();
				Headers.Desktop.Eight._init();
				Headers.Desktop.Ten._init();
				
			},
			
			Address_Link : {
				address_link : $(".google-search-address"),
				address_text : $(".google-search-address").text(),

				_init : function(){
					event.preventDefault();
					window.open('https://google.com/search?q=' + Headers.Desktop.Address_Link.address_text);
				}

			},
            One : {

                header : $("header.header#opt_header_one"),
				div_two : $("header#opt_header_one > div:nth-of-type(2)"),

				_init : function(){
					
					if($(Headers.Desktop.One.header).length){

						Headers.Desktop.One.div_two_offset_top = $("header#opt_header_one > div:nth-of-type(2)").offset().top;
						
						window.onscroll = function(){

							Headers.Desktop.One._sticky_header(); 

						}

						Headers.Desktop.One._sticky_header();

					}
				},
				_sticky_header : function(){
					
					if(window.pageYOffset >=  Headers.Desktop.One.div_two_offset_top){

						Headers.Desktop.One.div_two.addClass("sticky");

					}else{

						Headers.Desktop.One.div_two.removeClass("sticky");

					}
					
				},
                
            },
            Eight : {

				header : $("header.header#opt_header_eight"),

				_init : function(){

					if($(Headers.Desktop.Eight.header).length) {

						Headers.Desktop.Eight.offset_top = Headers.Desktop.Eight.header.offset().top;

						window.onscroll = function(){
							Headers.Desktop.Eight._sticky_header();
						}
						Headers.Desktop.Eight._sticky_header();
						
					}

				},
				_sticky_header : function(){ 

					if(window.pageYOffset >= Headers.Desktop.Eight.offset_top){
						Headers.Desktop.Eight.header.addClass("sticky");
					}else{
						Headers.Desktop.Eight.header.removeClass("sticky");
					}

				},
				
			}, 
			Ten : {
				header : $("header#opt_header_ten"),
				hamburger_icon : $("header#opt_header_ten > div:first-of-type > div > div:first-of-type > a"),
				sidebar : $(".header_sidebar_menu_1"), 
				outside : $(".header_sidebar_menu_1, #opt_header_ten > div:first-of-type div, #opt_header_ten ul, #opt_header_ten"),

				_init : function(){
					
					Headers.Desktop.Ten.hamburger_icon.on("click", Headers.Desktop.Ten._hamburger_icon_click);

					Headers.Desktop.Ten.outside.on("click", Headers.Desktop.Ten._outside_click);
	
					Headers.Desktop.Ten.sidebar.on("blur", Headers.Desktop.Ten._close_sidebar);

					//On browser resize
					window.addEventListener('resize', function(){
						Headers.Desktop.Ten._close_sidebar();
					});    

				},

				_hamburger_icon_click : function(){
					//If header 10 hamburger icon link has class of ...
					if(!Headers.Desktop.Ten.hamburger_icon.hasClass("header_10_hamburger_icon_changed")){
						Headers.Desktop.Ten._open_sidebar();
					}else{
						Headers.Desktop.Ten._close_sidebar();
					}					
				},
				_outside_click : function(e){
					if(e.target === this){
						Headers.Desktop.Ten._close_sidebar();
					}
				},
				_close_sidebar : function(){
					//Add hamburger icon link class
					Headers.Desktop.Ten.hamburger_icon.removeClass("header_10_hamburger_icon_changed");

					//Open sidebar navigational menu
					Headers.Desktop.Ten.sidebar.removeClass("header_sidebar_cover_all");
				},
				_open_sidebar : function(){
					//Remove hamburger icon link class
					Headers.Desktop.Ten.hamburger_icon.addClass("header_10_hamburger_icon_changed");

					//Close sidebar navigational menu
					Headers.Desktop.Ten.sidebar.addClass("header_sidebar_cover_all");
				}

			}
            
		}
		Headers.Desktop._init();

		Hero = {
			_init : function(){
				Hero.Padding._init();
				Hero.Slider._init();
			},

			Padding : {

				header_id : $("header").attr("id"),

				header_height : $("header").height(),

				mobile_header_height : $(".mobileheader").height(),

				main : $(".mobileheader").next(),

				_init : function(){
					
					//On init, if browser width is greater than 1280
					if(window.innerWidth >= 1280){

						Hero.Padding._header_function();

					}else{

						Hero.Padding._mobile_header_function();

					}

					//On resize, if browser width is greater than 1280 
					window.addEventListener('resize', function(){

						if(window.innerWidth >= 1280){

							Hero.Padding._header_function();

						}else{

							Hero.Padding._mobile_header_function();

						}
					});
					
				},
				_header_function : function(){

					//Get header position value
					Hero.Padding.header_position = $("header").css("position");

					//If header has a position of fixed and not header 4
					if(Hero.Padding.header_position === "fixed" && Hero.Padding.header_id !== "opt_header_four"){
						
						Hero.Padding.header_height = $("header").height();

						Hero.Padding.main.css("padding-top", Hero.Padding.header_height);

					//If header has a position of fixed and is header 4
					}else if(Hero.Padding.header_position === "fixed" && Hero.Padding.header_id === "opt_header_four"){
						
						Hero.Padding.header_first_div_height = $("header#opt_header_four > div").height();

						Hero.Padding.main.css("padding-top", Hero.Padding.header_first_div_height);

					}else{
						//Do not adding padding-top to hero
						Hero.Padding.main.css("padding-top", "0");
					}

				},
				_mobile_header_function : function(){
					Hero.Padding.mobiler_header_height = $(".mobileheader").height();
					Hero.Padding.main.css("padding-top", Hero.Padding.mobile_header_height);
				}

			},

			Slider : {
				_init : function(){

				},
			},
		}
		Hero._init();

		Theme.Headers = {
			tint : $(".header-tint"),
			estimate : $(".estimate-toggle, .topbanner-quickquote, .site__button-quote"),
			estimate_popup : $(".estimate"),
			estimate_close : $(".estimate.popupcontainer, .estimate-content-times.popupcontainer-times"),

			_init : function(){
				$(Headers.Mobile.estimate).on("click", Theme.Headers._click_handler); 

				$(Headers.Mobile.estimate_close).on("click",Theme.Headers._close_popup);
			},

			_click_handler : function(event){
				event.preventDefault();
				Theme.Headers.estimate_popup.fadeIn(250); 
			},
			_close_popup : function(event){
				if( $(event.target).hasClass("estimate") || 
					$(event.target).hasClass("estimate-content-times") || 
					$(event.target).hasClass("topbanner-quickquote") ||
					$(event.target).hasClass("site__button-quote") 
				){ 
					event.preventDefault();
					Theme.Headers.estimate_popup.fadeOut(250);	 
				} 
			},

		}
        Theme.Headers._init();  
    

		Theme.Breakpoint = {
			
			name : '',
			_init : function(){
				$(window).on('resize', Theme.Breakpoint._resizeHander);
				// $(window).on('load', Theme.Breakpoint._loadHandler);
				$(document).ready(Theme.Breakpoint._loadHandler);
			},
			_loadHandler: function(){
				if( window.innerWidth > 1167 ){
					Theme.Breakpoint.name = 'desktop';
				}
				else if( window.innerWidth <= 1167 && window.innerWidth >= 640 ){
					Theme.Breakpoint.name = 'tablet';
				}
				else {
					Theme.Breakpoint.name = 'mobile';	
				}
			},
			_resizeHander : function(){
				if( window.innerWidth > 1167 && Theme.Breakpoint.name != 'desktop' ){
					Theme.Breakpoint.name = 'desktop';
					Theme.Breakpoint._dispatchEvent();
				}
				else if( window.innerWidth <= 1167 && window.innerWidth >= 640 && Theme.Breakpoint.name != 'tablet' ){
					Theme.Breakpoint.name = 'tablet';
					Theme.Breakpoint._dispatchEvent();
				}
				else if( window.innerWidth < 640 && Theme.Breakpoint.name != 'mobile' ){
					Theme.Breakpoint.name = 'mobile';
					Theme.Breakpoint._dispatchEvent();
				}		
			},
			_dispatchEvent : function(){
				$(document).trigger($.Event('breakpoint', {device: Theme.Breakpoint.name}));
			}
		}


		/**
		 * Configure and Instantiate the SmoothScroll Plugin
		 * @type {Object}
		 */
		Theme.SmoothScroll = {

			instance : undefined,
			activeHeader : undefined,

			_init : function(){
				
				// $(window).on('breakpoint load', Theme.SmoothScroll._resizeHander);
				Theme.SmoothScroll.instance = new SmoothScroll('a[data-scroll]', {
					header : '[data-scroll-header]',
					speed : 800
				});
			},
			// on window resize (breakpoint)
			_resizeHander : function(e){

				Theme.SmoothScroll.activeHeader = Theme.Breakpoint.name;

				// clean up data-scroll-header
				$('.header, .mobileheader').removeAttr('data-scroll-header');

				// intel set data-scroll-header on appropriate nav on breakpoint
				if( Theme.SmoothScroll.activeHeader === 'desktop'){
					$('.header').attr('data-scroll-header', '');
				}
				else if( Theme.SmoothScroll.activeHeader != 'desktop' ){
					$('.mobileheader').attr('data-scroll-header', '');
				}

				Theme.SmoothScroll.instance = new SmoothScroll('a[data-scroll]', {
					header : '[data-scroll-header]',
					speed : 800
				});
			}
		}


		/**
		 * FadeEffects
		 * @type {Object}
		 */
		Theme.FadeEffects = {
			elements : $('.fade-up, .fade-left, .fade-right, .fade-in'),
			_resizeLoadScrollHandler : function(){
				for(var i = 0; i < Theme.FadeEffects.elements.length; i++){
					if( $(window).scrollTop() + $(window).height() > $(Theme.FadeEffects.elements[i]).offset().top )	{
						$(Theme.FadeEffects.elements[i]).removeClass('fade-up fade-left fade-right fade-in');
					}
				}
			},
			_init : function(){
				$(window).on('resize load scroll', Theme.FadeEffects._resizeLoadScrollHandler);
			},
		}


		Theme.HeroSlider = {
			// slide on screen time in ms
			screenTime : 4500,

			slidesContainer : $('.home-hero-slides'),
			slides : $('.home-hero-slides-slide'),
			currentSlide : 0,
			currentlyAnimating : false,
			
			_init : function(st){
				
				if(st !== undefined) Theme.HeroSlider.screenTime = st;
			
				Theme.HeroSlider.slidesContainer.on('NEXT_HEROSLIDE', function(e){
					Theme.HeroSlider._nextSlide();
				});

				Theme.HeroSlider._animateCurrentSlide();
			},	
			_animateCurrentSlide : function(){
				$(Theme.HeroSlider.slides[Theme.HeroSlider.currentSlide]).animate(
					{
						textIndent : 1,
					}, 
					{
						duration : Theme.HeroSlider.screenTime,
						progress : function(animation, progress, remaining){
							if(remaining <= 450 && Theme.HeroSlider.currentlyAnimating != true){
								Theme.HeroSlider.slidesContainer.trigger('NEXT_HEROSLIDE');
								Theme.HeroSlider.currentlyAnimating = true;
							}
						},
						complete : function(){
							Theme.HeroSlider.currentlyAnimating = false;
						},
					}
				);
			},
			_nextSlide : function(){
				// grab old currentslide
				var previousSlide = Theme.HeroSlider.currentSlide;
				// update currentslide
				if(Theme.HeroSlider.currentSlide == $(Theme.HeroSlider.slides).length - 1){
					Theme.HeroSlider.currentSlide = 0;
				}
				else{
					Theme.HeroSlider.currentSlide++;
				}
				// fade slides
				$(Theme.HeroSlider.slides[previousSlide]).fadeOut(Theme.HeroSlider.fadeSpeed);
				$(Theme.HeroSlider.slides[Theme.HeroSlider.currentSlide]).fadeIn(Theme.HeroSlider.fadeSpeed);
				// animate next slide
				Theme.HeroSlider._animateCurrentSlide();
			}
		}

		Theme.HomeTestimonialsSlider = {
			slides : $('.home-testimonials-grid-item'),
			arrowLeft : $('.home-testimonials-arrows-left'),
			arrowRight : $('.home-testimonials-arrows-right'),
			arrows : $('.home-testimonials-arrows i'),
			slideMax : null,
			currentSlide : 0,
			_init : function(){
				if($('.home-testimonials').length > 0){
					// if there are slides
					if(Theme.HomeTestimonialsSlider.slides.length != 0){
						Theme.HomeTestimonialsSlider.slideMax = Theme.HomeTestimonialsSlider.slides.length - 1;
						// if 1 slide
						if(Theme.HomeTestimonialsSlider.slideMax == 0){
							Theme.HomeTestimonialsSlider.arrows.addClass('grey');
						}
						Theme.HomeTestimonialsSlider.arrows.on('click', Theme.HomeTestimonialsSlider._arrowsClickHandler);	
					}
					else{
						$('.home-testimonials').hide();
					}
				}
			},
			_arrowsClickHandler : function(e){
				if(e.target == Theme.HomeTestimonialsSlider.arrowLeft[0]){
					if(Theme.HomeTestimonialsSlider.currentSlide != 0){
						Theme.HomeTestimonialsSlider._updateCurrentSlide(-1);
					}
				}
				if(e.target == Theme.HomeTestimonialsSlider.arrowRight[0]){
					if(Theme.HomeTestimonialsSlider.currentSlide != Theme.HomeTestimonialsSlider.slideMax){
						Theme.HomeTestimonialsSlider._updateCurrentSlide(1);	
					}
				}
				// if more than 3 slides
				if(Theme.HomeTestimonialsSlider.slideMax >= 2){
					if(Theme.HomeTestimonialsSlider.currentSlide == 0){
						Theme.HomeTestimonialsSlider.arrowLeft.addClass('grey');
					}
					else if(Theme.HomeTestimonialsSlider.currentSlide != 0 && Theme.HomeTestimonialsSlider.currentSlide != Theme.HomeTestimonialsSlider.slideMax){
						Theme.HomeTestimonialsSlider.arrows.removeClass('grey');	
					}
					else if(Theme.HomeTestimonialsSlider.currentSlide == Theme.HomeTestimonialsSlider.slideMax){
						Theme.HomeTestimonialsSlider.arrowRight.addClass('grey');	
					}	
				}
				// if 2 slides
				if(Theme.HomeTestimonialsSlider.slideMax == 1){
					if(Theme.HomeTestimonialsSlider.currentSlide == 0){
						Theme.HomeTestimonialsSlider.arrowLeft.addClass('grey');
						Theme.HomeTestimonialsSlider.arrowRight.removeClass('grey');
					}
					else{
						Theme.HomeTestimonialsSlider.arrowRight.addClass('grey');
						Theme.HomeTestimonialsSlider.arrowLeft.removeClass('grey');	
					}
				}
			},
			_updateCurrentSlide : function(amount){
				$(Theme.HomeTestimonialsSlider.slides[Theme.HomeTestimonialsSlider.currentSlide]).fadeOut();
				Theme.HomeTestimonialsSlider.currentSlide += amount;
				$(Theme.HomeTestimonialsSlider.slides[Theme.HomeTestimonialsSlider.currentSlide]).fadeIn();
			}
		}

		Theme.PA = {
			container : $('.pa.popupcontainer'),
			submit : $('.pa.popupcontainer input[type="submit"]'),
			_init : function(){
				if( Theme.PA.container.length > 0 ){
					Theme.PA.container.click(Theme.PA._clickHandler);
				}
			},
			_clickHandler : function(e){
				if($(e.target).hasClass('pa') || $(e.target).hasClass('popupcontainer-times')){
					if($(e.target).has('.ginput_container').length == 0){
						Theme.CookieMonster._setCookie('ad_set', 'active', 30, true);
						Theme.CookieMonster._deleteCookie('ad_notset');
						Theme.CookieMonster._deleteCookie('ad_firsttime');	
						Theme.PA.container.off('click');
					}					
					Theme.PA._hidePA();	
				}
			},
			_hidePA : function(){
				Theme.PA.container.fadeOut(250);
				if(Theme.CookieMonster._cookieExists('ad_set') == false){
					Theme.CookieMonster._setCookie('ad_notset', 'active', parseInt(PopupTimes.long), false);
					Theme.CookieMonster._listenCookieExpire('ad_notset', Theme.CookieMonster._firstTimeExpire);	
				}
			},
			_showPA : function(){
				if( Theme.PA.container.length > 0 && $(window).width() >= 1025 ){
					if(Theme.PA.container.css('display') == 'none'){
						Theme.PA.container.fadeIn(250);	
					}
				}
			}
		}


		Theme.CookieMonster = {
			_init : function(){
				if( DisableTimedPopup === 'false' ){
					// Theme.CookieMonster._deleteCookie('ad_firsttime');
					// Theme.CookieMonster._deleteCookie('ad_notset');

					// if there's no cookies ie. first time on the site
					if(Theme.CookieMonster._cookieExists('ad_notset') == false && Theme.CookieMonster._cookieExists('ad_set') == false && Theme.CookieMonster._cookieExists('ad_firsttime') == false){
						Theme.CookieMonster._setCookie('ad_firsttime', 'active', parseInt(PopupTimes.short), false);
					}
					// if the other cookies don't exist then listen for the expiration of the firstitme cookie
					if(Theme.CookieMonster._cookieExists('ad_set') == false && Theme.CookieMonster._cookieExists('ad_notset') == false){
						Theme.CookieMonster._listenCookieExpire('ad_firsttime', Theme.CookieMonster._firstTimeExpire);	
					}
				}
			},
			_listenCookieExpire : function(cookieName, callback) {
			    var si = setInterval(function() {
			        if (Theme.CookieMonster._cookieExists(cookieName) === false) {
			        	clearInterval(si);
		                return callback();
			        } 
			    }, 100);
			},
			_setCookie : function(cname,cvalue,ctime,days){
				var d = new Date();
				// if days is set to false use seconds
				if(days == undefined || days){
					days = true;
					d.setTime(d.getTime() + (ctime*24*60*60*1000));
				}
				else if(days == false){
					d.setTime(d.getTime() + (ctime*1000));
				}			    
			    var expires = "expires="+ d.toUTCString();
			    document.cookie = cname + "=" + cvalue + "; " + expires;
			},
			_getCookieValue : function(cname){
				var nameEQ = cname + "=";
			    var ca = document.cookie.split(';');
			    for (var i = 0; i < ca.length; i++) {
			        var c = ca[i];
			        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
			    }
			    return null;
			},
			_cookieExists : function(cname){
			    if (Theme.CookieMonster._getCookieValue(cname) != null) {
			        return true;
			    } 
			    else {
			        return false;
			    }
			},
			_deleteCookie : function( name ) {
				document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
			},
			_firstTimeExpire : function(){
				Theme.PA._showPA();
			},
		};

		Theme.Parallax = {
			strength : 25,
			stronger : 175,
			imagesections : $('.parallax-image'),
			_init : function(){
				$(window).on('resize scroll load', Theme.Parallax._resizeLoadScrollHandler);
			},
			_map : function(n,i,o,r,t){return i>o?i>n?(n-i)*(t-r)/(o-i)+r:r:o>i?o>n?(n-i)*(t-r)/(o-i)+r:t:void 0;},
			_getAmount : function(el, strength){
				var windowcenter = $(window).scrollTop() + ( $(window).height() / 2 );
				var sectioncenter = $(el).offset().top + ($(el).height() / 2);
				var sectiondelta = windowcenter - sectioncenter;
				var scale = Theme.Parallax._map(sectiondelta, 0, $(window).height(), 0, strength);
				return -50 + scale + '%';
			},
			_resizeLoadScrollHandler : function(){
				for(var i = 0; i < Theme.Parallax.imagesections.length; i++){
					$(Theme.Parallax.imagesections[i]).css('transform', 'translate3d(-50%, ' + Theme.Parallax._getAmount(Theme.Parallax.imagesections[i], Theme.Parallax.strength) + ',0)');
				}
			}
		}

	});

})( jQuery, Theme, Headers, window, document );


var MapServer = {
	types : ['StatesServed', 'AreasServed', 'CountiesServed', 'CountriesServed'],
	activeAreasServedMap : '',
	activeAreasServedMapData : null,
	_init : function(){
		MapServer.types.forEach(function(el){
			try {
				if(eval(el)){
					MapServer.activeAreasServedMap = el;
					MapServer.activeAreasServedMapData = eval(el);
					MapServer._buildAreasServedMap();
				}
			} catch(err){
				// console.log(err);
			}
		});
		if( document.querySelector('.contact-hero-map') !== null ){
			MapServer._buildContactMap();
		}
	},
	_buildContactMap : function(){
		var element =  document.querySelector('.contact-hero-map');
		var latlangs = [];
		ContactAddresses.forEach(function(el, index, parent){
			latlangs.push({lat: Number(el.lat), lng: Number(el.lng)});
		});
		// build bounds & make center of map coords
		var bounds  = new google.maps.LatLngBounds();
		var map_center = [];
		var x = 0;
		var y = 0;
		var map = new google.maps.Map(element, {
		  zoom: 28,
		  mapTypeId: 'roadmap',
		  disableDefaultUI: true,
		  gestureHandling: 'none',
		  styles: [
		  	{
		  		featureType: 'all',
		  		elementType: 'all',
		  		stylers: [
		  			{saturation: -100}
		  		]
		  	}
		  ],
		});
		latlangs.forEach(function(el){
			x += Number(el.lat);
			y += Number(el.lng);
			var marker = new google.maps.Marker({
			  position: el,
			  map: map,
			});	
			bounds.extend(el);
		});
		map_center[0] = x / latlangs.length;
		map_center[1] = y / latlangs.length;
		map.setCenter({lat: map_center[0], lng: map_center[1]});
		google.maps.event.addListener(map, 'zoom_changed', function() {
			zoomChangeBoundsListener = 
				google.maps.event.addListener(map, 'bounds_changed', function(event) {
					if (this.getZoom() > 15 && this.initialZoom == true) {
						// Change max/min zoom here
						this.setZoom(15);
						this.initialZoom = false;
					}
				google.maps.event.removeListener(zoomChangeBoundsListener);
			});
		});
		map.initialZoom = true;
		// zoom to bounds
		if(latlangs.length > 1){
			map.fitBounds(bounds);
			var listener = google.maps.event.addListener(map, "idle", function() { 
			  map.setZoom(map.getZoom() - 1); 
			  google.maps.event.removeListener(listener); 
			});
			
		}	
		map.panToBounds(bounds);
	},
	_buildAreasServedMap : function(){

		if( MapServer.activeAreasServedMap == 'AreasServed' ){

			setupMap(AreasServed);
			
			function setupMap(latlangs){

				// build bounds & make center of map coords
				bounds  = new google.maps.LatLngBounds();
				for(var i = 0; i < latlangs.length; i++){
					bounds.extend(latlangs[i]);
				}

				// build map
				map = new google.maps.Map(document.querySelectorAll('.areas-served-hero-map')[0], {
					zoom: 11,
					center: bounds.getCenter(),
					gestureHandling: 'none',
					mapTypeId: 'roadmap',
					disableDefaultUI: true,
					styles: [
					{
						featureType: 'all',
						elementType: 'all',
						stylers: [
							{saturation: -100}
						]
					}
				],
				});
				// add circles
				latlangs.forEach(function(currentValue, i, arr){
					var cityCircle = new google.maps.Circle({
						strokeColor: '#FF0000',
						strokeOpacity: 0.8,
						strokeWeight: 2,
						fillColor: '#FF0000',
						fillOpacity: 0.35,
						map: map,
						center: latlangs[i],
						radius: 9000,
					});
					var marker = new google.maps.Marker({
						position: latlangs[i],
						map: map,
					});
				});
				// zoom to bounds
				if(latlangs.length > 1){
					map.fitBounds(bounds);	
				}	
				map.panToBounds(bounds);
			}
		}
		else{
			var bounds  = new google.maps.LatLngBounds();
			MapServer.activeAreasServedMapData.forEach(function(el){
				JSON.parse(el.geometry).forEach(function(polygon){
					polygon.forEach(function(latlng){
						latlng['lat'] = parseFloat(latlng['lat']);
						latlng['lng'] = parseFloat(latlng['lng']);
						bounds.extend(latlng);
					});
				});
			});
			var map = new google.maps.Map(document.querySelectorAll('.areas-served-hero-map')[0], {
				zoom: 11,
				center: bounds.getCenter(),
				gestureHandling: 'none',
				mapTypeId: 'roadmap',
				disableDefaultUI: true,
				styles: [
					{
						featureType: 'all',
						elementType: 'all',
						stylers: [
							{saturation: -100}
						]
					}
				],
			});

			if( MapServer.activeAreasServedMap == 'StatesServed' ){
				map.fitBounds(bounds, 0);
			}
			else if( MapServer.activeAreasServedMap == 'CountiesServed' ){
				map.fitBounds(bounds, -50);
			}
			else if( MapServer.activeAreasServedMap == 'CountriesServed' ){
				map.fitBounds(bounds, -150);
			}

			var polygons = [];
			MapServer.activeAreasServedMapData.forEach(function(el){
				JSON.parse(el.geometry).forEach(function(polygon){
					var mapped = polygon.map(function(latlng){
						latlng['lat'] = parseFloat(latlng['lat']);
						latlng['lng'] = parseFloat(latlng['lng']);
						return latlng;
					});

					var gmapPoly = new google.maps.Polygon({
						paths: mapped,
						strokeColor: '#FF0000',
			            strokeOpacity: 0,
			            strokeWeight: 2,
			            fillColor: '#FF0000',
			            fillOpacity: 0.5
					});	
					gmapPoly.setMap(map);
				});
			});
		}
	},
};

console.log('about to load the google map?');
google.maps.event.addDomListener(window, "load", MapServer._init);

// why does this need to be here
window.Theme = Theme;