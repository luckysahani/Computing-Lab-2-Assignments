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

if(isset($_POST['transfer_submit'])){
	$_SESSION['flag'] = 0;	//Means nothing to display
	$accno = $_POST['accno'];
	$amount = $_POST['amount'];
	$Password = md5pass($mysql_con,$_POST['pass']);
	$my_customerid = $_SESSION['customerid'];
	$my_accno = $_SESSION['accno'];
	$remarks = prevent_mysql_injection($mysql_con,$_POST['remarks']);
	//echo "$accno $amount $Password <br> $my_customerid $my_accno<br>";

	if (function_exists('date_default_timezone_set'))
	{
	  date_default_timezone_set("Asia/Kolkata");
	}

	//date_default_timezone_set('Asia/Mumbai');
	//$timezone = date_default_timezone_get();
	//echo "The current server timezone is: " . $timezone."<br>";
	$date = date('Y-m-d H:i:s',time());	//current date time
	//echo "The current datetime is: ".$date."<br>";
	if(!empty($accno)) {
		//$accno = stripslashes($accno);
		$Password = stripslashes($Password);
		//$ID = mysqli_real_escape_string($mysql_con,$ID);	//to prevent mysql injection
		//$Password = mysqli_real_escape_string($mysql_con,$Password);	//to prevent mysql injection

		//$Password = md5($Password);	//encrypting password
		//$_SESSION['flag']=1;
		//header("location:view_transfer_funds.php");

	 	$sql2 = "SELECT benef_limit FROM beneficiaries WHERE benef_accno = $accno AND customerid = $my_customerid";
	 	$query2 = mysqli_query($mysql_con,$sql2) or die("Hello ".mysqli_error($mysql_con));
	 	$row2 = mysqli_fetch_array($query2);

	 	//echo $amount." ".$row2['benef_limit']."<br>";
	 	if($amount > $row2['benef_limit']){
	 		$_SESSION['flag'] = 1;	//means amount was not in limit
	 		header("location:view_transfer_funds.php"); 
	 	}
	 	else{
		 	$sql2 = "SELECT accountbalance FROM accounts WHERE accno = $my_accno AND customerid = $my_customerid";
		 	$query2 = mysqli_query($mysql_con,$sql2) or die("Hello ".mysqli_error($mysql_con));
		 	$row2 = mysqli_fetch_array($query2);
		 	if($amount > $row2['accountbalance']){
		 		$_SESSION['flag'] = 4;	//means amount was more than balance
		 		header("location:view_transfer_funds.php");
		 	}

		 	else {
				$sql = "SELECT * FROM customers WHERE customerid = $my_customerid and transpasword = '$Password'";
			 	$query = mysqli_query($mysql_con,$sql) or die("Hello".mysqli_error($mysql_con)); 
			 	$row = mysqli_fetch_array($query); //or die(mysqli_error($mysql_con));


			 	if(!empty($row['customerid'])) { //i.e. password is correct

			 		$sql3 = "UPDATE accounts SET accountbalance = accountbalance + $amount WHERE accno = $accno";
				 	$query3 = mysqli_query($mysql_con,$sql3) or die("Hello".mysqli_error($mysql_con)); 
			 		$sql4 = "UPDATE accounts SET accountbalance = accountbalance - $amount WHERE accno = $my_accno";
				 	$query4 = mysqli_query($mysql_con,$sql4) or die("Hello".mysqli_error($mysql_con)); 
				 	//$remarks = "make form first";
			 		$sql5 = "INSERT INTO transaction (transactiondate, payeeaccno, receiveraccno, amount, remarks)
			 		 VALUES ('$date',$my_accno,$accno,$amount,'$remarks')";
				 	$query5 = mysqli_query($mysql_con,$sql5) or die("Hello".mysqli_error($mysql_con));
				 	$_SESSION['flag'] = 2;	//means transfereed funds correctly
				 	header("location:view_transactions.php");
				 }
		 	
		  
		 		else { 
		 			$_SESSION['flag'] = 3;	// means transaction password was wrong
		 			header("location:view_transfer_funds.php");
		 		}
			} 
			//header("location:view_transfer_funds.php"); 
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
	header("location:view_transfer_funds.php"); 
}

mysqli_close($mysql_con);

?>
