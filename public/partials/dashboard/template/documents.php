
<div class="mts_client_portal_dashbaord_main_content_title">
	<h2>Dashboard -> <span>Documents</span></h2>
</div>


<div class="mts_client_portal_dashboard_main_content_details">
	<form enctype="multipart/form-data" method="post">
		<div class="mts_client_portal_form_row">
			<div class="mts_client_portal_form_column">
				<label>ID Front Side</label>
				<input type="file" name="mts_client_portal_documents_id_front_side" required>
			</div>
			<div class="mts_client_portal_form_column">
				<label>ID Back Side</label>
				<input type="file" name="mts_client_portal_documents_id_back_side" required>
			</div>
		</div>
		<div class="mts_client_portal_form_row">
			<div class="mts_client_portal_form_column">
				<label>Other document</label>
				<input type="file" name="mts_client_portal_documents_other_document" required>
			</div>
			<div class="mts_client_portal_form_column"></div>
		</div>
		<?php wp_nonce_field('new_document'); ?>
		<input type="submit" name="submitDocument" class="mts_client_portal_submit_btn" value="Save">
	</form>
	<?php
	/** 
	 * submit post
	 */
	if(! isset($_POST['submitDocument'])){
        return;
    }

    if(! wp_verify_nonce($_POST['_wpnonce'], 'new_document')){
        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
    }

	if(isset($_POST['submitDocument'])){

        $data['id_front_side'] = isset($_FILES['mts_client_portal_documents_id_front_side']) ? $_FILES['mts_client_portal_documents_id_front_side'] : '';
        $data['id_back_side'] = isset($_FILES['mts_client_portal_documents_id_back_side']) ? $_FILES['mts_client_portal_documents_id_back_side'] : '';
        $data['other_document'] = isset($_FILES['mts_client_portal_documents_other_document']) ? $_FILES['mts_client_portal_documents_other_document'] : '';

		global $wpdb;

		if($data['id_front_side'] == '' || $data['id_back_side'] == '' || $data['other_document'] == ''){
			echo "All Field Are Required";
		}else{

			$id_front_side_url = handle_logo_upload($data['id_front_side']); 
			$id_back_side_url = handle_logo_upload($data['id_back_side']); 
			$other_document_url = handle_logo_upload($data['other_document']); 

			$current_user = wp_get_current_user();
			$current_user_id = $current_user->ID;


			$inserted = $wpdb->insert("{$wpdb->prefix}mts_client_portal_document", array(
			    'id_front_side' => $id_front_side_url,
			    'id_back_side' => $id_back_side_url,
			    'other_document' => $other_document_url,
			    'client_id' => $current_user_id, 
			    'status' => 'Processing'
			));

			if($inserted){
				echo '<div style="color:green;font-size:18px;" role="alert">File Upload Success</div>';
			}else{
				echo '<div style="color:red;font-size:18px;" role="alert">File Not Upload</div>';
			}
		}
	}


	function handle_logo_upload($file){ 
		require_once(ABSPATH.'wp-admin/includes/file.php'); 
		$uploadedfile = $file; 
		$movefile = wp_handle_upload($uploadedfile, array('test_form' => false)); 

		if ( $movefile ){ 
			return $movefile['url']; 
		} 
	}

	?>
</div>
