<div class="mts_client_portal_dashbaord_main_content_title">
	<h2>Dashboard -> <span>Case</span></h2>
</div>

<?php
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$get_case = $wpdb->get_row(
		"SELECT * FROM {$wpdb->prefix}mts_client_portal_case WHERE client_id={$current_user_id} ORDER BY id DESC"
	);
?>

<div class="mts_client_portal_dashboard_main_content_details">
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Case Number</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->case_number : ''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Lost Amount</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->lost_amount : ''; ?>" readonly>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Recovered Founds</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->recovered_founds : ''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Liquidity</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->liquidity : ''; ?>" readonly>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Required Amount for Liquidity</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->required_amount_of_liquidity : ''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Full withdrawal Balance</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->full_withdrawal_balance : ''; ?>" readonly>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Willer Address</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->willer_address : ''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Status</label>
			<input type="text" value="<?php echo (!empty($get_case)) ? $get_case->status : ''; ?>" readonly>
		</div>
	</div>
</div>