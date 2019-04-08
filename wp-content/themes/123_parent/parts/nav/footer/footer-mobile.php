<footer class="mobilefooter<?php echo $logo_is_inverted ? ' invertlogo' : ''; ?>">

	<div class="mobilefooter-section">
		<a href="<?php echo site_url(); ?>" class="mobilefooter-logo"><img src="<?php echo get_logo(); ?>" class="mobilefooter-logo-image"></a>
		<div class="mobilefooter-section-contactlinks">
			<?php 
				echo $content_contact_m;			
			 ?>
			<div class="mobilefooter-contactlinks-address"><?php echo $formattedAddress; ?></div>
		</div>
	</div>


	<div class="mobilefooter-section mobilefooter-section-pagelinks ">
		<h2 class="mobilefooter-section-heading">Links</h2>
		<?php 
			echo _get_site_nav('mobilefooter-pagelinks');
		 ?>
	</div>


	<div class="mobilefooter-section mobilefooter-section-payment ">
		<h2 class="mobilefooter-section-heading">Payment</h2>
		<?php 
			echo $content_payment;
		 ?>
	</div>
	<div class="mobilefooter-section">
		<div class="mobilefooter-copyright">
			<?php echo $content_badges; ?>
			<h2 class="mobilefooter-section-heading">Follow Us</h2>
			<?php 
				include_once( get_template_directory() . '/modules/sub-modules/social-icons.php');
			 ?>
			 <br>
			<?php 
				echo $content_copyright_m;
			 ?>
		</div>

	</div>
</footer>