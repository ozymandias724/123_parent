<?php 
/**
* Template Name: Home Page
*/

    //  get acf fields
    $fields = get_fields(get_the_ID());
    
    // run get header
    get_header();

    // -Gus-
    include( get_template_directory() . '/parts/part.popups.php');
?>
<main id="page_home">
<?php
// 
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
    // run get footer
    get_footer();
    // clean up
    unset($cB);
?>