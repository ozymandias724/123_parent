<?php 
/**
 * Template: Index Page (view latest posts)
 * 
 */
    // get header
    get_header();

    // open main element
    echo '<main>';
    
    // get hero
    include( 'modules/hero.php' );

    $res = get_field('field_naaolkn23oin', 'option');

    foreach ($res as $rec) {
        if( !empty($rec['page-template']) ){
            include locate_template( 'modules/' . $rec['page-template'] . '.php' );
        }
    }
    
    // close main element
    echo '</main>';

    // get footer
    get_footer();
 ?>