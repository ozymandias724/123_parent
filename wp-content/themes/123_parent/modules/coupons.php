<main class="coupons main" id="coupons">
	<section class="coupons-hero  hero">
		<div class="coupons-hero-text hero-text">
			<h1 class="fade fade-in coupons-hero-text-header hero-text-header">
				<?php Pagedata::the_active_page_name('coupons'); ?>
			</h1>
		</div>
	</section>
	<section class="coupons-coupons  section">
		<?php 
		
		$the_query = new WP_Query(array(
			'post_type' => 'coupon',
			'posts_per_page' => 6,
			'meta_query' => array(
				'relation' => "OR",
				array(
					'key' => 'coupon-expiration-date',
					'value' => date("Y-m-d H:i:s"),
					'compare' => '>=',
				),
				array(
					'key' => 'coupon-expiration-date',
					'value' => "",
					'compare' => '=',
				),
			),
		));

		if($the_query->have_posts()) : ?>
		<div class="coupons-coupons-grid">
			<?php while($the_query->have_posts()): $the_query->the_post();  ?>
			<div class="fade fade-up coupons-coupons-grid-item">
				<div class="coupons-coupons-grid-item-textcontainer">
					
					<h2 class="coupons-coupons-grid-item-textcontainer-sitename">
						<?php echo get_bloginfo('name'); ?>
					</h2>
					
					<h2 class="coupons-coupons-grid-item-textcontainer-header">
						<?php echo $post->post_title; ?>
					</h2>
					<?php 
						$coupon_date = get_field('coupon-expiration-date');
						if( !empty($coupon_date) ) :
							$timestamp = strtotime($coupon_date);
							$pretty_date = date('m/d/Y', $timestamp);

					 ?>
							<div class="coupons-coupons-grid-item-textcontainer-expiration"><?php echo 'Expires on: ' . $pretty_date; ?></div>
					<?php 
						endif;
					 ?>

					<div class="coupons-coupons-grid-item-textcontainer-code">
						<?php echo 'Coupon Code: <strong>' . get_field('coupon-code') . '</strong>'; ?>
					</div>

					<a target="_blank" href="<?php echo get_permalink(); ?>" class="coupons-coupons-grid-item-textcontainer-print">Print</a>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<a href="<?php echo site_url('coupons'); ?>" class="coupons-coupons-seemore"><p class="global-recentposts-viewall button-viewall">View All</p></a>
		
		<?php endif; ?>
	</section>
</main>