
<?php
  	if(isset($_GET['page']) == 'mts_case' && isset($_GET['action']) && $_GET['action']== 'edit' && isset($_GET['id'])){
  		$edit_id = $_GET['id'];

  		global $wpdb;

  		$get_case = $wpdb->get_row(
			"SELECT * FROM {$wpdb->prefix}mts_client_portal_case WHERE id={$edit_id} ORDER BY id DESC"
		);
  	}
?>


<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Edit Case</h1>
		<a href="admin.php?page=mts_case&action=list" class="page-title-action">View Case</a>
		<p>Update case data for client</p>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
			<form method="post">
				<table class="form-table" role="presentation">
					<tbody>
						<tr class="form-field form-required">
							<th scope="row"><label for="case_number">Case Number</label></th>
							<td><input name="case_number" type="text" id="case_number" value="<?php echo $get_case->case_number; ?>" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="lost_amount">Lost Amount</label></th>
							<td><input name="lost_amount" type="text" id="lost_amount" value="<?php echo $get_case->lost_amount; ?>" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="recovered_founds">Recovered Founds</label></th>
							<td><input name="recovered_founds" type="text" id="recovered_founds" value="<?php echo $get_case->recovered_founds; ?>" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="case_liquidity">Liquidity</label></th>
							<td><input name="case_liquidity" type="text" id="case_liquidity" value="<?php echo $get_case->liquidity; ?>" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="required_amount_of_liquidity">Required Amount of Liquidity</label></th>
							<td><input name="required_amount_of_liquidity" type="text" id="required_amount_of_liquidity" value="<?php echo $get_case->required_amount_of_liquidity; ?>" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="full_withdrawal_balance">Full Withdrawal Balance</label></th>
							<td><input name="full_withdrawal_balance" type="text" id="full_withdrawal_balance" value="<?php echo $get_case->full_withdrawal_balance; ?>" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="willer_address">Willer Address</label></th>
							<td><input name="willer_address" type="text" id="willer_address" value="<?php echo $get_case->willer_address; ?>" required></td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="case_client">Client</label></th>
							<td>
								<select name="case_client" id="case_client">
									<?php
									$args = array(
										'role__in' => array('subscriber')
									); 
									$users = get_users($args);
									foreach ($users as $key => $value) {
										$selected = ($get_case->client_id == $value->ID) ? 'selected' : ''; 
										echo "<option value='".$value->ID."' ".$selected.">".$value->user_login."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="form-field form-required">
							<th scope="row"><label for="case_status">Status</label></th>
							<td>
								<select name="case_status" id="case_status">
									<option value="Approved" <?php echo ($get_case->status == 'Approved') ? 'selected' : '';?>>Approved</option>
									<option value="Processing" <?php echo ($get_case->status == 'Processing') ? 'selected' : '';?>>Processing</option>
									<option value="Reject" <?php echo ($get_case->status == 'Reject') ? 'selected' : '';?>>Reject</option>
									<option value="The Client" <?php echo ($get_case->status == 'The Client') ? 'selected' : '';?>>The Client</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php wp_nonce_field('update_case'); ?>
				<p class="submit"><input type="submit" name="updateCase" class="button button-primary" value="Update Case"></p>
			</form>

			<?php
			/** 
			 * submit post
			 */
			if(! isset($_POST['updateCase'])){
		        return;
		    }

		    if(! wp_verify_nonce($_POST['_wpnonce'], 'update_case')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }

		    if(! current_user_can('manage_options')){
		        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
		    }
			if(isset($_POST['updateCase'])){

				$data['case_number'] = isset($_POST['case_number']) ? sanitize_text_field($_POST['case_number']) : '';
				$data['lost_amount'] = isset($_POST['lost_amount']) ? sanitize_text_field($_POST['lost_amount']) : '';
				$data['recovered_founds'] = isset($_POST['recovered_founds']) ? sanitize_text_field($_POST['recovered_founds']) : '';
				$data['liquidity'] = isset($_POST['case_liquidity']) ? sanitize_text_field($_POST['case_liquidity']) : '';
				$data['required_amount_of_liquidity'] = isset($_POST['required_amount_of_liquidity']) ? sanitize_text_field($_POST['required_amount_of_liquidity']) : '';
				$data['full_withdrawal_balance'] = isset($_POST['full_withdrawal_balance']) ? sanitize_text_field($_POST['full_withdrawal_balance']) : '';
				$data['willer_address'] = isset($_POST['willer_address']) ? sanitize_text_field($_POST['willer_address']) : '';
				$data['client_id'] = isset($_POST['case_client']) ? sanitize_text_field($_POST['case_client']) : '';
				$data['case_status'] = isset($_POST['case_status']) ? sanitize_text_field($_POST['case_status']) : '';


				global $wpdb;

				if($data['case_number'] == '' || $data['lost_amount'] == '' || $data['recovered_founds'] == '' || $data['liquidity'] == '' || $data['required_amount_of_liquidity'] == '' || $data['full_withdrawal_balance'] == '' || $data['willer_address'] == '' || $data['client_id'] == '' || $data['case_status'] == ''){
					echo "All Field Are Required";
				}else{
					$case_updated = $wpdb->update( 
						"{$wpdb->prefix}mts_client_portal_case",
						array(
							'case_number' => $data['case_number'],
						    'lost_amount' => $data['lost_amount'],
						    'recovered_founds' => $data['recovered_founds'],
						    'liquidity' => $data['liquidity'],
						    'required_amount_of_liquidity' => $data['required_amount_of_liquidity'],
						    'full_withdrawal_balance' => $data['full_withdrawal_balance'],
						    'willer_address' => $data['willer_address'],
						    'client_id' => $data['client_id'], 
						    'status' => $data['case_status'] 
						),	
						array( 'ID' => $edit_id ) 
					);

					if($case_updated){
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