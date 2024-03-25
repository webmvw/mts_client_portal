<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webmkit.com
 * @since      1.0.0
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mts_Client_Portal
 * @subpackage Mts_Client_Portal/admin
 * @author     webmk <masudrana.bbpi@gmail.com>
 */
class Mts_Client_Portal_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		$valid_page = array('mts_client_portal', 'mts_case', 'mts_deposit','mts_withdraw', 'mts_document',);
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

		if( in_array($page, $valid_page)){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mts-client-portal-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( "dataTables", plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
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

		$valid_page = array('mts_client_portal', 'mts_case', 'mts_deposit','mts_withdraw', 'mts_document',);
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

		if( in_array($page, $valid_page)){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mts-client-portal-admin.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( "dataTables", plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
		}

	}


	/**
	 * Redirect after logout
	 *
	 * @since    1.0.0
	 */
	public function redirect_after_logout(){
		// wp_redirect( 'http://example.com' );
		wp_redirect(home_url('client_portal'));
  		exit();
	}



	/**
	 * Remove admin bar for without administrator
	 *
	 * @since    1.0.0
	 */
	public function mts_client_portal_remove_admin_bar(){
		if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}



	/**
	 * Register admin menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function mts_client_portal_admin_menu(){
		add_menu_page( "MTS Client Portal", "MTS Client Portal", "manage_options", "mts_client_portal", array($this, 'mts_client_portal_dashboard') );
		add_submenu_page( "mts_client_portal", "Dashboard", "Dashboard", "manage_options", "mts_client_portal", array($this, 'mts_client_portal_dashboard') );
		add_submenu_page( "mts_client_portal", "User List", "User List", "manage_options", "mts_user_list", array($this, 'callback_mts_user_list') );
		add_submenu_page( "mts_client_portal", "Case", "Case", "manage_options", "mts_case", array($this, 'callback_mts_case') );
		add_submenu_page( "mts_client_portal", "Deposit", "Deposit", "manage_options", "mts_deposit", array($this, 'callback_mts_deposit') );
		add_submenu_page( "mts_client_portal", "Withdraw", "Withdraw", "manage_options", "mts_withdraw", array($this, 'callback_mts_withdraw') );
		add_submenu_page( "mts_client_portal", "Document", "Document", "manage_options", "mts_document", array($this, 'callback_mts_document') );
	}



	/**
	 * MTS client portal dashboard page.
	 *
	 * @since    1.0.0
	 */
	public function mts_client_portal_dashboard(){
    	ob_start();
		include plugin_dir_path( __FILE__ ). 'pages/dashboard.php';
		$content = ob_get_contents();
		ob_end_clean();
		echo $content;
	}



	/**
	 * MTS client portal user list page.
	 *
	 * @since    1.0.0
	 */
	public function callback_mts_user_list(){
		wp_redirect( site_url().'/wp-admin/users.php' );
	}


	/**
	 * MTS client portal case page.
	 *
	 * @since    1.0.0
	 */
	public function callback_mts_case(){
		global $wpdb;
		$cases = $wpdb->get_results(
			"SELECT * FROM {$wpdb->prefix}mts_client_portal_case ORDER BY id DESC"
		);

		$action = isset($_GET['action']) ? $_GET['action'] : 'list';
        switch($action){
        	case 'add':
                $template = plugin_dir_path( __FILE__ ). 'pages/case/add_case.php';
                break;

        	case 'edit':
                $template = plugin_dir_path( __FILE__ ). 'pages/case/edit_case.php';
                break;

            case 'delete':
                $template = plugin_dir_path( __FILE__ ). 'pages/case/delete_case.php';
                break;

            default:
                $template = plugin_dir_path( __FILE__ ) . 'pages/case/view_case.php';
                break;
        }

        if(file_exists($template)){
        	ob_start();
			include $template;
			$content = ob_get_contents();
			ob_end_clean();
			echo $content;
        }
	}



	/**
	 * MTS client portal Deposit page.
	 *
	 * @since    1.0.0
	 */
	public function callback_mts_deposit(){
		global $wpdb;
		$deposits = $wpdb->get_results(
			"SELECT * FROM {$wpdb->prefix}mts_client_portal_deposit ORDER BY id DESC"
		);

		$action = isset($_GET['action']) ? $_GET['action'] : 'list';
        switch($action){
        	case 'add':
                $template = plugin_dir_path( __FILE__ ). 'pages/deposit/add_deposit.php';
                break;

        	case 'edit':
                $template = plugin_dir_path( __FILE__ ). 'pages/deposit/edit_deposit.php';
                break;

            case 'delete':
                $template = plugin_dir_path( __FILE__ ). 'pages/deposit/delete_deposit.php';
                break;

            default:
                $template = plugin_dir_path( __FILE__ ) . 'pages/deposit/view_deposit.php';
                break;
        }

        if(file_exists($template)){
        	ob_start();
			include $template;
			$content = ob_get_contents();
			ob_end_clean();
			echo $content;
        }
	}



	/**
	 * MTS client portal Withdraw page.
	 *
	 * @since    1.0.0
	 */
	public function callback_mts_withdraw(){
		global $wpdb;
		$withdraws = $wpdb->get_results(
			"SELECT * FROM {$wpdb->prefix}mts_client_portal_withdraw ORDER BY id DESC"
		);

		$action = isset($_GET['action']) ? $_GET['action'] : 'list';
        switch($action){
        	case 'add':
                $template = plugin_dir_path( __FILE__ ). 'pages/withdraw/add_withdraw.php';
                break;

        	case 'edit':
                $template = plugin_dir_path( __FILE__ ). 'pages/withdraw/edit_withdraw.php';
                break;

            case 'delete':
                $template = plugin_dir_path( __FILE__ ). 'pages/withdraw/delete_withdraw.php';
                break;

            default:
                $template = plugin_dir_path( __FILE__ ) . 'pages/withdraw/view_withdraw.php';
                break;
        }

        if(file_exists($template)){
        	ob_start();
			include $template;
			$content = ob_get_contents();
			ob_end_clean();
			echo $content;
        }
	}


	/**
	 * MTS client portal document page.
	 *
	 * @since    1.0.0
	 */
	public function callback_mts_document(){
		global $wpdb;
		$documents = $wpdb->get_results(
			"SELECT * FROM {$wpdb->prefix}mts_client_portal_document ORDER BY id DESC"
		);

		$action = isset($_GET['action']) ? $_GET['action'] : 'list';
        switch($action){
        	case 'add':
                $template = plugin_dir_path( __FILE__ ). 'pages/document/add_document.php';
                break;

        	case 'edit':
                $template = plugin_dir_path( __FILE__ ). 'pages/document/edit_document.php';
                break;

            case 'delete':
                $template = plugin_dir_path( __FILE__ ). 'pages/document/delete_document.php';
                break;

            default:
                $template = plugin_dir_path( __FILE__ ) . 'pages/document/view_document.php';
                break;
        }

        if(file_exists($template)){
        	ob_start();
			include $template;
			$content = ob_get_contents();
			ob_end_clean();
			echo $content;
        }
	}


}
