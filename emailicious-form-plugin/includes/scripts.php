<?php

/*************************************
* This is where all scripts are loaded
**************************************/


/*****************************
* Loading scripts/styles files
******************************/
function wpformelicious_load($hook) {


	//Here we make sure js and css files are loaded only for Formelicious custom pages
	if (in_array($hook, $GLOBALS['wpformelicious_hook_suffix'])){

		//Bootstrap
		wp_register_script('bootstrap-script', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
		wp_enqueue_script('bootstrap-script');

		wp_register_style('bootstrap-style', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap-style');

		//Bootstrap show/hide password
		wp_register_script('bootstrap-password', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js');
		wp_enqueue_script('bootstrap-password');

		//JQUERY
		wp_enqueue_script('jquery');

		//Formelicious Admin page
		wp_register_script('wpformelicious-admin-page-script', plugin_dir_url(__FILE__) . 'js/admin-page.js');
		wp_enqueue_script('wpformelicious-admin-page-script');

		wp_register_style('wpformelicious-admin-page-style', plugin_dir_url(__FILE__) . 'css/admin-page.css');
		wp_enqueue_style('wpformelicious-admin-page-style');


	}

	else {
		return;
	}
	
}
add_action('admin_enqueue_scripts', 'wpformelicious_load'); // loading in admin interface

