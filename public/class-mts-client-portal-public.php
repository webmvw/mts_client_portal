<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://webmkit.com
 * @since      1.0.0
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/public
 * @author     webmk <masudrana.bbpi@gmail.com>
 */
class Mts_Client_Portal_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mts_Client_Portal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mts_Client_Portal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$valid_page = array('dashboard', 'profile_details', 'case', 'deposit', 'withdrawal', 'documents', 'reset_password');
		$page = isset($_REQUEST['page_action']) ? $_REQUEST['page_action'] : 'dashboard';

		if( in_array($page, $valid_page)){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mts-client-portal-public.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mts_Client_Portal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mts_Client_Portal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$valid_page = array('dashboard', 'profile_details', 'case', 'deposit', 'withdrawal', 'documents', 'reset_password');
		$page = isset($_REQUEST['page_action']) ? $_REQUEST['page_action'] : 'dashboard';

		if( in_array($page, $valid_page)){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mts-client-portal-public.js', array( 'jquery' ), $this->version, false );
		}

	}


	public function our_own_custom_page_template(){

		global $post;

		if($post->post_name == 'client_portal'){
			$page_template = plugin_dir_path( __FILE__ ). 'partials/client_portal_page_layout.php';
			return $page_template;
		}

	}


	public function load_client_portal_page_content(){

		ob_start();
		include_once plugin_dir_path( __FILE__ ).'partials/client_portal_page_content.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;

	}


}
