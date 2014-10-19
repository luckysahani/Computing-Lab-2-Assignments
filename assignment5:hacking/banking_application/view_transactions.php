<!DOCTYPE HTML>
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
$accno = $_SESSION['accno'];
$sql = "SELECT * FROM transaction WHERE payeeaccno = $accno OR receiveraccno = $accno order by transactionid desc";
$transactionarray = mysqli_query($mysql_con,$sql) or die(mysqli_error($mysql_con));

?>

<html>
  <title> View transactions </title>
  <body>
      <?php echo "Login Successful<br>
        Hello ".$_SESSION['firstname']." ,Welcome to CS252 Banking Assignment<br>";
      ?>
      <br>
      <div id="transaction_table" >
        <table align="center" border="1" width=1000>
          <caption>Previous Transactions Details</caption>
          <tr>	
            <th width=100>TRANSACTION ID</th>
            <th width=250>TRANSACTION DATE</th>
            <th width=125>PAYEE ACCOUNT</th>
            <th width=125>RECEIVER ACCOUNT</th>
            <th width=100>AMOUNT</th>
            <th width=300><p>REMARKS</p></th>
          </tr>
                <?php	
 while($transaction = mysqli_fetch_array($transactionarray))
	  {
echo "
          <tr>
            <td>$transaction[transactionid]</td>
            <td>$transaction[transactiondate]</td>
            <td>$transaction[payeeaccno]</td>
            <td>$transaction[receiveraccno]</td>
            <td>$transaction[amount]</td>
    		    <td>$transaction[remarks]</td>
          </tr>";
    	 }
	  ?>
        </table>
      </div>
      <br>
    <?php
      include("footer.php");
    ?>