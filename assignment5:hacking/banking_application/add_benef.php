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

if(isset($_POST['add_submit'])){
	$_SESSION['flag'] = 0;	//Means nothing to display
	$accno = $_POST['accno'];
	$nickname =prevent_mysql_injection($mysql_con,$_POST['nickname']);
	$limit = $_POST['limit'];
	$Password = md5pass($mysql_con,$_POST['pass']);
	$customer_id = $_SESSION['customerid']);
	if(!empty($accno)) {
		//$accno = stripslashes($accno);
		//$Password = stripslashes($Password);
		//$ID = mysqli_real_escape_string($mysql_con,$ID);	//to prevent mysql injection
		//$Password = mysqli_real_escape_string($mysql_con,$Password);	//to prevent mysql injection

		//$Password = md5($Password);	//encrypting password

		$sql = "SELECT * FROM customers WHERE customerid = $customer_id and transpasword = '$Password'";
	 	
	 	//echo $sql."<br>";
	 	//$sql = mysqli_real_escape_string($mysql_con,$sql);
	 	//echo $sql."<br>";
	 	$query = mysqli_query($mysql_con,$sql) or die("Hello".mysqli_error($mysql_con)); 
	 	$row = mysqli_fetch_array($query); //or die(mysqli_error($mysql_con));

	 	if(!empty($row['customerid'])) { //i.e. password is correct

	 		$sqlnew = "SELECT customerid FROM accounts WHERE accno = $accno";
	 		$querynew = mysqli_query($mysql_con,$sqlnew) or die(mysqli_error($mysql_con));
	 		$customerids = mysqli_fetch_array($querynew);
	 		if(!empty($customerids['customerid'])) {	//i.e. this accno exists
	 			if($customerids['customerid'] != $customer_id){
					$sqlnew = "INSERT INTO beneficiaries VALUES ($accno, '$nickname', $limit, $customer_id)";
	 				$querynew = mysqli_query($mysql_con,$sqlnew) or die("hi".mysqli_error($mysql_con));
	 				$_SESSION['flag'] = 1;	// means inserted successfully	 				
	 			}
	 			else {
	 				$_SESSION['flag'] =2;	// means this was my account number
	 			}
	 		}
	 		else {
	 			$_SESSION['flag'] =3;	// means this accno does not exist
	 		}
	 	} 
	  
	 	else { 
	 		$_SESSION['flag'] = 4;	// means transaction password was wrong
		} 
		header("location:view_add_benef.php"); 
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
	header("location:view_add_benef.php"); 
}

mysqli_close($mysql_con);

?>
