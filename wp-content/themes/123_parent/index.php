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

    // get home page sections
    if( have_rows( 'field_naaolkn23oin', 'options') ) :
        $rowcount = 0;
        while( have_rows( 'field_naaolkn23oin', 'options') ) : 
            // loop thru active pages repeater
            the_row();
			$rowcount++;
            // get the slug
            $slug = get_sub_field('page-template') ?? null; // REMOVE THESE NULL COALESCING OPERATORS ASAP!!!
            // get the altname
            $altname = get_sub_field('page-altname') ?? null; // REMOVE THESE NULL COALESCING OPERATORS ASAP!!!
            
            // certain sections have a 'breaker' image above them
            // but shouldnt ever be below the hero
            if( $rowcount > 1 ){
                if( $slug != 'areas-served' && $slug != 'contact' ){
                    if( $slug != 'blog' && $slug != 'coupons'){
                        the_bg($slug);
                    }
                    elseif ($slug == 'blog'){
                        the_bg('general-blog-bg', false);
                    }
                    elseif ($slug == 'coupons') {
                        the_bg('general-coupons-bg', false);
                    }
                }
            }
            if( !empty($slug)){
                include locate_template( 'modules/' . $slug . '.php' );
            }
        endwhile;
    endif;
    
    // close main element
    echo '</main>';

    // get footer
    get_footer();
 ?>