<?php 
/**
 * 
 */
$format_copyright_dt = '
    <span class="footer-copyright">
        Powered by <a href="%s" class="footer-copyright-tclink" target="_blank">%s</a>
        %s
        | Copyright &copy; %s
    </span>
';
$has_terms = 
( !get_field('terms-disable', 'option') ) 
    ? '| <a href="'.site_url().'/terms" target="_blank" class="footer-copyright-tclink">Terms &amp; Conditions</a>'
    : ''
; // end $has_terms
$content_copyright_dt = sprintf(
    $format_copyright_dt
    ,$reseller_info[0]['url']
    ,$reseller_info[0]['name']
    ,$has_terms
    ,Date('Y')
);
 ?>
<footer class="footer<?php echo ($logo_is_inverted) ? ' invertlogo' : ''; ?>">
	<div class="footer-wrap">
		<div class="footer-section">
			<a href="<?php echo site_url(); ?>" class="footer-logo">
				<figure>
					<img src="<?php echo get_logo(); ?>" class="footer-logo-image">
				</figure>
			</a>
			<div class="footer-section-contactlinks">
				<?php 
					echo $content_contact_dt;
				 ?>
				<div class="footer-contactlinks-address">
					<?php echo $formattedAddress; ?>
				</div>
			</div>
		</div>
		
		<div class="footer-section footer-section-pagelinks">
			<p class="footer-section-heading">Links</p>
			 <?php echo _get_site_nav('footer-pagelinks'); ?>
		</div>	

		<div class="footer-section footer-section-payment">
			<h2 class="footer-section-heading">Payment</h2>
			<?php 
				echo $content_payment;
			 ?>
		</div>

		<div class="footer-section footer-section-followus">
			<h2 class="footer-section-heading">Follow Us</h2>
			<?php 
				include locate_template( 'modules/sub-modules/social-icons.php' );
				echo $content_badges;
			 ?>
		</div>
	</div>
</footer>
<?php 
    echo $content_copyright_dt;
?>