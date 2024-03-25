<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webmkit.com
 * @since             1.0.0
 * @package           Mts_Client_Portal
 *
 * @wordpress-plugin
 * Plugin Name:       MTS Client Portal
 * Plugin URI:        https://webmkit.com/mts-client-portal
 * Description:       MTS Client Portal plugin will used to manage client portal.
 * Version:           1.0.0
 * Author:            webmk
 * Author URI:        https://webmkit.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mts-client-portal
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MTS_CLIENT_PORTAL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mts-client-portal-activator.php
 */
function activate_mts_client_portal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mts-client-portal-activator.php';
	Mts_Client_Portal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mts-client-portal-deactivator.php
 */
function deactivate_mts_client_portal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mts-client-portal-deactivator.php';
	Mts_Client_Portal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mts_client_portal' );
register_deactivation_hook( __FILE__, 'deactivate_mts_client_portal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mts-client-portal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mts_client_portal() {

	$plugin = new Mts_Client_Portal();
	$plugin->run();

}
run_mts_client_portal();
