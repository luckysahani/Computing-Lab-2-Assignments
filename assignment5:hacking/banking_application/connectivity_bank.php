<?php 

$my_db_host = "172.27.22.237";
$my_db_name = "cs252";
$my_db_user = "hacker1";
$my_db_password = "wrong-password";
$mysql_con=mysqli_connect($my_db_host,$my_db_user,$my_db_password,$my_db_name); 
if (!$mysql_con) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

//echo 'Success... ' . mysqli_get_host_info($mysql_con) . "<br>";

//include("dbconnect.php");
function prevent_mysql_injection($mysql_con,$string){
	$string1 = stripslashes($string);
	$string2= mysqli_real_escape_string($mysql_con,$string1);
	return $string2;
}
function md5pass($mysql_con,$string){
	$string1 = stripslashes($string);
	$string2= mysqli_real_escape_string($mysql_con,$string1);
	$string3= md5($string2);
	return $string3;	
}

if(isset($_POST['submit'])){
	session_start(); //starting the session for user profile page
	$ID = prevent_mysql_injection($mysql_con,$_POST['user']);
	$Password = md5pass($mysql_con,$_POST['pass']);
	if(!empty($ID)) {//checking the 'user' name which is from Sign-In.html, is it empty or have some text
		//$ID = stripslashes($ID);
		//$Password = stripslashes($Password);
		//$ID = mysqli_real_escape_string($mysql_con,$ID);	//to prevent mysql injection
		//$Password = mysqli_real_escape_string($mysql_con,$Password);	//to prevent mysql injection

		//$Password = md5($Password);	//encrypting password

	 	$sql = "SELECT * FROM customers WHERE loginid = '$ID' AND accpassword = '$Password'";
	 	//echo $sql."<br>";
	 	//$sql = mysqli_real_escape_string($mysql_con,$sql);
	 	//echo $sql."<br>";
	 	$query = mysqli_query($mysql_con,$sql) or die(mysqli_error($mysql_con)); 
	 	$row = mysqli_fetch_array($query); //or die(mysqli_error($mysql_con));
	 	//echo $row[0];
	 	if(!empty($row['customerid'])) { 
	 		$_SESSION['customerid'] = $row['customerid'];
	 		$_SESSION['firstname'] = $row['firstname'];
	 		$customerid = $row['customerid'];
	 		$sqlnew = "SELECT accno FROM accounts WHERE customerid = $customerid";
	 		$querynew = mysqli_query($mysql_con,$sqlnew) or die(mysqli_error($mysql_con));
	 		$accnos = mysqli_fetch_array($querynew);
	 		if(!empty($accnos['accno'])) {
	 			$_SESSION['accno'] = $accnos['accno'];
	 		}
	 		else {
	 			die("SORRY... NO ACCOUNT WAS FOUND... PLEASE RETRY...");
	 		}
	 	//	$_SESSION['passWord'] = $row['pass'];
	 	//
	 		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";

	 		header("location:login_success_bank.php");
	 	} 
	  
	 	else { 
	 		echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY..."; 
		} 
 	}
 	else {
 		echo "SORRY... YOU DID NOT ENTER ANY ID... PLEASE RETRY";
 	} 
} 
//if(isset($_POST['submit'])) {
//	 SignIn(); //
// } 
else {
	echo "SORRY....";
}

mysqli_close($mysql_con);

?>
