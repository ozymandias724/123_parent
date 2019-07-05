<?php 
/**
 *   Block
 * 
 *   Content Grid 
 */
    if( !empty($block) && $block['acf_fc_layout'] == 'content_grid' ){

        $return = [];
        $guide = [];

        $return['content_grid'] = '';
        $guide['content_grid'] = '';
        

        // verify there are records in the relationship field
        if( !empty($block['content']) ){

            // open up a section,
            // open up container inside section
            $return['content_grid'] .= '<section><div class="container '.$block['options']['width'].'">';

            // check for the heading,
            // check for the sub heading
            
            // we are going to loop. check the options.

            // write the container for a site grid w/ the width and colcount on it
            $return['content_grid'] .= '<div class="site__grid cols-'.$block['options']['column_count'].'"><ul>';

            // loop thru the post results (items are post objects)
            foreach ($block['content'] as $i => $post) {
                $return['content_grid'] .= '<li>';
                // check which post type this item is
                switch ($post->post_type) {
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
                    default:
                        # code...
                        break;
                }
                $return['content_grid'] .= '</li>';
                
            }

            $return['content_grid'] .= '</ul></div></div></section>';
            echo $return['content_grid'];
        }

    }
    unset($return, $guide);
 ?>