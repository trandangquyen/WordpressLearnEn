<?php
	
if( !empty( $_GET['stm_check_donation_ipn'] ) ) {
	
	header('HTTP/1.1 200 OK');
	checkPayment( $_REQUEST );

	exit;
}

function paypal_url() {
	$donationOptions = get_theme_mod( 'donation_options' );
	$paypal_url      = ( $donationOptions['mode'] == 'live' ) ? 'www.paypal.com' : 'www.sandbox.paypal.com';

	return $paypal_url;
}

if( ! function_exists( 'generatePayment' ) ) {
	
	function generatePayment( $data ){

		if ( empty( $data['amount'] ) ) {
			$data['amount'] = 10;
		}

		$return['result'] = true;

		$donationOptions = get_theme_mod( 'donation_options' );

		$paypalEmail = $donationOptions['email'];

		$donor_data['post_title'] = $data['first_name'];
		$donor_data['post_type']  = 'donor';
		$donor_id                 = wp_insert_post( $donor_data );

		update_post_meta( $donor_id, 'donor_email', $data['email'] );
		update_post_meta( $donor_id, 'donor_phone', $data['phone'] );
		update_post_meta( $donor_id, 'donor_address', $data['address'] );
		update_post_meta( $donor_id, 'donor_note', $data['notes'] );
		update_post_meta( $donor_id, 'donor_amount', $data['amount'] );

		if( $data['donation_id'] == 0 ){
			update_post_meta( $donor_id, 'donor_donation', '' );
			$returnUrl            = home_url();
			$items['item_name']   = __( 'Site Donation', 'smarty' );
		}else{
			update_post_meta( $donor_id, 'donor_donation', get_the_title( $data['donation_id'] ) );
			$returnUrl            = get_permalink( $data['donation_id'] );
			$items['item_name']   = get_the_title( $data['donation_id'] );
		}

		$items['item_number'] = $data['donation_id'];
		$items['amount']      = $data['amount'];
		$items                = http_build_query( $items );

		$return = 'https://'.paypal_url() . '/cgi-bin/webscr?cmd=_xclick&business='.$paypalEmail.'&'. $items .'&no_shipping=1&no_note=1&currency_code='.$donationOptions['currency'].'&bn=PP%2dBuyNowBF&charset=UTF%2d8&invoice=' . $donor_id  . '&return=' . $returnUrl . '&rm=2&notify_url='.$returnUrl;
	
		return $return;
	
	}
}

if( ! function_exists( 'checkPayment' ) ){
	
	function checkPayment($data){

		$donationOptions = get_theme_mod( 'donation_options' );
	
		$item_name        = $data['item_name'];
		$item_number      = $data['item_number'];
		$payment_status   = $data['payment_status'];
		$payment_amount   = $data['mc_gross'];
		$payment_currency = $data['mc_currency'];
		$txn_id           = $data['txn_id'];
		$receiver_email   = $data['receiver_email'];
		$payer_email      = $data['payer_email'];
		$invoice          = $data['invoice'];
	
		$req = 'cmd=_notify-validate';
	
		foreach ($data as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req  .= "&$key=$value";
		}
	
		$ch = curl_init('https://'.paypal_url().'/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	
		if( !($res = curl_exec($ch)) ) {
			echo ("Got " . curl_error($ch) . " when processing IPN data");
			curl_close($ch);
			return false;
		}
		curl_close($ch);
	
		if (strcmp ($res, "VERIFIED") == 0) {
	
			$mail_To      = get_option( 'admin_email' );
			$mail_Subject = "VERIFIED IPN";
			$mail_Body    = $req;
			//wp_mail($mail_To, $mail_Subject, $mail_Body);
	
	
			wp_update_post( array( 'ID'=>$invoice, 'post_status'=>'publish' ) );

			$donors = get_post_meta( $item_number, 'donation_donors', true );
			$donors = intval($donors);
			if( ! $donors ){
				$donors = 0;
			}
			$donors = $donors + 1;
			update_post_meta( $item_number, 'donation_donors', $donors );

			$raised = get_post_meta( $item_number, 'donation_raised', true );
			$donor_amount = get_post_meta($invoice, 'donor_amount', true );
			$donor_amount = intval($donor_amount);

			$raised = intval($raised);
			if( ! $raised ){
				$raised = 0;
			}
			$raised = $raised + $donor_amount;
			update_post_meta( $item_number, 'donation_raised', $raised );

			$donation_options = get_theme_mod( 'donation_options' );
			$email_message_search = array( '[name]', '[amount]', '[cause]' );
			$email_message_replace = array( get_the_title( $invoice ), $donor_amount, '<a href="' . get_permalink( $item_number ) . '">' . get_the_title( $item_number ) . '</a>' );
			$admin_email_subject = $donation_options['admin_email_subject'];
			$admin_email_message = str_replace( $email_message_search, $email_message_replace, $donation_options['admin_email_message'] );
			$donor_email_subject = $donation_options['donor_email_subject'];
			$donor_email_message = str_replace( $email_message_search, $email_message_replace, $donation_options['donor_email_message'] );

			add_filter('wp_mail_content_type', 'set_html_content_type');

			$headers[] = 'From: ' . get_bloginfo('blogname') . ' <' . get_bloginfo('admin_email') . '>';

			wp_mail( get_bloginfo( 'admin_email' ), $admin_email_subject, nl2br( $admin_email_message ), $headers);

			wp_mail( get_post_meta( $invoice, 'donor_email', true ), $donor_email_subject, nl2br( $donor_email_message ), $headers);

			remove_filter('wp_mail_content_type', 'set_html_content_type');

			if( get_post_meta($invoice, 'donor_subscribe', true ) && get_post_meta($invoice, 'donor_email', true ) ){
				require_once("lib/mailchimp/Handling.class.php");
				Handling::handling_request_with_confirmation(get_post_meta($invoice, 'donor_email', true ), NULL);
			}
	
		}
		else if (strcmp ($res, "INVALID") == 0) {
	
			$mail_To      = get_option('admin_email');
			$mail_Subject = "INVALID IPN";
			$mail_Body    = $req;
	
			//wp_mail($mail_To, $mail_Subject, $mail_Body);
		}
	
	
	}
	
}

function set_html_content_type()
{
	return 'text/html';
}