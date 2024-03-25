<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Add Deposit</h1>
		<a href="admin.php?page=mts_deposit&action=list" class="page-title-action">View Deposit</a>
		<p>Create a new Deposit and add them to this site for client.</p>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
			<form method="post">
				<table class="form-table" role="presentation">
					<tbody>
						<tr class="form-field form-required">
							<th scope="row"><label for="deposit_date">Date</label></th>
							<td><input name="deposit_date" type="date" id="deposit_date" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="deposit_amount">Amount</label></th>
							<td><input name="deposit_amount" type="number" id="deposit_amount" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="deposit_client">Client</label></th>
							<td>
								<select name="deposit_client" id="deposit_client" required>
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
							<th scope="row"><label for="deposit_status">Status</label></th>
							<td>
								<select name="deposit_status" id="deposit_status" required>
									<option value="Approved">Approved</option>
									<option value="Processing">Processing</option>
									<option value="Reject">Reject</option>
									<option value="The Client">The Client</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php wp_nonce_field('new_deposit'); ?>
				<p class="submit"><input type="submit" name="createDeposit" class="button button-primary" value="Add New Deposit"></p>
			</form>

			<?php
			/** 
			 * submit post
			 */
			if(! isset($_POST['createDeposit'])){
		        return;
		    }

		    if(! wp_verify_nonce($_POST['_wpnonce'], 'new_deposit')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }

		    if(! current_user_can('manage_options')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }
			if(isset($_POST['createDeposit'])){

				$deposit_date = isset($_POST['deposit_date']) ? sanitize_text_field($_POST['deposit_date']) : '';
				$data['deposit_date'] = date('Y-m-d', strtotime($deposit_date));
		        $data['deposit_amount'] = isset($_POST['deposit_amount']) ? sanitize_text_field($_POST['deposit_amount']) : '';
		        $data['deposit_client'] = isset($_POST['deposit_client']) ? sanitize_text_field($_POST['deposit_client']) : '';
		        $data['deposit_status'] = isset($_POST['deposit_status']) ? sanitize_text_field($_POST['deposit_status']) : '';

				global $wpdb;

				if($data['deposit_date'] == '' || $data['deposit_amount'] == '' || $data['deposit_client'] == '' || $data['deposit_status'] == ''){
					echo "All Field Are Required";
				}else{

					$inserted = $wpdb->insert("{$wpdb->prefix}mts_client_portal_deposit", array(
					    'date' => $data['deposit_date'],
					    'amount' => $data['deposit_amount'],
					    'client_id' => $data['deposit_client'], 
					    'status' => $data['deposit_status'] 
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
