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

	if(isset($_POST['reset_submit'])){
		$old_pass = md5pass($mysql_con,$_POST['old_pass']);
		$pass_1 = md5pass($mysql_con,$_POST['pass_1']);
		$pass_2 = md5pass($mysql_con,$_POST['pass_2']);
		$my_customerid = $_SESSION['customerid'];
		if($pass_1 != $pass_2){
			$_SESSION['flag'] = 1;	//means both passwords were not same
			header("location:reset_pass.php");
		}
		else{
			$sql = "SELECT * FROM customers WHERE customerid = $my_customerid and accpassword = '$old_pass'";
		 	$query = mysqli_query($mysql_con,$sql) or die("Hello".mysqli_error($mysql_con)); 
		 	$row = mysqli_fetch_array($query); //or die(mysqli_error($mysql_con));


		 	if(!empty($row['customerid'])) { //i.e. password is correct
		 		$sql2 = "UPDATE customers SET accpassword = '$pass_1' WHERE customerid = $my_customerid ";
			 	$query2 = mysqli_query($mysql_con,$sql2) or die("Hello".mysqli_error($mysql_con)); 
			 	//$row2 = mysqli_fetch_array($query); //or die(mysqli_error($mysql_con));
			 	$_SESSION['flag'] = 2;	//means changed password correctly
				header("location:reset_pass.php");
		 	}
		 	else {
		 		$_SESSION['flag'] = 3;	//means password was wrong
				header("location:reset_pass.php");
		 	}

		}
	}


mysqli_close($mysql_con);

?>
