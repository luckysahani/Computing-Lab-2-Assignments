<!DOCTYPE html>
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
//include("dbconnect.php");
$customerid = $_SESSION['customerid'];
$sql = "SELECT * FROM accounts WHERE customerid = $customerid";
$accountsarray = mysqli_query($mysql_con,$sql) or die(mysqli_error($mysql_con));

?>

<html>
	<body>
		<?php echo "Login Successful<br>
		Hello ".$_SESSION['firstname']." ,Welcome to CS252 Banking Assignment<br>";
		?>
		<br>
		<div id="accounts_table" >
        <table align="center" border="1" style="width:60%">
        	<caption>Available Balance</caption>
          <tr>	
            <th >ACCOUNT NUMBER</th>
            <th >ACCOUNT TYPE</th>
            <th >AVAILABLE BALANCE</th>
          </tr>
          <?php	
 while($account = mysqli_fetch_array($accountsarray))
	  {
echo "
          <tr>
            <td>$account[accno]</td>
            <td>$account[accounttype]</td>
            <td>$account[accountbalance]</td>
          </tr>";
    	 }
	  ?>
<br> <br>
	  </table>
	  </div>
	<div id="accounts_lists">
	<table align="center" border="1">
	<caption>List of all accounts</caption>
	<tr> <th> ACCOUNT NUMBER </th> </tr>
	<?php
	$sql2 = "SELECT accno FROM accounts";
	$myarray = mysqli_query($mysql_con,$sql2);
	while($account2 = mysqli_fetch_array($myarray))
	{
echo "
	<tr> <td>$account2[accno]</td> </tr>";
	}
	?>
	<br>
	  <br>
		<?php
			include("footer.php");
		?>
