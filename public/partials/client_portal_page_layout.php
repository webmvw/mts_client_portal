<?php 
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to layout the public-facing aspects of the plugin.
 *
 * @link       https://webmkit.com
 * @since      1.0.0
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/public/partials
 */

get_header();

do_action('mts_client_portal_before_page');

do_shortcode( "[render_client_portal_page]" );

do_action('mts_client_portal_after_page');

get_footer();