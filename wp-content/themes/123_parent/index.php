<?php 
/**
 * Template: Index Page (view latest posts)
 * 
 */
    // get header
    get_header();

    echo get_section_banner($res[0]->post_title);

    // get footer
    get_footer();
 ?>