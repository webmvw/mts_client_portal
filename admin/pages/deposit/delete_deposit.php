
<?php

if(isset($_GET['page']) == 'mts_deposit' && isset($_GET['action']) && $_GET['action']== 'delete' && isset($_GET['id'])){

	$delete_id = $_GET['id'];

	global $wpdb;

	$deleted = $wpdb->delete(
		"{$wpdb->prefix}mts_client_portal_deposit",
		array( 'ID' => $delete_id )
		);

	if($deleted){
		wp_redirect( admin_url().'admin.php?page=mts_deposit' );
	}else{
		echo '<div style="color:red;font-size:18px;">Data Not Deleted</div>';
	}

}
?>