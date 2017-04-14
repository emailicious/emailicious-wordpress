<?php

/*************************************
* This is where all scripts are loaded
**************************************/

 	

/*****************************
* Loading Jquery and Jquery UI
******************************/


function add_jquery_ui() {
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'jquery-ui-mouse' );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'jquery-ui-draggable' );
	wp_enqueue_script( 'jquery-ui-droppable' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'jquery-ui-resize' );
	wp_enqueue_script( 'jquery-ui-dialog' );
	wp_enqueue_script( 'jquery-ui-button' );
}
add_action( 'wp_enqueue_scripts', 'add_jquery_ui' ); // loading Jquery UI site side
add_action('admin_init', 'add_jquery_ui'); // loading Jquery UI in admin interface


/************************
* Loading Bootstrap
*************************/
// JS
wp_register_script('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
wp_enqueue_script('prefix_bootstrap');

// CSS
wp_register_style('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
wp_enqueue_style('prefix_bootstrap');



/*************************
* Loading custom css files
*************************/
function wpformelicious_load_css() {
	wp_enqueue_style('wpformelicious_form-creation-tool-css', plugin_dir_url(__FILE__) . 'css/form-creation-tool.css');
}
add_action('admin_init', 'wpformelicious_load_css'); // loading css in admin interface
add_action( 'wp_enqueue_scripts', 'wpformelicious_load_css'); // loading css site side



/*************************
* Loading custom JS files
*************************/
function wpformelicious_load_js() {
	wp_enqueue_script('wpformelicious_form-creation-tool-js', plugin_dir_url(__FILE__) . 'js/form-creation-tool.js');
	wp_enqueue_script('wpformelicious_dashboard-js', plugin_dir_url(__FILE__) . 'js/dashboard.js');
}
add_action('admin_init', 'wpformelicious_load_js'); // loading js in admin interface
add_action( 'wp_enqueue_scripts', 'wpformelicious_load_js'); // loading js site side