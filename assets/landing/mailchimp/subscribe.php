<?php
	require_once 'MCAPI.class.php';
	$api = new MCAPI('Your mail chimp Here');
	$merge_vars = array();

	// Submit subscriber data to MailChimp
	// For parameters doc, refer to: http://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php
	$retval = $api->listSubscribe( 'Your Audienc ID here', $_POST["email"], $merge_vars, 'html', false, true );

	if ($api->errorCode){
		echo "<p>Please try again.</p>" . $api->errorCode;
	} else {
		echo "<p class='success'>Thank you, you have been added to our mailing list.</p>";
	}
?>
