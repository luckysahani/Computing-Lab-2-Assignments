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

    <div id="Remove" > 
      <fieldset style="width:20%">
        <legend>Remove Beneficiary</legend> 
        <form method="POST" action="remove_benef.php"> 
          Account Number &nbsp;&nbsp;&nbsp;&nbsp;
          <select name="accno" required>
            <option value="">-Select-&nbsp;&nbsp;&nbsp;</option>
           <?php
            $benefsarraytwo = mysqli_query($mysql_con,$sql) or die(mysqli_error($mysql_con));
            while($benefstwo = mysqli_fetch_array($benefsarraytwo))
            {
              echo "<option value='$benefstwo[benef_accno]'>$benefstwo[benef_accno]</option>";
            }
          ?>
            
          </select><br>
          Transaction Password <br><input type="password" name="pass" size="40" required><br> 
          <input id="button" type="submit" name="remove_submit" value="Confirm Remove"> 
        </form> 
      </fieldset> 
    </div>
    <br>

		<?php
      if(isset($_SESSION['flag'])){
        if($_SESSION['flag']==1){
          echo "Removed beneficiary successfully<br>";
          $_SESSION['flag']=0;
        }
        else if($_SESSION['flag']==2){
          echo "Something went wrong while removing. Please check the account number and password.<br>";
          $_SESSION['flag']=0;
        }
      }
			include("footer.php");
		?>
