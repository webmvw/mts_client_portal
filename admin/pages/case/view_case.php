<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Case List</h1>
		<a href="admin.php?page=mts_case&action=add" class="page-title-action">Add Case</a>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
		    <table id="dataTable" class="display responsive nowrap">
		    	<thead>
		    		<tr>
		    			<th>SL</th>
		    			<th>Case Number</th>
		    			<th>Lost Amount</th>
		    			<th>Recovered founds</th>
		    			<th>Liquidity</th>
		    			<th>Required Amount For Liquidity</th>
		    			<th>full Withdrawal Balance</th>
		    			<th>Willer Address</th>
		    			<th>Client</th>
		    			<th>Status</th>
		    			<th>Action</th>
		    		</tr>
		    	</thead>
		    	<tbody>
		    		<?php
		    		if(count($cases) > 0){
		    			foreach($cases as $key=>$value){
		    				?>
		    				<tr>
		    					<td><?php echo ($key+1) ?></td>
		    					<td><?php echo $value->case_number; ?></td>
		    					<td><?php echo $value->lost_amount; ?></td>
		    					<td><?php echo $value->recovered_founds; ?></td>
		    					<td><?php echo $value->liquidity; ?></td>
		    					<td><?php echo $value->required_amount_of_liquidity; ?></td>
		    					<td><?php echo $value->full_withdrawal_balance; ?></td>
		    					<td><?php echo $value->willer_address; ?></td>
		    					<td>
		    						<?php
		    						$user = get_user_by('id',$value->client_id);
		    						echo $user->user_login;
		    						?>	
		    					</td>
		    					<td><?php echo $value->status; ?></td>
		    					<td>
		    						<a href="<?php echo admin_url('admin.php?page=mts_case&action=edit&id='.$value->id); ?>" class="btn btn-info"><span class="dashicons dashicons-edit-page"></span></a> &nbsp;&nbsp;|&nbsp;&nbsp;
		    						<a href="<?php echo admin_url('admin.php?page=mts_case&action=delete&id='.$value->id); ?>" onclick="return confirm('Are you sure to delete it?');" class="btn btn-danger"><span class="dashicons dashicons-trash" style="color:red"></span></a>
		    					</td>
		    				</tr>
			    			<?php
			    		}
		    		}
		    		?>
		    	</tbody>
		    	<tfoot>
		    		<tr>
		    			<th>SL</th>
		    			<th>Case Number</th>
		    			<th>Lost Amount</th>
		    			<th>Recovered founds</th>
		    			<th>Liquidity</th>
		    			<th>Required Amount For Liquidity</th>
		    			<th>full Withdrawal Balance</th>
		    			<th>Willer Address</th>
		    			<th>Client</th>
		    			<th>Status</th>
		    			<th>Action</th>
		    		</tr>
		    	</tfoot>
		    </table>
		</div>
	</div>
</div>
<script>
	let table = new DataTable('#dataTable');
</script>