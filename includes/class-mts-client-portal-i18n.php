<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://webmkit.com
 * @since      1.0.0
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/includes
 * @author     webmk <masudrana.bbpi@gmail.com>
 */
class Mts_Client_Portal_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mts-client-portal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
