<?php 

get_header();

echo '<h1 class="terms-header">Terms &amp; Conditions</h1>';

echo '<div class="terms">' . get_field('terms-content', 'option') . '</div>';

wp_footer();

?>