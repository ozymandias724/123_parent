<?php 
/**
 * Setup new Sites for MultiSite
 */
class MultiSite
{
	
	function __construct()
	{
		add_action( 'admin_menu' , array($this, 'add_menu_page') );
		add_action( 'wp_ajax_do_site_setup' , array($this, 'do_site_setup') );
	}

	function add_menu_page(){
		add_menu_page( 'Setup Site', 'Setup Site', 'manage_options', 'setup_site', array($this, 'build_menu_page'), '', '7' );
	}

	/**
	 * [build_menu_page description]
	 * @return [type] [description]
	 */
	function build_menu_page(){
		ob_start();
		?>
			<div class="wrap">
				<h1>Site Setup:</h1>
				<form id="sitesetup">
					<section>
						<h2>General Info.</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi debitis vitae deleniti, beatae maxime dignissimos quibusdam veniam, tempore corporis fugit unde magnam dolorum nihil nemo veritatis, iure dolor magni optio!</p>			
						<span>
							<label for="">Company Logo</label>
							<input type="text" name="logo">
						</span>
						<span>
							<label for="">Customer eMail</label>
							<input type="text" name="email">
						</span>
						<span>
							<label for="">Company Address</label>
							<input type="text" name="addressone">
						</span>
						<span>
							<label for="">Primary Phone #</label>
							<input type="text">
						</span>
						<span>
							<label for="">Secondary Phone #</label>
							<input type="text">
						</span>
						<span>
							<label for="">Hours of Operation</label>
							<input type="text">
						</span>
						<span>
							<label for="">Payment Options</label>
							<input type="text">
						</span>
						<span>
							<label for="">Social Media</label>
							<input type="text">
						</span>
					</section>
					<section>

						<h2>About Us:</h2>
					</section>
					<section>
						<h2>Testimonials</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi debitis vitae deleniti, beatae maxime dignissimos quibusdam veniam, tempore corporis fugit unde magnam dolorum nihil nemo veritatis, iure dolor magni optio!</p>
						<span>
							<label for="">Testimonials</label>
							<input type="text">
						</span>
					</section>

					<section>
						<h2>Gallery</
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi debitis vitae deleniti, beatae maxime dignissimos quibusdam veniam, tempore corporis fugit unde magnam dolorum nihil nemo veritatis, iure dolor magni optio!</p>h2>
						<span>
							<label for="">Gallery Page</label>
							<input type="text">
						</span>
					</section>

					<section>
						<h2>Areas Served</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi debitis vitae deleniti, beatae maxime dignissimos quibusdam veniam, tempore corporis fugit unde magnam dolorum nihil nemo veritatis, iure dolor magni optio!</p>
						<span>
							<label for="">Areas Served</label>
							<input type="text">
						</span>
					</section>

					<section>
						<span>
							<label for="">Services</label>
							<input type="text">
						</span>
					</section>

					<section>
						<h2>Coupons</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi debitis vitae deleniti, beatae maxime dignissimos quibusdam veniam, tempore corporis fugit unde magnam dolorum nihil nemo veritatis, iure dolor magni optio!</p>
						<span>
							<label for="">Coupons</label>
							<input type="text">
						</span>

						<h2>Finished!</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi debitis vitae deleniti, beatae maxime dignissimos quibusdam veniam, tempore corporis fugit unde magnam dolorum nihil nemo veritatis, iure dolor magni optio!</p>
						<p>Thank you, and so on...</p>
					</section>
						<input type="submit" value="Submit" id="sitesetup-submit">

					<div id="form-pagination">
						<span class="dashicons dashicons-arrow-left-alt"></span>
						<span class="dashicons dashicons-arrow-right-alt"></span>
					</div>
				</form>
			</div>
		<?php
		echo ob_get_clean();
	}



	/**
	 * form submission handler
	 * @return string passed to javascript
	 */
	function do_site_setup(){

		print_r($_POST);

		wp_die();
	}
}

new MultiSite();
 ?>