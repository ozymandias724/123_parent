<?php

	if( $post->post_name !== 'disabled' ){
		get_template_part('partials/global', 'popups');
		get_template_part('partials/navigation/footer', 'mobile');
		get_template_part('partials/navigation/footer', 'desktop');
	}

	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
	   ?> <script src="//localhost:35729/livereload.js"></script> <?php
	}
	wp_footer();
?>
</body>
</html>