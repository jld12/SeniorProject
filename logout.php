<?php

// The logout function destroys the session and wipes output, if the user is logged in.
// If no user is logged in, they are sent to the home page.

$page_title = 'Logout';
include ('includes/header.php');

if (!isset($_SESSION['accountID'])) {

	$url = '/index.php';
	ob_end_clean();
	header("Location: $url");
	exit();

} else {

	$_SESSION = array();
	session_destroy();
	setcookie (session_name(), '', time()-3600);
	
	$url = '/index.php';
	ob_end_clean();
	header("Location: $url");
	exit();

}

?>