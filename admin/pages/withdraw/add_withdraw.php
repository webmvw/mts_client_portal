<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Add Withdraw</h1>
		<a href="admin.php?page=mts_withdraw&action=list" class="page-title-action">View Withdraw</a>
		<p>Create a new Withdraw and add them to this site for client.</p>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
			<form method="post">
				<table class="form-table" role="presentation">
					<tbody>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_date">Date</label></th>
							<td><input name="withdraw_date" type="date" id="withdraw_date" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_amount">Amount</label></th>
							<td><input name="withdraw_amount" type="number" id="withdraw_amount" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_client">Client</label></th>
							<td>
								<select name="withdraw_client" id="withdraw_client" required>
									<?php
									$args = array(
										'role__in' => array('subscriber')
									); 
									$users = get_users($args);
									foreach ($users as $key => $value) {
										echo "<option value='".$value->ID."'>".$value->user_login."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_status">Status</label></th>
							<td>
								<select name="withdraw_status" id="withdraw_status" required>
									<option value="Approved">Approved</option>
									<option value="Processing">Processing</option>
									<option value="Reject">Reject</option>
									<option value="The Client">The Client</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php wp_nonce_field('new_withdraw'); ?>
				<p class="submit"><input type="submit" name="createWithdraw" class="button button-primary" value="Add New Withdraw"></p>
			</form>

			<?php
			/** 
			 * submit post
			 */
			if(! isset($_POST['createWithdraw'])){
		        return;
		    }

		    if(! wp_verify_nonce($_POST['_wpnonce'], 'new_withdraw')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }

		    if(! current_user_can('manage_options')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }
			if(isset($_POST['createWithdraw'])){

				$withdraw_date = isset($_POST['withdraw_date']) ? sanitize_text_field($_POST['withdraw_date']) : '';
				$data['withdraw_date'] = date('Y-m-d', strtotime($withdraw_date));
		        $data['withdraw_amount'] = isset($_POST['withdraw_amount']) ? sanitize_text_field($_POST['withdraw_amount']) : '';
		        $data['withdraw_client'] = isset($_POST['withdraw_client']) ? sanitize_text_field($_POST['withdraw_client']) : '';
		        $data['withdraw_status'] = isset($_POST['withdraw_status']) ? sanitize_text_field($_POST['withdraw_status']) : '';

				global $wpdb;

				if($data['withdraw_date'] == '' || $data['withdraw_amount'] == '' || $data['withdraw_client'] == '' || $data['withdraw_status'] == ''){
					echo "All Field Are Required";
				}else{

					$inserted = $wpdb->insert("{$wpdb->prefix}mts_client_portal_withdraw", array(
					    'date' => $data['withdraw_date'],
					    'amount' => $data['withdraw_amount'],
					    'client_id' => $data['withdraw_client'], 
					    'status' => $data['withdraw_status'] 
					));

					if($inserted){
						echo '<div style="color:green;font-size:18px;" role="alert">Data Insert Success</div>';
					}else{
						echo '<div style="color:red;font-size:18px;" role="alert">Data Not Insert</div>';
					}
				}
			}
			?>

		</div>
	</div>
</div>
