<?php 
/*
Plugin Name: 123Websites Custom Admin Bar
Plugin URI: http://kylemarcy.com
Description: Customize Admin Bar Experience
Version: 0.1a
Author: Kyle Marcy
Author URI: http://kylemarcy.com
*/

	function add_limelight_custom_link($wp_admin_bar){
		// if field is set
		$custom_address = "";
		if( get_field('field_212o8afdh', 'options') ){
			$company_address = get_field('field_212o8afdh', 'options');
		}
		$ready_company_address = str_replace('@', '%40', $company_address);

		if( get_field('field_8sna0sklfjfa8nfja', 'options') ){
			$domain_select = get_field_object('field_8sna0sklfjfa8nfja','options');
			if ( $domain_select['value'] == 'onenet'){
				$company_domain = 'network';
			} else if ( $domain_select['value'] == 'webx'){
				$company_domain = 'clientsuccessmanager';
			} else {
				$company_domain = 'network';
			}
		}

		$limelight_address = "https://{$company_domain}.limelightcrm.com/admin/orders.php?search_req=&file_path=&act=&show_folder=view_all&fromPost=1&ci_clrcode=&ci_id=&from_filter=&to_filter=&order_id_filter=&campaign_id_filter=&order_transaction_filter=&product_filter=&product_upsell_filter=&tracking_filter=&shipping_filter=&shipped_status_filter=-1&paymenttype_filter=&status_filter=&cc_first_six=&cc_last_four=&customer_id_filter=&gateway_id_filter=&firstname_filter=&lastname_filter=&email_filter={$ready_company_address}&address_filter=&address_filter2=&city_filter=&postal_filter=&phone_filter=&state_filter=&country_filter=&ip_filter=&affiliate_filter=&subaffiliate_filter=&orderconfirmation_filter=&rma_filter=&rebill_filter=&routing_filter=&sequence=1";

			$args = [
				'id' => 'limelight_admin_link',
				'title' => "<span class='ab-icon'></span><span class='ab-label'></span>",
				'href' => $limelight_address,
				'meta' => array(
					'target' => '_blank',
					'class' => '123admin-adminbar-limelight',
					'title' => 'LimeLight Custom Link'
				),
			];
			$wp_admin_bar->add_node($args);
		}
		add_action( 'admin_bar_menu', 'add_limelight_custom_link', 999);
		


		add_action( 'admin_enqueue_scripts', 'custom_wp_toolbar_css_admin' );
		add_action( 'wp_enqueue_scripts', 'custom_wp_toolbar_css_admin' );
		 
		function custom_wp_toolbar_css_admin() {
		    if( current_user_can( 'edit_theme_options' ) ){
		        wp_register_style( 'add_custom_wp_toolbar_css', plugin_dir_url( __FILE__ ) . '123admin-adminbar-limelight.css','','', 'screen' );
		        wp_enqueue_style( 'add_custom_wp_toolbar_css' );
		    }
		}


 ?>