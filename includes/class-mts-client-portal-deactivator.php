<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://webmkit.com
 * @since      1.0.0
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/includes
 * @author     webmk <masudrana.bbpi@gmail.com>
 */
class Mts_Client_Portal_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		global $wpdb;

		// delete page when plugin deactivate
		$get_data = $wpdb->get_row(
			$wpdb->prepare("SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s", 'client_portal')
		); 
		$page_id = $get_data->ID;
		if($page_id > 0){
			wp_delete_post($page_id, true);
		}

	}

}
