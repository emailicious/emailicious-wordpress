
<?php

/***********************************************************************
* This is an easy to use tool that helps you create form and 
* automatically connects it with the Emailicious API
************************************************************************/


/**********************************************************
* global variables
**********************************************************/
$current_form = "";

/**********************************************************
* use statements in order to utilize Emailicious PHP client
**********************************************************/
use Emailicious\Client;
use Emailicious\Subscribers\Subscriber;
use Emailicious\Subscribers\Exceptions\SubscriberConflict;
use Guzzle\Http\Exception\BadResponseException;


/************************
* HTML output of the tool 
*************************/
function wpformelicious_form_creation_tool_HTML() {
    ob_start(); ?>
    <body>
        <form id="user-form" action="" method="post"> 
            <p>
                Email: <input type="text" name="email" value="" required/>
            </p>
            <p>
                First name: <input type="text" name="first_name" value= "" required/>
            </p>
            <p>
                Last name : <input type="text" name="last_name" value= "" required/>
            </p>
            <p>
                <input type="submit" name="submit" value="Subscribe!" />
            </P>
        </form>
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
    $data = array(
        'email' => $_POST['email'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name']
    );
    // if the submit button is clicked, send the email
    if ( isset( $_POST['submit'] ) ) { 
        wpformelicious_form_creation_tool_add_subscriber("client", "samuel.charette@emailicious.com", "fdca28cef03d73c29b75870ba6c6fd88041cfb0dc37143170a9accf678babf1e", $data);
    }
}


/*SHORTCODES*/
add_shortcode( 'formelicious', 'wpformelicious_form_creation_tool_HTML' );


/*******************************************
* Adding a subscriber to an Emailicious list
*******************************************/
function wpformelicious_form_creation_tool_add_subscriber($account, $username, $password, $data) {
    $client = new Client($account, $username, $password);
    
    try {
        Subscriber::create($client, 91, $data);
    } catch (SubscriberConflict $conflict) {
        // Email is already registered, the conflicting subscriber can be retrieved.
        $conflictualSubscriber = $conflict->getConflictualSubscriber();
        echo $conflictualSubscriber . " is already in this list";
    } catch (BadResponseException $exception) {
        $response = $exception->getResponse();
        echo $response;

        if ($response->getStatusCode() == 400) {
            // Validation error, refer to the response body for more details.
            $details = $response->json();
        }
        // Refer to the response status code and response body for more details.
    }
}

