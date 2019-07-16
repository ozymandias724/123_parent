<?php 
/**
 *   Block
 * 
 *   Content Grid 
 */
if( !empty($cB) && $cB['acf_fc_layout'] == 'content_grid' ){

	$return['content_grid'] = '';
    $guide['content_grid'] = '';

	// verify there are records in the relationship field
	if( !empty($cB['content']) ){

        // open up a section,
        // open up container inside section
        $return['content_grid'] .= '<section class="site__block"><div class="container '.$cB['options']['width'].'">';

        // check for the heading,
        if( !empty( $cB['heading'] ) ){
            $return['content_grid'] .= '<h2 class="site__fade site__fade-up block__heading">'.$cB['heading'].'</h2>';
        }
        
        // check for the sub heading
        if( !empty( $cB['sub_heading'] ) ){
            $return['content_grid'] .= '<div class="site__fade site__fade-up block__details">'.$cB['sub_heading'].'</div>';
        }
         
        // we are going to loop. check the options
        $return['content_grid'] .= '<div class="site__flexgrid cols-'.$cB['options']['column_count'].' flexgrid_'. $cB['content'][0]->post_type .'"><ul class="flexboxGrid post_type_'.$cB['content'][0]->post_type.'">';

        // loop thru the post results (items are post objects)
        foreach ($cB['content'] as $i => $post) {

            $return['content_grid'] .= '<li>';

            // check which post type this item is
            switch ($post->post_type) {
                case 'post':
                    ob_start();
                    include('parts/grid.blog-post.php');
                    $return['content_grid'] .= ob_get_clean();
                    break;
                case 'coupon':
                    ob_start();
                    include( 'parts/grid.coupon.php' );
                    $return['content_grid'] .= ob_get_clean();
                    break;
                case 'services':
                    ob_start();
                    include('parts/grid.service.php');
                    $return['content_grid'] .= ob_get_clean();
                    break;
                case 'staff':
                    ob_start();
                    include('parts/grid.staff.php');
                    $return['content_grid'] .= ob_get_clean();
                    break;
                case 'testimonials':
                    ob_start();
                    include('parts/grid.testimonial.php');
                    $return['content_grid'] .= ob_get_clean();
                    break;
                default:
                    # code...
                    $return['content_grid'] .= 'something went wrong...';
                    break;
            }

            $return['content_grid'] .= '</li>';
        
        }

        $return['content_grid'] .= '</ul>';

        // check for the view all button
        if( !empty( $cB['button'] ) ){
            $return['content_grid'] .= '<a class="site__button" href="'.$cB['button']['url'].'">'.$cB['button']['title'].'</a>';
        }
        
        // close the content grid 
        $return['content_grid'] .= '</div></div></section>';

        echo $return['content_grid'];
	}
}

?>