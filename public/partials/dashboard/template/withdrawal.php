
<div class="mts_client_portal_dashbaord_main_content_title">
	<h2>Dashboard -> <span>Withdrawal</span></h2>
</div>

<?php
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$get_withdraw = $wpdb->get_row(
		"SELECT * FROM {$wpdb->prefix}mts_client_portal_withdraw WHERE client_id={$current_user_id} ORDER BY id DESC"
	);
?>


<div class="mts_client_portal_dashboard_main_content_details">
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Date</label>
			<input type="text" value="<?php echo (!empty($get_withdraw))? date("d M Y", strtotime($get_withdraw->date)):''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column">
			<label>Amount</label>
			<input type="text" value="<?php echo (!empty($get_withdraw)) ? $get_withdraw->amount : ''; ?>" readonly>
		</div>
	</div>
	<div class="mts_client_portal_form_row">
		<div class="mts_client_portal_form_column">
			<label>Status</label>
			<input type="text" value="<?php echo (!empty($get_withdraw))? $get_withdraw->status:''; ?>" readonly>
		</div>
		<div class="mts_client_portal_form_column"></div>
	</div>
</div>