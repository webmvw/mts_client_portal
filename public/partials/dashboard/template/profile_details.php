
<div class="mts_client_portal_dashbaord_main_content_title">
	<h2>Dashboard -> <span>Profile Details<span></h2>
</div>

<div class="mts_client_portal_dashboard_main_content_details">
	<?php $current_user = wp_get_current_user();?>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Username</label>
			<input type="text" value="<?php echo $current_user->user_login; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Email</label>
			<input type="text" value="<?php echo $current_user->user_email; ?>" readonly>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>First Name</label>
			<input type="text" value="<?php echo $current_user->user_firstname; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Last Name</label>
			<input type="text" value="<?php echo $current_user->user_lastname; ?>" readonly>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<fieldset>
				<legend>Biographical Info</legend>
				<p><?php echo $current_user->description; ?></p>
			</fieldset>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<p>Forget your password? Don't worry, <a href="<?php echo site_url().'/client_portal?page_action=reset_password'; ?>" style="color:#06A37E">Reset your password</a> here.</p>
		</div>
	</div>
</div>