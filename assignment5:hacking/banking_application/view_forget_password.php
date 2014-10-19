<!DOCTYPE HTML>
<?php
	/*
	session_start();
	if(isset($_SESSION['customerid'])){
		header("location:login_success_bank.php");
	}
	
	//include("header.php");
	*/
?>
<html> 
	<head> 	
		<title>Forgot Password</title>
		<!--
		<link rel="stylesheet" type="text/css" href="style-sign.css">
	 	-->
	</head> 
	<body id="body-color"> 
	<div id="Forget"> 
	<fieldset style="width:30%">
	<legend>Forgot Password</legend> 
	<form method="POST" action="https://172.27.22.236/banking_application/forget_password.php"> 
		Enter User <br><input type="text" name="user" size="40" maxlength="8" required><br> 
		Enter Email <br> <input type="email" name="email" size="40" maxlength="49" required> <br>
		<input id="button" type="submit" name="submit" value="Submit"> 
	</form> 
	</fieldset> 
	</div>
	<br>
	<br>
	<a href="https://172.27.22.236/banking_application/sign_in_bank.php"> Back to Sign-in page </a>
	<!--- 
	<a href="sign-up.html"> Sign-up here </a> 
	-->
	</body> 
</html> 

