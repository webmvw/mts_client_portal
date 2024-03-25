<?php

/**
 * Fired during plugin activation
 *
 * @link       https://webmkit.com
 * @since      1.0.0
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/includes
 * @author     webmk <masudrana.bbpi@gmail.com>
 */
class Mts_Client_Portal_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		/**
		 * Create plugin database
		 *
		 */

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		if( ! function_exists('dbDelta') ){
			require_once(ABSPATH. 'wp-admin/includes/upgrade.php');
		}

		$mts_deposit_table_query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}mts_client_portal_deposit`(
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`date` date DEFAULT NULL,
			`amount` varchar(250) DEFAULT NULL,
			`client_id` int(11) DEFAULT NULL,
			`status` varchar(250) DEFAULT NULL,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`id`)
		) $charset_collate";
		
		dbDelta( $mts_deposit_table_query );


		$mts_withdraw_table_query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}mts_client_portal_withdraw`(
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`date` date DEFAULT NULL,
			`amount` varchar(250) DEFAULT NULL,
			`client_id` int(11) DEFAULT NULL,
			`status` varchar(250) DEFAULT NULL,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`id`)
		) $charset_collate";
		
		dbDelta( $mts_withdraw_table_query );


		$mts_document_table_query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}mts_client_portal_document`(
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`id_front_side` varchar(250) DEFAULT NULL,
			`id_back_side` varchar(250) DEFAULT NULL,
			`other_document` varchar(250) DEFAULT NULL,
			`client_id` int(11) DEFAULT NULL,
			`status` varchar(250) DEFAULT NULL,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`id`)
		) $charset_collate";
		
		dbDelta( $mts_document_table_query );


		$mts_case_table_query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}mts_client_portal_case`(
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`case_number` varchar(250) DEFAULT NULL,
			`lost_amount` varchar(250) DEFAULT NULL,
			`recovered_founds` varchar(250) DEFAULT NULL,
			`liquidity` varchar(250) DEFAULT NULL,
			`required_amount_of_liquidity` varchar(250) DEFAULT NULL,
			`full_withdrawal_balance` varchar(250) DEFAULT NULL,
			`willer_address` varchar(250) DEFAULT NULL,
			`client_id` int(11) DEFAULT NULL,
			`status` varchar(250) DEFAULT NULL,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`id`)
		) $charset_collate";
		
		dbDelta( $mts_case_table_query );





		/**
		 * Create page when plugin active
		 *
		 */
		$post_arr_data = array(
			'post_title' => 'Client Portal',
			'post_name' => 'client_portal',
			'post_content' => '',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_type' => 'page'
		);
		wp_insert_post( $post_arr_data );

	}

}
