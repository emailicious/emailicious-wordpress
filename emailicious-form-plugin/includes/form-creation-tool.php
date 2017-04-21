
<?php

/****************************************************************
* This is an easy to use tool that helps you create form and 
* automatically connects it with the Emailicious API
****************************************************************/


/**********************************************************
* global variables
**********************************************************/
$current_form = "";

/************************************************************
* "use" statements in order to utilize Emailicious PHP client
************************************************************/
use Emailicious\Client;
use Emailicious\Subscribers\Subscriber;
use Emailicious\Subscribers\Exceptions\SubscriberConflict;
use Guzzle\Http\Exception\BadResponseException;


/*
*TODO:
*The entire tool is to develop. At the moment, only the below code is render when a user uses Formelicious shortcode (users cant customize the form).
*/

/************************
* HTML output of the tool 
*************************/
function wpformelicious_form_creation_tool_HTML() {
    ob_start(); ?>
    <body>
            <form action="" method="post"> 
                <p>
                    Email: <input type="email" name="email" value="" required/>
                </p>
                <p>
                    First name: <input type="text" name="first_name" value= "" required/>
                </p>
                <p>
                    Last name : <input type="text" name="last_name" value= "" required/>
                </p>
                <p class="ui-draggable">
                    <input type="submit" name="submit" value="Subscribe" />
                </P>
            </form>
        </div>
    </body>
    <?php 
    global $current_form;
    $current_form = ob_get_contents();
    ob_end_clean();
    wpformelicious_form_creation_final_form();

}

function wpformelicious_form_creation_final_form(){
    global $current_form;
    echo $current_form;
    // if the submit button is clicked, send the email
    if ( isset( $_POST['submit'] ) ) {
        $data = array(
        'email' => $_POST['email'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name']
    );
        $formelicious_user_info = get_option('formelicious_user_info'); 
        wpformelicious_form_creation_tool_add_subscriber($formelicious_user_info['account'], $formelicious_user_info['username'], $formelicious_user_info['password'], $data);
    }
}

/*
*TODO: We have to make sure to create shortcode with parameters in the future. That way, the user will be able to create more than one form for his site. 
*/
/*SHORTCODES*/
add_shortcode( 'formelicious', 'wpformelicious_form_creation_tool_HTML' );


/*******************************************
* Adding a subscriber to an Emailicious list
*******************************************/
function wpformelicious_form_creation_tool_add_subscriber($account, $username, $password, $data) {
    $client = new Client($account, $username, $password);
    
    /*
    * TODO: Make sure user can choose a list (hardcoded at the moment).
    */
    try {
        Subscriber::create($client, 91, $data);
    } catch (SubscriberConflict $conflict) {
        // Email is already registered, the conflicting subscriber can be retrieved.
        $conflictualSubscriber = $conflict->getConflictualSubscriber();

        /*
        *TODO: change this output to something more user firendly
        */
        echo $conflictualSubscriber . " is already in this list";
    } catch (BadResponseException $exception) {
        $response = $exception->getResponse();
        /*
        *TODO: change this output to something more user firendly
        */
        echo $response;

        if ($response->getStatusCode() == 400) {
            // Validation error, refer to the response body for more details.
            $details = $response->json();
        }
        // Refer to the response status code and response body for more details.
    }
}


