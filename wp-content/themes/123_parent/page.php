<?php 
/**
 * Template: Page
 * 
 */
    $fields = get_fields(get_the_ID());
    
    get_header();
?>
<main>
<?php
    
    // get hero
    if (!empty($fields['hero_type'])) {
        include(get_template_directory() . '/parts/part.hero.php');
    }
    
    // get content blocks    if (!empty($fields['content_blocks'])) {
    foreach ($fields['content_blocks'] as $i => $block) {
        if( $block['acf_fc_layout'] == 'content_grid' ){
            
            include(get_template_directory() . '/blocks/' . $block['acf_fc_layout'] .'/'.$block['acf_fc_layout'] . '.php');
        }else{

            $cB = $block;
            include(get_template_directory() . '/blocks/' . $block['acf_fc_layout'] . '.php');
        }
    }
?>
</main>
<?php 
    get_footer();
?>