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
$sql = "SELECT * FROM beneficiaries WHERE customerid = $customerid";
$benefsarray = mysqli_query($mysql_con,$sql) or die(mysqli_error($mysql_con));

?>

<html>
	<body>
		<?php echo "Login Successful<br>
		Hello ".$_SESSION['firstname']." ,Welcome to CS252 Banking Assignment<br>";
		?>
		<br>
		<div id="benefs_table" >
        <table align="center" border="1" style="width:60%">
          <caption>Beneficiaries Details</caption>
          <tr>	
            <th >NICK NAME</th>
            <th >ACCOUNT NUMBER</th>
            <th >TRANSFER LIMIT</th>
          </tr>
          <?php	
 while($benefs = mysqli_fetch_array($benefsarray))
	  {
echo "
          <tr>
            <td>$benefs[benef_nickname]</td>
            <td>$benefs[benef_accno]</td>
            <td>$benefs[benef_limit]</td>
          </tr>";
    	 }
	  ?>
	  </table>
	  </div>

    <!--
    <div id="remove_edit" >
        <table align="center" border="1" style="width:60%">
          <tr>  
            <th >Remove Beneficiary</th>
            <th >Edit Beneficiary</th>
          </tr>
          <tr>
            <td>
              <div id="Remove" > 
                <fieldset style="width:20%">
                  <legend>Remove Beneficiary</legend> 
                  <form method="POST" action="remove_benef.php"> 
                    Account Number <br><input type="number" name="user" size="40"><br> 
                    Transaction Password <br><input type="password" name="pass" size="40"><br> 
                    <input id="button" type="submit" name="remove" value="Confirm Remove"> 
                  </form> 
                </fieldset> 
              </div>
            </td>
          </tr>

          -->
          <br>
          <br>
    <div id="Add" > 
      <fieldset style="width:20%">
        <legend>Add Beneficiary</legend> 
        <form method="POST" action="add_benef.php"> 
          Nick Name <br> <input type="text" name = "nickname" maxlength = "39"> <br>
          Account Number <br><input type="number" name="accno" size="40" required><br>
          Transfer Limit<br> <input type="number" step="0.01" name="limit" size="40" min="0.00" max="10000000"required> <br>
          Transaction Password <br><input type="password" name="pass" size="40" required><br> 
          <input id="button" type="submit" name="add_submit" value="Confirm Add"> 
        </form> 
      </fieldset> 
    </div>
    <br>

		<?php
      if(isset($_SESSION['flag'])){
        if($_SESSION['flag']==1){
          echo "Added beneficiary successfully<br>";
          $_SESSION['flag']=0;
        }
        else if($_SESSION['flag']==2){
          echo "Can not add own account as beneficiary.<br>";
          $_SESSION['flag']=0;
        }
        else if($_SESSION['flag']==3){
          echo "Account number is not valid.<br>";
          $_SESSION['flag']=0;
        }
        else if($_SESSION['flag']==4){
          echo "Error: Please check the password.<br>";
          $_SESSION['flag']=0;
        }
      }
			include("footer.php");
		?>