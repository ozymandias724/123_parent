;(function ( $, Theme, window, document, undefined ) {

	$(document).ready(function(){

		Headers.Desktop._init();

		Hero._init();

		Headers.Mobile._init();

		Theme.Breakpoint._init();

		Theme.FadeEffects._init();
		
		Theme.PA._init();

		Theme.CookieMonster._init();

		Theme.Parallax._init();
		
		Theme.SmoothScroll._init();

	});

})( jQuery, Theme, window, document );
