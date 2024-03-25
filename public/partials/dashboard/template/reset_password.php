
<div class="mts_client_portal_dashbaord_main_content_title">
	<h2>Dashboard -> <span>Reset Password</span></h2>
</div>


<div class="mts_client_portal_dashboard_main_content_details">
	<form method="post">
		<div class="mts_client_portal_form_row">
			<div class="mts_client_portal_form_column">
				<label>Set New Password</label>
				<input type="password" name="new_password" minlength="8" maxlength="25" placeholder="password">
				<?php wp_nonce_field('new_password'); ?>
				<input type="submit" name="resetPassword" class="mts_client_portal_submit_btn" value="Reset">
				<ul>
					<li>password minimum length should be 8</li>
					<li>at least one uppercase letter</li>
					<li>at least one lowercase letter</li>
					<li>and one digit</li>
				</ul>
			</div>
			<div class="mts_client_portal_form_column"></div>
		</div>
	</form>
	<?php
	/** 
	 * submit post
	 */
	if(! isset($_POST['resetPassword'])){
        return;
    }

    if(! wp_verify_nonce($_POST['_wpnonce'], 'new_password')){
        wp_die('<div class="alert alert-warning" role="alert">Are you cheating?</div>');
    }

	if(isset($_POST['resetPassword'])){

		$new_password = isset($_POST['new_password']) ? sanitize_text_field($_POST['new_password']) : '';
		$current_user_id = wp_get_current_user()->ID;

		$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'; 
		  
		if (preg_match($pattern, $new_password)) { 
			if(strlen($new_password) >= '25'){
				echo "<span style='color:red'>Password should not exceed 25 characters.</span>";
			}else{
			    wp_set_password( $new_password, $current_user_id );
				echo "<span style='color:green;'>Your password reset successfully. Please refresh or reload your browser and login again.</span>";
				$url=site_url();
    			header("Refresh: 5; URL={$url}");
			}
		} else { 
		    echo "<span style='color:red'>Invalid Password</span>";	
		}
	}
	?>	
</div>

