<!DOCTYPE html>
<?php 
	session_start();
	$_SESSION = [];
	session_destroy();

	echo "You have been successfully logged-out!.<br>";
?>

<html>
	<body>
		<br>
		<a href="sign_in_bank.php">Sign in</a>
	</body>
</html>