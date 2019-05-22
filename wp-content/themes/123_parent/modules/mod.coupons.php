<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */
    // get the coupons page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'coupons'
    );

    $res = get_posts($args);

    // get the gallery page fields
	$fields = get_fields($res[0]);

	$return_coupons = '';
	if( !empty($fields['featured_coupons']['coupons']) ){

		$heading = ( !empty( $fields['featured_coupons']['heading'] ) ? '<h2 class="site__fade site__fade-up">'.$fields['featured_coupons']['heading'].'</h2>' : '');
		$details = ( !empty( $fields['featured_coupons']['details'] ) ? '<div class="site__fade site__fade-up">'.$fields['featured_coupons']['details'].'</div>' : '');
		
		$return_coupons = '
			<section class="mod__coupons-featuredcoupons mod__featured_grid">
				<div class="container">
				'.$heading.'
				'.$details.'
				<div class="site__grid"><ul> 
		';
		
		$format_coupon = '
			<li class="site__fade site__fade-up">
				<a href="%s">
					<h5>%s</h5>
					<p class="coupon_description">This is a note for what this coupon does and if it\'s not filled in it doesn\'t show.</p>
					<p class="coupon_code">Code: <span>%s</span></p>
				</a>
			</li>
		';

		foreach( $fields['featured_coupons']['coupons'] as $coupon ){

			$coupon_fields = get_fields($coupon['coupon']->ID);
			
			if( $coupon_fields['status'] ){ 
				$return_coupons .= sprintf(
					$format_coupon
					,get_permalink($coupon['coupon']->ID)
					,$coupon['coupon']->post_title
					//,date('M j, Y',$coupon_fields['expiration'])
					,$coupon_fields['code']
				);
			}
		}
		$return_coupons .= '</ul></div>';
        $return_coupons .= '
                    <a href="'.get_permalink($res[0]->ID).'" title="View all coupons" class="site__button site__fade site__fade-up">View All Coupons</a>
                </div>
            </section>
        ';
	}

    
 ?>
<section id="mod_coupons">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_coupons;
 ?>
</section>
<?php 
 ?>