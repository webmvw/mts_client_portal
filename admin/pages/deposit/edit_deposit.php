
<?php
  	if(isset($_GET['page']) == 'mts_deposit' && isset($_GET['action']) && $_GET['action']== 'edit' && isset($_GET['id'])){
  		$edit_id = $_GET['id'];

  		global $wpdb;

  		$get_deposit = $wpdb->get_row(
			"SELECT * FROM {$wpdb->prefix}mts_client_portal_deposit WHERE id={$edit_id} ORDER BY id DESC"
		);
  	}
?>


<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Edit Deposit</h1>
		<a href="admin.php?page=mts_deposit&action=list" class="page-title-action">View Deposit</a>
		<p>Update deposit data for client</p>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
			<form method="post">
				<table class="form-table" role="presentation">
					<tbody>
						<tr class="form-field form-required">
							<th scope="row"><label for="deposit_date">Date</label></th>
							<td><input name="deposit_date" type="date" value="<?php echo $get_deposit->date ?>" id="deposit_date"></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="deposit_amount">Amount</label></th>
							<td><input name="deposit_amount" type="number" value="<?php echo $get_deposit->amount ?>" id="deposit_amount"></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="deposit_client">Client</label></th>
							<td>
								<select name="deposit_client" id="deposit_client">
									<?php
									$args = array(
										'role__in' => array('subscriber')
									); 
									$users = get_users($args);
									foreach ($users as $key => $value) {
										$selected = ($get_deposit->client_id == $value->ID) ? 'selected' : ''; 
										echo "<option value='".$value->ID."' ".$selected.">".$value->user_login."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="deposit_status">Status</label></th>
							<td>
								<select name="deposit_status" id="deposit_status">
									<option value="Approved" <?php echo ($get_deposit->status == 'Approved') ? 'selected' : '';?>>Approved</option>
									<option value="Processing" <?php echo ($get_deposit->status == 'Processing') ? 'selected' : '';?>>Processing</option>
									<option value="Reject" <?php echo ($get_deposit->status == 'Reject') ? 'selected' : '';?>>Reject</option>
									<option value="The Client" <?php echo ($get_deposit->status == 'The Client') ? 'selected' : '';?>>The Client</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php wp_nonce_field('update_deposit'); ?>
				<p class="submit"><input type="submit" name="updateDeposit" class="button button-primary" value="Update Deposit"></p>
			</form>

			<?php
			/** 
			 * submit post
			 */
			if(! isset($_POST['updateDeposit'])){
		        return;
		    }

		    if(! wp_verify_nonce($_POST['_wpnonce'], 'update_deposit')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }

		    if(! current_user_can('manage_options')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }
			if(isset($_POST['updateDeposit'])){

				$deposit_date = isset($_POST['deposit_date']) ? sanitize_text_field($_POST['deposit_date']) : '';
				$data['deposit_date'] = date('Y-m-d', strtotime($deposit_date));
		        $data['deposit_amount'] = isset($_POST['deposit_amount']) ? sanitize_text_field($_POST['deposit_amount']) : '';
		        $data['deposit_client'] = isset($_POST['deposit_client']) ? sanitize_text_field($_POST['deposit_client']) : '';
		        $data['deposit_status'] = isset($_POST['deposit_status']) ? sanitize_text_field($_POST['deposit_status']) : '';

				global $wpdb;

				if($data['deposit_date'] == '' || $data['deposit_amount'] == '' || $data['deposit_client'] == '' || $data['deposit_status'] == ''){
					echo "All Field Are Required";
				}else{
					$deposit_updated = $wpdb->update( 
						"{$wpdb->prefix}mts_client_portal_deposit",
						array(
							'date'=>$data['deposit_date'], 
							'amount'=>$data['deposit_amount'], 
							'client_id'=>$data['deposit_client'], 
							'status'=>$data['deposit_status']
						),	
						array( 'ID' => $edit_id ) 
					);

					if($deposit_updated){
						echo '<div style="color:green;font-size:18px;" role="alert">Data Update Success</div>';
					}else{
						echo '<div style="color:red;font-size:18px;" role="alert">Data Not Update</div>';
					}
				}
			}
			?>

		</div>
	</div>
</div>