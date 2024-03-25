<div class="wrap">
	<div class="container-fluid">
		<h1 class="wp-heading-inline">Document List</h1>
		<hr class="wp-header-end">
		<div class="mts_client_portal_backend_panel">
		    <table id="dataTable" class="display responsive nowrap">
		    	<thead>
		    		<tr>
		    			<th>SL</th>
		    			<th>ID Front Side</th>
		    			<th>ID Back Side</th>
		    			<th>Other Document</th>
		    			<th>Client</th>
		    			<th>Status</th>
		    			<th>Action</th>
		    		</tr>
		    	</thead>
		    	<tbody>
		    		<?php
		    		if(count($documents) > 0){
		    			foreach($documents as $key=>$value){
		    				?>
		    				<tr>
		    					<td><?php echo ($key+1) ?></td>
		    					<td><?php echo "<a href='".$value->id_front_side."' downlaod>Download</a>"; ?></td>
		    					<td><?php echo "<a href='".$value->id_back_side."' downlaod>download</a>"; ?></td>
		    					<td><?php echo "<a href='".$value->other_document."' downlaod>download</a>"; ?></td>
		    					<td>
		    						<?php
		    						$user = get_user_by('id',$value->client_id);
		    						echo $user->user_login;
		    						?>	
		    					</td>
		    					<td><?php echo $value->status; ?></td>
		    					<td>
		    						<a href="<?php echo admin_url('admin.php?page=mts_document&action=delete&id='.$value->id); ?>" onclick="return confirm('Are you sure to delete it?');" class="btn btn-danger"><span class="dashicons dashicons-trash" style="color:red"></span></a>
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
		    			<th>ID Front Side</th>
		    			<th>ID Back Side</th>
		    			<th>Other Document</th>
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