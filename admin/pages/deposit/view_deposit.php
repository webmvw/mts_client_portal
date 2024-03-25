<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Deposit List</h1>
		<a href="admin.php?page=mts_deposit&action=add" class="page-title-action">Add Deposit</a>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
		    <table id="dataTable" class="display responsive nowrap">
		    	<thead>
		    		<tr>
		    			<th>SL</th>
		    			<th>Date</th>
		    			<th>Amonut</th>
		    			<th>Client</th>
		    			<th>Status</th>
		    			<th>Action</th>
		    		</tr>
		    	</thead>
		    	<tbody>
		    		<?php
		    		if(count($deposits) > 0){
		    			foreach($deposits as $key=>$value){
		    				?>
		    				<tr>
		    					<td><?php echo ($key+1) ?></td>
		    					<td><?php echo date("d M Y", strtotime($value->date)); ?></td>
		    					<td><?php echo $value->amount; ?></td>
		    					<td>
		    						<?php
		    						$user = get_user_by('id',$value->client_id);
		    						echo $user->user_login;
		    						?>	
		    					</td>
		    					<td><?php echo $value->status; ?></td>
		    					<td>
		    						<a href="<?php echo admin_url('admin.php?page=mts_deposit&action=edit&id='.$value->id); ?>" class="btn btn-info"><span class="dashicons dashicons-edit-page"></span></a> &nbsp;&nbsp;|&nbsp;&nbsp;
		    						<a href="<?php echo admin_url('admin.php?page=mts_deposit&action=delete&id='.$value->id); ?>" onclick="return confirm('Are you sure to delete it?');" class="btn btn-danger"><span class="dashicons dashicons-trash" style="color:red"></span></a>
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
		    			<th>Date</th>
		    			<th>Amonut</th>
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