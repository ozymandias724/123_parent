<?php 
/**
* Template Name: Home Page
*/
    $fields = get_fields(get_the_ID());
    get_header();
?>
<main id="page_home">
<?php
    include( get_template_directory() . '/parts/part.hero.php');
    // Check for Content Blocks
    if( !empty($fields['content_blocks']) ){
        // Loop thru Content Blocks
        foreach ($fields['content_blocks'] as $cB) {
            // Include Content Block
            include( get_template_directory() . '/blocks/' . $cB['acf_fc_layout'] . '.php' );
        }
    }
?>
</main>
<?php 
    unset($cB);
    get_footer();
?>