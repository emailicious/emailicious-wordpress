<?php

/**********************************************************
* use statements in order to utilize Emailicious PHP client
**********************************************************/
use Emailicious\Client;
use Emailicious\Subscribers\Subscriber;
use Emailicious\Subscribers\Exceptions\SubscriberConflict;
use Guzzle\Http\Exception\BadResponseException;

/************************
* Formelecious' dashboard 
*************************/

function wpformelicious_dashboard_page() {
ob_start(); ?>
        <div class="wrap">
        	<h1 class="wp-heading-inline">Formelecious</h1>
        	<a href="" class="page-title-action">Add New</a>
            <h4>Welcome <?php echo $GLOBALS['current_user']->display_name;?>!</h4>
        </div>
		<?php
		/*
		TODO:
		Dashboard content
		*/
echo ob_get_clean();
}


//instantiate the formelicious menu
function wpformelicious_dashboard_link() {
    add_menu_page('Formelicious dashboard', 'Formelicious', 'manage_options', 'wpformelicious-dashboard', 'wpformelicious_dashboard_page', plugins_url('images/emailicious-logo.png', __FILE__));
    add_submenu_page( 'wpformelicious-dashboard', 'Formelicious' . ' Dashboard', '<b style="color:#BE141F">Dashboard</b>', 'manage_options', 'wpformelicious-dashboard');
    //Add below code when tool is ready
    //add_submenu_page( 'wpformelicious-dashboard', 'Formelicious' . ' Form', '<b style="color:#BE141F">Create a form</b>', 'manage_options', 'wpformelicious-form-creation-tool', 'wpformelicious_form_creation_tool_HTML');
}

add_action( 'admin_menu', 'wpformelicious_dashboard_link');
