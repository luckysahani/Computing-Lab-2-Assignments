<?php 
$my_db_host = "172.27.22.237";
$my_db_name = "cs252";
$my_db_user = "hacker1";
$my_db_password = "wrong-password";
session_start();
$mysql_con=mysqli_connect($my_db_host,$my_db_user,$my_db_password,$my_db_name); 
if (!$mysql_con) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
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
	$firstname = prevent_mysql_injection($mysql_con,$_POST['firstname']);
	$lastname = prevent_mysql_injection($mysql_con,$_POST['lastname']);
	$email_id = prevent_mysql_injection($mysql_con,$_POST['email_id']);
	$loginid = prevent_mysql_injection($mysql_con,$_POST['loginid']);
	$accpass = md5pass($mysql_con,$_POST['accpass']);
	$accpass2 = md5pass($mysql_con,$_POST['accpass2']);
	$transpass = md5pass($mysql_con,$_POST['transpass']);
	$transpass2 = md5pass($mysql_con,$_POST['transpass2']);

	if($accpass != $accpass2){
		$_SESSION['sflag']=1;
		header("location:view_sign_up.php");
		//echo "ERROR: BOTH LOGIN PASSWORDS MUST BE SAME<br>";
	}
	else if($transpass != $transpass2){
		$_SESSION['sflag']=2;
		header("location:view_sign_up.php");
		//echo "ERROR: BOTH TRANSACTION PASSWORDS MUST BE SAME<br>";	
	}
	else{
		/*
		$ID = stripslashes($ID);
		$Password = stripslashes($Password);
		$ID = mysqli_real_escape_string($mysql_con,$ID);	//to prevent mysql injection
		$Password = mysqli_real_escape_string($mysql_con,$Password);	//to prevent mysql injection
		$email = stripslashes($email);
		$name = stripslashes($name);
		$email = mysqli_real_escape_string($mysql_con,$email);	//to prevent mysql injection
		$name = mysqli_real_escape_string($mysql_con,$name);	//to prevent mysql injection

		$Password = md5($Password);
		*/
		if (function_exists('date_default_timezone_set'))
		{
		  date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d',time());	//current date time

		$sql = "SELECT count(*) AS count FROM customers where loginid ='$loginid'";
		$query = mysqli_query($mysql_con,$sql) or die("ERROR: Could not sign-up. Please try again....<br>".mysqli_error($mysql_con));
		$row = mysqli_fetch_array($query);
		if($row['count']==1){
			//die("ERROR: Login Id already taken by someone else. Please try again with another Login Id......<br>");
		}
		
		$sql = "INSERT INTO customers (firstname,lastname,loginid,accpassword,transpasword,accopendate,lastlogin,email_id) 
		values ('$firstname','$lastname','$loginid','$accpass','$transpass','$date','0000-00-00 00:00:00','$email_id')";
		$query = mysqli_query($mysql_con,$sql) or die("ERROR: Could not sign-up. Please try again....<br>".mysqli_error($mysql_con));
		
		$sql = "SELECT customerid FROM customers WHERE loginid ='$loginid'";
		//echo "$sql<br>";
		$query = mysqli_query($mysql_con,$sql) or die("Error: dont know...<br>");
		$result = mysqli_fetch_array($query);
		$customer_id = $result['customerid'];
		//echo "customerid= $customer_id<br>";

		$sql = "INSERT INTO accounts (customerid,accopendate,accounttype,accountbalance) 
		VALUES ($customer_id,'$date', 'saving', 20000.00)";
		//echo $sql."<br>";
		$query = mysqli_query($mysql_con,$sql) or die("ERROR: Could not sign-up. Please try again....<br>".mysqli_error($mysql_con));
		$_SESSION['sflag']=3;
		header("location:sign_in_bank.php");
		//echo "Congratulations ! You have been SUCCESSFULLY registered.<br>";
	}
}
else{
	$_SESSION['sflag']=4;
	header("location:view_sign_up.php");
	//die("ERROR: Could not sign-up. Please try again......");
}

mysqli_close($mysql_con);
?>
