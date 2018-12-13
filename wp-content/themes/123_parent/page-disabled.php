<?php
/**
 * 	Page Template: Disabled
 *  
 */
	$reseller_info = array_values(get_option( '123_parentcompany_info' ));
	
	$format_notice = '
		<h2>Sorry it appears we\'ve encountered a problem.</h2>
		<p>Please contact %s to reinstate your service.</p>
	';

	$content_notice = sprintf(
		$format_notice
		,'<a href="'.$reseller_info[0]['url'].'"><h1>'.$reseller_info[0]['name'].'</h1></a>'
	);
	
	get_header();
 ?>
	<div class="disabled" style="background-image: url('<?php the_field('general-admin-bg', 'option'); ?>');">
		<div class="disabled-center">
			
			<h1 class="disabled-center-header">Website Disabled</h1>

			<div class="disabled-center-subheader">
				<?php echo $content_notice; ?> 
			</div>
			
			<a href="tel:<?php echo $reseller_info[0]['phone']; ?>" class="disabled-center-tel"><?php echo $reseller_info[0]['phone']; ?></a>
		</div>
		<div class="disabled-tint"></div>
	</div>

<?php get_footer(); ?>