<?php 


if ( !Pagedata::is_active_page('coupons') ) {
	header( "Location: " . site_url() . "/404.php" );
}
wp_head();
 ?>
<script type="text/javascript">
	window.print();
</script>
<div class="coupons-coupons-grid-item">
	<div class="coupons-coupons-grid-item-textcontainer">
		<h2 class="coupons-coupons-grid-item-textcontainer-sitename"><?php echo get_bloginfo('name'); ?></h2>
		<h2 class="coupons-coupons-grid-item-textcontainer-header"><?php echo $post->post_title; ?></h2>
		<div class="coupons-coupons-grid-item-textcontainer-exipiration"><?php echo 'Expires on: ' . get_field('coupon-expiration-date'); ?></div>
		<div class="coupons-coupons-grid-item-textcontainer-code"><?php echo 'Coupon Code: <strong>' . get_field('coupon-code') . '</strong>'; ?></div>
	</div>
</div>
<?php wp_footer(); ?>