<?php
if ( !Pagedata::is_active_page('coupons') ) {
	header( "Location: " . site_url() . "/404.php" );
}

get_header(); ?>

<main class="coupons page">
	<section class="coupons-hero  hero" style="background-image: url('<?php echo get_field('general-coupons-bg', 'option'); ?>');">
		<div class="coupons-hero-text hero-text">
			<h1 class="coupons-hero-text-header hero-text-header">Coupons</h1>
		</div>
		<div class="coupons-hero-tint hero-tint"></div>
	</section>
	<section class="coupons-coupons section">
		<?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$the_query = new WP_Query(array(
			'post_type' => 'coupon',
			'posts_per_page' => get_field('general-coupons-postsperpage', 'option'),
			'paged' => $paged,
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
			<div class="coupons-coupons-grid-item">
				<div class="coupons-coupons-grid-item-textcontainer">
					<h2 class="coupons-coupons-grid-item-textcontainer-sitename"><?php echo get_bloginfo('name'); ?></h2>
					<h2 class="coupons-coupons-grid-item-textcontainer-header"><?php echo $post->post_title; ?></h2>
	
					<?php 
						$coupon_date = get_field('coupon-expiration-date');
						if( !empty($coupon_date) ) :
							$timestamp = strtotime($coupon_date);
							$pretty_date = date('m/d/Y', $timestamp);
					 ?>
							<div class="coupons-coupons-grid-item-textcontainer-exipiration"><?php echo 'Expires on: ' . $pretty_date; ?></div>
					<?php 
						endif;
					 ?>
					<div class="coupons-coupons-grid-item-textcontainer-code"><?php echo 'Coupon Code: <strong>' . get_field('coupon-code') . '</strong>'; ?></div>
					<a target="_blank" href="<?php echo get_permalink(); ?>" class="coupons-coupons-grid-item-textcontainer-print">Print</a>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<div class="coupons-coupons-pagination">
			<?php 
			global $wp_query;
			$original_global = $wp_query;
			$wp_query = null;
			$wp_query = $the_query;

			echo paginate_links(array(
				'prev_text' => '<< Prev',
			));

			wp_reset_postdata();

			$wp_query = $original_global;

			?>
		</div>
		
		<?php endif; ?>
	</section>
	<?php get_template_part('partials/global', 'contact');?>
</main>

<?php get_footer(); ?>