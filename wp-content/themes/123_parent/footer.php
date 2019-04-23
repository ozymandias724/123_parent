<?php 
/**
 * Part: Footer
 * Description:
 */
?>
</main>
<footer>
<?php 
    
    echo get_section_banner('Footer Here Please');
    
    
    // live reload script
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        ?>
	   	<script src="//localhost:35729/livereload.js"></script>
	   <?php
	}
    
    
    wp_footer();
    
?>
</footer>
</body>
</html>