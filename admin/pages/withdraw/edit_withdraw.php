
<?php
  	if(isset($_GET['page']) == 'mts_withdraw' && isset($_GET['action']) && $_GET['action']== 'edit' && isset($_GET['id'])){
  		$edit_id = $_GET['id'];

  		global $wpdb;

  		$get_withdraw = $wpdb->get_row(
			"SELECT * FROM {$wpdb->prefix}mts_client_portal_withdraw WHERE id={$edit_id} ORDER BY id DESC"
		);
  	}
?>


<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Edit Withdraw</h1>
		<a href="admin.php?page=mts_withdraw&action=list" class="page-title-action">View Withdraw</a>
		<p>Update withdraw data for client</p>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
			<form method="post">
				<table class="form-table" role="presentation">
					<tbody>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_date">Date</label></th>
							<td><input name="withdraw_date" type="date" value="<?php echo $get_withdraw->date ?>" id="withdraw_date"></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_amount">Amount</label></th>
							<td><input name="withdraw_amount" type="number" value="<?php echo $get_withdraw->amount ?>" id="withdraw_amount"></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_client">Client</label></th>
							<td>
								<select name="withdraw_client" id="withdraw_client">
									<?php
									$args = array(
										'role__in' => array('subscriber')
									); 
									$users = get_users($args);
									foreach ($users as $key => $value) {
										$selected = ($get_withdraw->client_id == $value->ID) ? 'selected' : ''; 
										echo "<option value='".$value->ID."' ".$selected.">".$value->user_login."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="withdraw_status">Status</label></th>
							<td>
								<select name="withdraw_status" id="withdraw_status">
									<option value="Approved" <?php echo ($get_withdraw->status == 'Approved') ? 'selected' : '';?>>Approved</option>
									<option value="Processing" <?php echo ($get_withdraw->status == 'Processing') ? 'selected' : '';?>>Processing</option>
									<option value="Reject" <?php echo ($get_withdraw->status == 'Reject') ? 'selected' : '';?>>Reject</option>
									<option value="The Client" <?php echo ($get_withdraw->status == 'The Client') ? 'selected' : '';?>>The Client</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php wp_nonce_field('update_withdraw'); ?>
				<p class="submit"><input type="submit" name="updateWithdraw" class="button button-primary" value="Update Withdraw"></p>
			</form>

			<?php
			/** 
			 * submit post
			 */
			if(! isset($_POST['updateWithdraw'])){
		        return;
		    }

		    if(! wp_verify_nonce($_POST['_wpnonce'], 'update_withdraw')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }

		    if(! current_user_can('manage_options')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }
			if(isset($_POST['updateWithdraw'])){

				$withdraw_date = isset($_POST['withdraw_date']) ? sanitize_text_field($_POST['withdraw_date']) : '';
				$data['withdraw_date'] = date('Y-m-d', strtotime($withdraw_date));
		        $data['withdraw_amount'] = isset($_POST['withdraw_amount']) ? sanitize_text_field($_POST['withdraw_amount']) : '';
		        $data['withdraw_client'] = isset($_POST['withdraw_client']) ? sanitize_text_field($_POST['withdraw_client']) : '';
		        $data['withdraw_status'] = isset($_POST['withdraw_status']) ? sanitize_text_field($_POST['withdraw_status']) : '';

				global $wpdb;

				if($data['withdraw_date'] == '' || $data['withdraw_amount'] == '' || $data['withdraw_client'] == '' || $data['withdraw_status'] == ''){
					echo "All Field Are Required";
				}else{
					$withdraw_updated = $wpdb->update( 
						"{$wpdb->prefix}mts_client_portal_withdraw",
						array(
							'date'=>$data['withdraw_date'], 
							'amount'=>$data['withdraw_amount'], 
							'client_id'=>$data['withdraw_client'], 
							'status'=>$data['withdraw_status']
						),	
						array( 'ID' => $edit_id ) 
					);

					if($withdraw_updated){
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