
<section class="mts_client_portal_dashboard">
	<div class="mts_client_portal_dashbaord_sidebar">
		<div class="mts_client_portal_dashboard_user_profile">
			<img src="<?php echo plugins_url().'/mts-client-portal/public/img/avatar.png';?>" alt="profile image">
			<?php
			$current_user = wp_get_current_user();
			?>
			<h3><?php echo $current_user->user_login; ?></h3>
		</div>
		<div class="mts_client_portal_dashboard_user_menu">
			<ul>
				<li>
					<a href="<?php echo site_url().'/client_portal?page_action=dashboard'; ?>" class="<?php echo (isset($_GET['page_action']) and $_GET['page_action'] == 'dashboard') ? 'active': ''; ?>">Dashboard</a>
				</li>
				<li>
					<a href="<?php echo site_url().'/client_portal?page_action=profile_details'; ?>" class="<?php echo (isset($_GET['page_action']) and $_GET['page_action'] == 'profile_details') ? 'active': ''; ?>">Profile Details</a>
				</li>
				<li>
					<a href="<?php echo site_url().'/client_portal?page_action=case'; ?>" class="<?php echo (isset($_GET['page_action']) and $_GET['page_action'] == 'case') ? 'active': ''; ?>">Case</a>
				</li>
				<li>
					<a href="<?php echo site_url().'/client_portal?page_action=deposit'; ?>" class="<?php echo (isset($_GET['page_action']) and $_GET['page_action'] == 'deposit') ? 'active': ''; ?>">Deposit</a>
				</li>
				<li>
					<a href="<?php echo site_url().'/client_portal?page_action=withdrawal'; ?>" class="<?php echo (isset($_GET['page_action']) and $_GET['page_action'] == 'withdrawal') ? 'active': ''; ?>">Withdraw</a>
				</li>
				<li>
					<a href="<?php echo site_url().'/client_portal?page_action=documents'; ?>" class="<?php echo (isset($_GET['page_action']) and $_GET['page_action'] == 'documents') ? 'active': ''; ?>">Document</a>
				</li>
				<li><a href="<?php echo wp_logout_url(); ?>" >Logout</a></li>
			</ul>
		</div>
	</div>
	<div class="mts_client_portal_dashbaord_main_content">

		<?php
			$action = isset($_GET['page_action']) ? $_GET['page_action'] : 'dashboard';
	        switch($action){
	        	case 'case':
	                $template = plugin_dir_path( __FILE__ ). 'template/case.php';
	                break;

	            case 'deposit':
	                $template = plugin_dir_path( __FILE__ ). 'template/deposit.php';
	                break;

	            case 'withdrawal':
	                $template = plugin_dir_path( __FILE__ ). 'template/withdrawal.php';
	                break;

	            case 'documents':
	                $template = plugin_dir_path( __FILE__ ). 'template/documents.php';
	                break;

	            case 'profile_details':
	                $template = plugin_dir_path( __FILE__ ). 'template/profile_details.php';
	                break;

	            case 'reset_password':
	            	$template = plugin_dir_path(__FILE__).'template/reset_password.php';
	            	break;

	            default:
	                $template = plugin_dir_path( __FILE__ ) . 'template/dashboard.php';
	                break;
	        }

	        if(file_exists($template)){
	            include $template;
	        }
		?>
	</div>
</section>