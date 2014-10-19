<?php

session_start();
if(!isset($_SESSION['customerid'])){
	header("location:sign_in_bank.php");
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

?>
