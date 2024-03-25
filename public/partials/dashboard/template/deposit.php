
<div class="mts_client_portal_dashbaord_main_content_title">
	<h2>Dashboard -> <span>Deposit</span></h2>
</div>

<?php
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$get_deposit = $wpdb->get_row(
		"SELECT * FROM {$wpdb->prefix}mts_client_portal_deposit WHERE client_id={$current_user_id} ORDER BY id DESC"
	);
?>

<div class="mts_client_portal_dashboard_main_content_details">
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Date</label>

			<input type="text" value="<?php echo (!empty($get_deposit))? date("d M Y", strtotime($get_deposit->date)):''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Amount</label>
			<input type="text" value="<?php echo (!empty($get_deposit)) ? $get_deposit->amount : ''; ?>" readonly>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Status</label>
			<input type="text" value="<?php echo (!empty($get_deposit))? $get_deposit->status:''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column"></div>
	</div>
</div>