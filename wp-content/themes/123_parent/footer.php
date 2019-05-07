<?php 
/**
 * Part: Footer
 * Description:
 *  logo, company info, address
 *  nav links
 *  payment types
 *  social icoms
 *  badges
 *  copyright section
 */

    $company_info = get_field('company_info', 'options');
    $footer_info = get_field('footer', 'options');
    $company_address = _get_full_address_br();

    function _get_copyright_banner($footer_info){

        $banner = $footer_info['copyright_banner'];
        $terms = $banner['terms_and_conditions'];

        $copyright_text = ($banner['copyright']) ? $banner['copyright'] : '' ;
        $terms_url = ($terms['url']) ? $terms['url'] : ''; 
        $terms_title = ($terms['title']) ? $terms['title'] : '';
        $terms_target = ($terms['target']) ? $terms['target'] : ''; 

        $format_url = '<a href="%s" class="%s">%s</a>';

        $url = sprintf(
            $format_url
            ,$terms_url
            ,$terms_target
            ,$terms_title
        );

        $format_copyright = '<p>%s</p>';

        $copyright = sprintf(
            $format_copyright
            ,$copyright_text
        );

        $format_banner = '
            <div id="copyright_banner">
                %s
                %s
            </div>
        ';

        $copyright_banner = sprintf(
            $format_banner
            ,$url
            ,$copyright
        );

        return $copyright_banner; 
    }
    
?>
</main>
<footer>
<?php 
    
    echo get_section_banner('Footer Here Please');
    
    echo _get_copyright_banner();
    
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