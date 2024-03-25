<?php 
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to content the public-facing aspects of the plugin.
 *
 * @link       https://webmkit.com
 * @since      1.0.0
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/public/partials
 */

if(is_user_logged_in()):

	ob_start();
	include_once plugin_dir_path( __FILE__ ).'dashboard/design.php';
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
	
else:

	ob_start();
	include_once plugin_dir_path( __FILE__ ).'dashboard/login.php';
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;

endif;
