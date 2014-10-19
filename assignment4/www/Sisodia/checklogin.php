<?php
//ob_start();
//$host="localhost"; // Host name 
//$username="root"; // Mysql username 
//$db_name="file_uploader"; // Database name 
//$tbl_name="users"; // Table name 

// Connect to server and select databse.
//$con=mysqli_connect($host,$username,"",$db_name);
//if (mysqli_connect_errno()) {/
//	echo "Failed to connect to MySQL: " . mysqli_connect_error();
//}

// Define $myusername and $mypassword 
$username=$_POST['username']; 
$password=$_POST['password']; 

$ldaprdn = "cn=".$username.",ou=webserver,dc=cse,dc=iitk,dc=ac,dc=in";
$ldappass = $password;
$ldapconn = ldap_connect("localhost") or die ("Could not connect to the LDAP server");
if($ldapconn)
{		$ldapbind = ldap_bind($ldapconn,$ldaprdn,$ldappass);
		if($ldapbind){
                echo "Successful Login";
                // Register $myusername, $mypassword and redirect to file "login_success.php"
                session_start();
                $_SESSION['username'] = $username;
                //session_register("password");
                $next_page = "upload_file.php";
                header('location:upload_file.php');
        }
        else {
                echo "Wrong Username or Password <BR>";
                echo "<a href=login.html>Login</a> <BR>";
                echo "<a href=register.php>Register</a>";
        }



}
//else{
//	echo "SQL statement had some errors.";
//}
//ob_end_flush();
header('location:'.$next_page);
?>
