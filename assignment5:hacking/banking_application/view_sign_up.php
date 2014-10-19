<!DOCTYPE HTML> 
<html> 
	<head> 
		<title>
			Sign-Up
		</title>
		<!-- 
		<link rel="stylesheet" type="text/css" href="style-signup.css">
		-->
	</head> 
	<body id="body-color"> 
		<div id="Sign-Up"> 
			<fieldset style="width:30%">
				<legend>Registration Form</legend>
				First name, Last name, LoginId must be less than 8 characters.<br> 
				<table border="0"> 
					<tr> 
						<form method="POST" action="sign_up.php"> 
						<td>First Name</td><td> <input type="text" name="firstname" maxlength="8" required></td> 
						</tr> 
						<tr>
						<td>Last Name</td><td> <input type="text" name="lastname" maxlength="8" required></td> 
						</tr> 
						<tr> 
						<td>CSE Email Id</td><td> <input type="email" name="email_id" maxlength="49" required></td> 
						</tr> 
						<tr> 
						<td>LoginId</td><td> <input type="text" name="loginid" maxlength="8" required></td> 
						</tr> 
						<tr> 
						<td>Login Password</td><td> <input type="password" name="accpass" required></td> 
						</tr>
						<tr> 
						<td>Confirm LoginPassword </td><td><input type="password" name="accpass2" required></td> 
						</tr>
						<tr> 
						<td>Transaction Password</td><td> <input type="password" name="transpass" required></td> 
						</tr>
						<tr> 
						<td>Confirm Transaction Password </td><td><input type="password" name="transpass2" required></td> 
						</tr> 
						<tr> 
						<td><input id="button" type="submit" name="submit" value="Sign-Up"></td> 
						</tr> 
					</form> 
				</table> 
			</fieldset> 
		</div> 
		<br>
		<br>
		<?php
	session_start();
        if(isset($_SESSION['sflag'])){
                if($_SESSION['sflag']==1){
                        echo " Error: Both login password must be same.";
                        $_SESSION['sflag']=0;
                }
		else if($_SESSION['sflag']==2){
                        echo " Error: Both transaction password must be same.";
                        $_SESSION['sflag']=0;
                }
		else if($_SESSION['sflag']==4){
                        echo " Error: Some error ocurred. Please try again later.";
                        $_SESSION['sflag']=0;
                }

        }
        ?>
		<br><br>
		<a href="sign_in_bank.php"> Back to Sign-in page </a>
	</body> 
</html>
