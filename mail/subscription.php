<?php
/*///////////////////////////////////////////////////////////////////////
Subscribe Form
http://www.abileweb.com

Distrbuted under Creative Commons license
http://creativecommons.org/licenses/by-sa/3.0/us/
///////////////////////////////////////////////////////////////////////*/
if($_POST)
{
	//check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	
		//exit script outputting json data
		$output = json_encode(
		array(
			'type'=>'error', 
			'text' => 'Request must come from Ajax'
		));
		
		die($output);
    } 	
	
	// Validation
	if(!$_POST['contact_email1']){ $output = json_encode(array('type'=>'error', 'text' => 'No email address provided!'));
		die($output); } 

	if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_POST['userEmail'])) {
		$output = json_encode(array('type'=>'error', 'text' => 'Email address is invalid!'));
		die($output);
	}

	require_once('mail/MCAPI.class.php');
	
	// grab an API Key from http://admin.mailchimp.com/account/api/
	$api = new MCAPI(' fb2cf5423a203a4c98d9a7a0aec77c05-us9');
	
	// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
	// Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
	$list_id = "abe9b3f2a1";
	
	// $merge_vars = array('FNAME' => $_POST['fullname']);
	
	if($api->listSubscribe($list_id, $_POST['contact_email1']) === true) {
		// It worked!			
		$output = json_encode(array('type'=>'error', 'text' => 'Success! Check your email to confirm sign up. Thank you for your email'));
		die($output);
	} else {
		// An error ocurred, return error message	
		$output = json_encode(array('type'=>'message', 'text' => 'Error: '.$api->errorMessage));
		die($output);		
	}
}
?>