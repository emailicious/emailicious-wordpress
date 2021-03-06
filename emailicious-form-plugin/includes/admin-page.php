<?php

function wpformelicious_options_page() {

	//Get the current user info if it exists
	$formelicious_user_info = get_option('formelicious_user_info');
	if ($formelicious_user_info){
		/*
		*TO DO:
		*Call the same validation as below and if this validation pass 
		*consider the user as logged in.
		*/
		$GLOBALS['login_status']= true;
	}

ob_start(); ?>
        <div class="wrap">
        	<h1 class="wp-heading-inline">Formelecious settings</h1>
            <h4>Welcome <?php echo $GLOBALS['current_user']->display_name;?>!</h4>
            <?php if ($GLOBALS['login_status']== false): ?>
            <div class="row">
  				<div class="col-sm-4">
  					<div class="panel panel-default">
    					<div class="panel-heading">Emailicious API connection status</div>
    					<div class="panel-body">Not connected</div>
  					</div>
  				</div>
			</div>
			<?php elseif ($GLOBALS['login_status']== true): ?>
			<div class="row">
  				<div class="col-sm-4">
  					<div class="panel panel-success">
    					<div class="panel-heading">Emailicious API connection status</div>
    					<div class="panel-body">Connected</div>
  					</div>
  				</div>
			</div>
			<?php endif; ?>
			<form action="" method="post" autocomplete="off">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="username">Username</label>
						</th>
						<td>
							<p>
								<input class="regular-text" type="text" name="username" placeholder="example@emailicious.com" value="<?php echo isset($formelicious_user_info['username']) ? $formelicious_user_info['username'] : '' ?>" required/>
							</p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="account">Account</label>
						</th>
						<td>
							<p>
								<input class="regular-text" type="text" name="account" value="<?php echo isset($formelicious_user_info['account']) ? $formelicious_user_info['account'] : '' ?>" required/>
							</p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="password">Password</label>
						</th>
						<td>
							<p>
								<!-- We use a fake password field in order to disable chrome form auto filling -->
								<!-- This is a workaround. Make sure to change it if another option is more viable -->
								<label id="password_fake" for="password_fake">Password</label>
								<input type="password" name="password" id="password_fake" value="" />
								<input class="regular-text" type="password" name="password" id="password" data-toggle="password">
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
            	<input class="button button-primary" type="submit" name="dashboard-submit" value="Save Changes" />
            </P>
			</form>
			<?php

			// if the saving button is clicked...
    		if ( isset( $_POST['dashboard-submit'] ) ) { 
   				
    			/*	
    			TO DO:
    			Make sure to implement a validation for the credentials entered by the user.
    			Only consider the following code if the validation is sucessful. 
    			A solution would be to ping Emailicious with those credentials and check the 
    			server's response. If this validation does not pass, make sure to consider
    			the user as offline: $GLOBALS['login_status']= false; 
    			*/
    			
    			//Update user's info in database
        		$formelicious_user_info = array(
			        'username' => $_POST['username'],
			        'account' => $_POST['account'],
			        'password' => $_POST['password']
			    );
			    //Update information in wp_options table (depending on prefix chose by user) 
        		update_option('formelicious_user_info', $formelicious_user_info);

        		//Reassign NULL to our saving button 
        		$_POST['dashboard-submit'] = NULL;

        		//Clean the buffer in order to refresh the page
        		ob_clean();
        		wpformelicious_options_page();
			}
			?>
        </div>
		<?php
echo ob_get_clean();
}


function wpformelicious_options_link() {
     array_push($GLOBALS['wpformelicious_hook_suffix'], add_options_page('Formelicious options', 'Formelicious', 'manage_options', 'wpformelicious-options', 'wpformelicious_options_page'));
}

add_action( 'admin_menu', 'wpformelicious_options_link');

