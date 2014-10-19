<!DOCTYPE HTML>
<?php
	
	session_start();
	if(isset($_SESSION['customerid'])){
		header("location:login_success_bank.php");
	}
	
	//include("header.php");
?>
<html> 
	<head> 	
		<title>Sign-In</title>
		<!--
		<link rel="stylesheet" type="text/css" href="style-sign.css">
	 	-->
	</head>
	<?php
	if(isset($_SESSION['sflag'])){
		if($_SESSION['sflag']==3){
			echo " Registered new user successfully. Now login.<br><br>";
			$_SESSION['sflag']=0;
		}
	}
	?> 
	<body id="body-color"> 
	<div id="Sign-In"> 
	<fieldset style="width:30%">
	User name must be less than 8 characters.<br><br>
	<legend>LOG-IN HERE</legend> 
	<form method="POST" action="connectivity_bank.php"> 
		User <br><input type="text" name="user" size="40" maxlength="8" required><br> 
		Password <br><input type="password" name="pass" size="40" required><br> 
		<input id="button" type="submit" name="submit" value="Log-In"> 
	</form> 
	</fieldset> 
	</div>

	Don't have an account?<br>
	<a href="view_sign_up.php"> Sign-up here </a>
	<!--- 
	<a href="sign-up.html"> Sign-up here </a> 
	-->
	<br>
	<a href="view_forget_password.php">Forgot password</a>
	</body> 
</html> 

