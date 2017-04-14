<?php

/************************
* Formelecious' dashboard 
*************************/

function wpformelicious_dashboard_page() {
ob_start(); ?>
        <div class="wrap">
            <h2>Welcome <?php echo $GLOBALS['current_user']->display_name;?>!</h2>
        </div>
    <?php
echo ob_get_clean();
}


function wpformelicious_dashboard_link() {
    add_menu_page('Formelicious dashboard', 'Formelicious', 'manage_options', 'wpformelicious-dashboard', 'wpformelicious_dashboard_page', plugins_url('images/emailicious-logo.png', __FILE__));
    add_submenu_page( 'wpformelicious-dashboard', 'Formelicious' . ' Dashboard', '<b style="color:#BE141F">Dashboard</b>', 'manage_options', 'wpformelicious-dashboard');
    add_submenu_page( 'wpformelicious-dashboard', 'Formelicious' . ' Form', '<b style="color:#BE141F">Create a form</b>', 'manage_options', 'wpformelicious-form-creation-tool', 'wpformelicious_form_creation_tool_HTML');
}

add_action( 'admin_menu', 'wpformelicious_dashboard_link');
