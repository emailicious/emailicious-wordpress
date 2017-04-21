<?php
/*
  Plugin Name: Formelicious - Create Emailicious forms for Wordpress
  Description: Formelicious allows you to easily create Emailicious forms to grow your Emailicious list.
  Version: 1.0
  Author: Samuel Charette
*/



/************************
* global variables
*************************/
add_action( 'plugins_loaded', 'get_user_info' ); // loading /wp-includes/pluggable.php which contains the function wp_get_current_user()
function get_user_info(){
    $GLOBALS['current_user'] = wp_get_current_user(); // setting current user as global
}

/****
* We make a global variable in order to keep track of user login status. Mainly for html output. This value has nothing to do with the 
* user authentication to Emailicious API. 
*****/
$GLOBALS['login_status'] = false;

//We instantiate an array that will contain added pages suffix to properly load js and css files
$GLOBALS['wpformelicious_hook_suffix'] = [];



/**************************
* define constant variables
***************************/
define( 'WPFORMELICIOUS_PLUGIN', __FILE__ );
define( 'WPFORMELICIOUS_PLUGIN_BASENAME', plugin_basename( WPFORMELICIOUS_PLUGIN ) );
define( 'WPFORMELICIOUS_PLUGIN_NAME', trim( dirname( WPFORMELICIOUS_PLUGIN_BASENAME ), '/' ) );
define( 'WPFORMELICIOUS_PLUGIN_DIR', untrailingslashit( dirname( WPFORMELICIOUS_PLUGIN ) ) );



/************************
* includes
*************************/
include  WPFORMELICIOUS_PLUGIN_DIR . '/includes/admin-page.php'; // Layout of the admin page (in settings section)
include  WPFORMELICIOUS_PLUGIN_DIR . '/includes/scripts.php'; // JS and CSS controller
include  WPFORMELICIOUS_PLUGIN_DIR . '/includes/dashboard.php'; // User's Dashboard (also, plugin's homepage)
include  WPFORMELICIOUS_PLUGIN_DIR . '/includes/form-creation-tool.php'; // Forms creation tool
include  WPFORMELICIOUS_PLUGIN_DIR . '/vendor/autoload.php'; 


//instantiate the formelicious menu
function wpformelicious_menu_link() {
    //We keep the hook suffix in our suffix array for further uses (see scripts.php)
    array_push($GLOBALS['wpformelicious_hook_suffix'], add_menu_page('Formelicious dashboard', 'Formelicious', 'manage_options', 'wpformelicious-dashboard', 'wpformelicious_dashboard_page', plugins_url('includes/images/emailicious-logo.png', __FILE__)));
    array_push($GLOBALS['wpformelicious_hook_suffix'], add_submenu_page( 'wpformelicious-dashboard', 'Formelicious' . ' Dashboard', '<b style="color:#BE141F">Dashboard</b>', 'manage_options', 'wpformelicious-dashboard'));
    //Add below code when tool is ready
    //array_push($GLOBALS['wpformelicious_hook_suffix'], add_submenu_page( 'wpformelicious-dashboard', 'Formelicious' . ' Form', '<b style="color:#BE141F">Create a form</b>', 'manage_options', 'wpformelicious-form-creation-tool', 'wpformelicious_form_creation_tool_HTML'));
}

add_action( 'admin_menu', 'wpformelicious_menu_link');


