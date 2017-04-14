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
$GLOBALS['login_status'] = false;


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


