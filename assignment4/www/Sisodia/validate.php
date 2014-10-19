<?php
# validate.php

$user_name = trim($_POST['user_name']);
$error = '';

if ($user_name == '') $error = 'User name is required<br />';

// Build the query string to be attached 
// to the redirected URL
$query_string = '?user_name=' . $user_name;

// Redirection needs absolute domain and phisical dir
$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';

/* The header() function sends a HTTP message 
	 The 303 code asks the server to use GET
	 when redirecting to another page */
header('HTTP/1.1 303 See Other');

if ($error != '') {
	// Back to register page
	$next_page = 'register.php';
	// Add error message to the query string
	$query_string .= '&error=' . $error;
	// This message asks the server to redirect to another page
	header('Location: http://' . $server_dir . $next_page . $query_string);
}
// If Ok then go to confirmation
else $next_page = 'confirmation.php';

/*
	 Here is where the PHP sql data insertion code will be
 */
// Redirect to confirmation page
header('Location: http://' . $server_dir . $next_page . $query_string);
?>
