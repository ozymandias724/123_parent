<?php 
/* 
    Default Template
*/
    get_header();

    $fields = get_fields(get_the_ID());
?>
<main id="page_default">
<?php 
    if( !empty($fields['hero_type']) ){
        include( get_template_directory() . '/parts/part.hero.php');
    }
    
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