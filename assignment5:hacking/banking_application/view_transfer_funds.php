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
$my_accno =  $_SESSION['accno'];
$sql = "SELECT * FROM beneficiaries WHERE customerid = $customerid";
$benefsarray = mysqli_query($mysql_con,$sql) or die(mysqli_error($mysql_con));

?>

<html>
  <body>/++++++
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

    <div id="Transfer" > 
      <fieldset style="width:20%">
        <legend>Transfer Funds to a Beneficiary</legend> 
        <form method="POST" action="transfer_funds.php"> 
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
          Amount <br> <input type="number" name ="amount" step="0.01" size="40" min="0.00" max="10000000.00" required><br>
          Remarks <br> <input type="text" name="remarks" size="40" maxlength="10"><br>
          Transaction Password <br><input type="password" name="pass" size="40" required><br> 
          <input id="button" type="submit" name="transfer_submit" value="Confirm Transfer"> 
        </form> 
      </fieldset> 
    </div>
    <br>

    <?php
      if(isset($_SESSION['flag'])){
        if($_SESSION['flag']==1){
          echo "Error: Amount is not in correct limit<br>";
          $_SESSION['flag']=0;
        }
        else if($_SESSION['flag']==2){
          echo "Success: Transferred funds correctly.<br>";
          $_SESSION['flag']=0;
        }
        else if($_SESSION['flag']==3){
          echo "Error: Please check your password.<br>";
          $_SESSION['flag'] = 0;
        }
        else if($_SESSION['flag']==4){
          echo "Error: Amount is more than your balance. <br>";
          $_SESSION['flag'] = 0;
        }
      }
      include("footer.php");
    ?>
