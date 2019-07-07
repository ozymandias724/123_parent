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
	$return['content_grid'] .= '<section class="site__block"><div class="container '.$block['options']['width'].'">';

	// check for the heading,
	if( !empty( $block['heading'] ) ){
		$return['content_grid'] .= '<h2 class="site__fade site__fade-up block__heading">'.$block['heading'].'</h2>';
	}
	
	// check for the sub heading
	if( !empty( $block['sub_heading'] ) ){
		$return['content_grid'] .= '<div class="site__fade site__fade-up block__details">'.$block['sub_heading'].'</div>';
	}
	
	// we are going to loop. check the options.

	// write the container for a site grid w/ the width and colcount on it
	$return['content_grid'] .= '<div class="site__flexgrid cols-'.$block['options']['column_count'].' '.$block['options']['width'].'"><ul>';

	// loop thru the post results (items are post objects)
	foreach ($block['content'] as $i => $post) {

		// $return['content_grid'] .= '<li class="'.$block['style'].'">';
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
            case 'staff':
                ob_start();
                include('parts/grid.staff.php');
                $return['content_grid'] .= ob_get_clean();
                break;
			default:
				# code...
				break;
		}

		$return['content_grid'] .= '</li>';
	
		}

		$return['content_grid'] .= '</ul>';

		// check for the view all button
		if( !empty( $block['button'] ) ){
			$return['content_grid'] .= '<a class="site__button" href="'.$block['button']['url'].'">'.$block['button']['title'].'</a>';
		}
		
		// close the content grid 
		$return['content_grid'] .= '</div></div></section>';

		echo $return['content_grid'];
	}

}
unset($return, $guide);
?>