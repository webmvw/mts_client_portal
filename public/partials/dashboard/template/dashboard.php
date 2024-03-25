
<div class="mts_client_portal_dashbaord_main_content_title">
	<?php $current_user = wp_get_current_user();?>
	<h2>Dashboard -> <span><?php echo $current_user->user_login; ?><span></h2>
</div>

<div class="mts_client_portal_dashboard_main_content_details">
	<h2>My Profile</h2>
	<p style="margin-bottom: 10px;">Customize your data and preferences on the profile page it contains information about case, documents, deposit, withdrawal etc.</p>
	<div class="mts_client_portal_dashboard_quick_links">
		<div class="mts_client_portal_dashboard_quick_links_item">
			<a href="<?php echo site_url().'/client_portal?page_action=profile_details'; ?>">
				<img src="<?php echo plugins_url().'/mts-client-portal/public/img/user.png';?>" alt="profile_link">
				<h3>Profile</h3>
			</a>
		</div>
		<div class="mts_client_portal_dashboard_quick_links_item">
			<a href="<?php echo site_url().'/client_portal?page_action=deposit'; ?>">
				<img src="<?php echo plugins_url().'/mts-client-portal/public/img/save-money.png';?>" alt="profile_link">
				<h3>Deposit</h3>
			</a>
		</div>
		<div class="mts_client_portal_dashboard_quick_links_item">
			<a href="<?php echo site_url().'/client_portal?page_action=withdrawal'; ?>">
				<img src="<?php echo plugins_url().'/mts-client-portal/public/img/withdrawal.png';?>" alt="profile_link">
				<h3>withdrawal</h3>
			</a>
		</div>
		<div class="mts_client_portal_dashboard_quick_links_item">
			<a href="<?php echo site_url().'/client_portal?page_action=case'; ?>">
				<img src="<?php echo plugins_url().'/mts-client-portal/public/img/file-case.png';?>" alt="profile_link">
				<h3>Case</h3>
			</a>
		</div>
		<div class="mts_client_portal_dashboard_quick_links_item">
			<a href="<?php echo site_url().'/client_portal?page_action=documents'; ?>">
				<img src="<?php echo plugins_url().'/mts-client-portal/public/img/google-docs.png';?>" alt="profile_link">
				<h3>Document</h3>
			</a>
		</div>
		<div class="mts_client_portal_dashboard_quick_links_item">
			<a href="<?php echo wp_logout_url(); ?>">
				<img src="<?php echo plugins_url().'/mts-client-portal/public/img/logout.png';?>" alt="profile_link">
				<h3>Log Out</h3>
			</a>
		</div>
	</div>
</div>