<?php 
include("header.php");
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

if(isset($_POST['remove_submit'])){
	$_SESSION['flag'] = 0;	//Means nothing to display
	$accno = $_POST['accno'];
	$Password = md5pass($mysql_con,$_POST['pass']);
	$customer_id = $_SESSION['customerid'];
	if(!empty($accno)) {
		//$accno = stripslashes($accno);
		$Password = stripslashes($Password);
		//$ID = mysqli_real_escape_string($mysql_con,$ID);	//to prevent mysql injection
		//$Password = mysqli_real_escape_string($mysql_con,$Password);	//to prevent mysql injection

		//$Password = md5($Password);	//encrypting password

		$sql = "SELECT * FROM customers WHERE customerid = $customer_id and transpasword = '$Password'";
	 	
	 	//echo $sql."<br>";
	 	//$sql = mysqli_real_escape_string($mysql_con,$sql);
	 	//echo $sql."<br>";
	 	$query = mysqli_query($mysql_con,$sql) or die("Hello".mysqli_error($mysql_con)); 
	 	$row = mysqli_fetch_array($query); //or die(mysqli_error($mysql_con));

	 	if(!empty($row['customerid'])) { 
	 		$sqlnew = "DELETE FROM beneficiaries WHERE benef_accno = $accno AND customerid = $customer_id";
	 		$querynew = mysqli_query($mysql_con,$sqlnew) or die("hi".mysqli_error($mysql_con));
	 		$_SESSION['flag'] = 1;	// means deleted successfully
	 	} 
	  
	 	else { 
	 		$_SESSION['flag'] = 2;	// means transaction password was wrong
		} 
		header("location:view_remove_benef.php"); 
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
	header("location:view_remove_benef.php"); 
}

mysqli_close($mysql_con);

?>
