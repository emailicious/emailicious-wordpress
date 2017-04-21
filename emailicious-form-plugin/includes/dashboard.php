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
        	<h1 class="wp-heading-inline">Formelicious</h1>
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

