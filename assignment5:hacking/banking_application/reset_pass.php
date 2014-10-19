<!DOCTYPE html>
<?php
	include("header.php");

?>
<html>
	<title>Reset Password</title>
	<body>
	<?php echo "Login Successful<br>
		Hello ".$_SESSION['firstname']." ,Welcome to CS252 Banking Assignment<br>";
		?>
		<br>
		<div id="Reset" > 
      <fieldset style="width:20%">
        <legend>Reset Password</legend> 
        <form method="POST" action="reset_pass_2.php"> 
        	Old Password <br><input type="password" name="old_pass" size="40" required><br>
        	New Password <br><input type="password" name="pass_1" size="40" required><br>
          	Retype New Password <br><input type="password" name="pass_2" size="40" required><br> 
          <input id="button" type="submit" name="reset_submit" value="Confirm Reset"> 
        </form> 
      </fieldset> 
    </div>
    <br>
    <?php
    	if(isset($_SESSION['flag'])){
        if($_SESSION['flag']==1){
          echo "Error: Both passwords must be the same<br>";
          $_SESSION['flag']=0;
        }
        else if($_SESSION['flag']==2){
          echo "Success: Changed password correctly.<br>";
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
