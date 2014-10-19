<?php
/*
$my_db_host = "172.27.22.237";
$my_db_name = "cs252";
$my_db_user = "hacker1";
$my_db_password = "wrong-password";
$mysql_con=mysqli_connect($my_db_host,$my_db_user,$my_db_password,$my_db_name); 
if (!$mysql_con) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if(isset($_GET['action']))
{          
    if($_GET['action']=="reset")
    {
        $encrypt = mysqli_real_escape_string($mysql_con,$_GET['encrypt']);
        $query = "SELECT * FROM customers WHERE resetlink = '$encrypt'";
        $result = mysqli_query($mysql_con,$query);
        $Results = mysqli_fetch_array($result);
        if(count($Results)>=1)
        {
            echo "What to do now??<br>";
        }
        else
        {
            $message = 'Invalid key please try again. 
            <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
            echo $message."<br>";
        }
    }
}
elseif(isset($_POST['submit']))
{

    $encrypt      = mysqli_real_escape_string($mysql_con,$_POST['action']);
    $password     = md5(mysqli_real_escape_string($mysql_con,$_POST['password']));
    $query = "SELECT * FROM customers where resetlink = '$encrypt' AND linkstatus = 'notused'";

    $result = mysqli_query($mysql_con,$query);
    $Results = mysqli_fetch_array($result);
    if(count($Results)>=1)
    {
        $query = "UPDATE customers SET password='$password' where loginid='".$Results['loginid']."'";
        mysqli_query($mysql_con,$query);

        $query2 = "UPDATE customers SET linkstatus='expired' where loginid='".$Results['loginid']."'";
        mysqli_query($mysql_con,$query2);

        $message = "Your password changed sucessfully
         <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
         echo "$message<br>";
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        echo "$message<br>";
    }
}
else
{
    header("location:sign_in_bank.php");
}
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<?php
session_start();
$my_db_host = "172.27.22.237";
$my_db_name = "cs252";
$my_db_user = "hacker1";
$my_db_password = "wrong-password";

$mysql_con=mysqli_connect($my_db_host,$my_db_user,$my_db_password,$my_db_name); 
if (!$mysql_con) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if(isset($_GET['action']))
{          
    //session_start();
    if($_GET['action']=="reset")
    {
        $encrypt = mysqli_real_escape_string($mysql_con,$_GET['encrypt']);
        $_SESSION['encrypt'] = $encrypt;
        $_SESSION['flag3'] = 'flag3';
        $flag3 = $_SESSION['flag3'];
        $query = "SELECT * FROM customers WHERE resetlink = '$encrypt'";
        $result = mysqli_query($mysql_con,$query);
        $Results = mysqli_fetch_array($result);
        if(count($Results)>=1)
        {
		echo "I am inside here $encrypt<br> $flag3<br>";
         ?>
            <div id="Forget"> 
    <fieldset style="width:30%">
    <legend>Reset Password</legend> 
    <form method="POST" action="reset2.php">  
        Enter New Password <br> <input type="password" name="password" size="40" required> <br>
        Confirm New Password <br> <input type="password" name="password2" size="40" required> <br>
        <input id="button" type="submit" name="submit" value="Submit"> 
    </form> 
    </fieldset> 
    </div>
    <br>
    
        <?php
        // session_start();
        }
        else
        {
            $message = 'Invalid key1 please try again. <a href="https://172.27.22.236/banking_application/view_forget_password.php\">Forget Password?</a>';
            echo $message."<br>";
        }
    }
}
//elseif(isset($_POST['action']))
elseif(isset($_POST['submit']))
{
    session_start();
    //$encrypt = mysqli_real_escape_string($mysql_con,$_GET['encrypt']);
       // $_SESSION['encrypt'] = $encrypt;
    $encrypt      = mysqli_real_escape_string($mysql_con,$_SESSION['encrypt']);
    echo "$encrypt<br>";
    $password     = md5(mysqli_real_escape_string($mysql_con,$_POST['password']));
    //echo "$password<br>";
    $password2     = md5(mysqli_real_escape_string($mysql_con,$_POST['password2']));
    echo "$password <br>$password2<br>";
    echo $_SESSION['flag3']."<br>";
    if($password==$password2){
        $query = "SELECT * FROM customers where resetlink = '$encrypt' AND linkstatus = 'notused'";

        $result = mysqli_query($mysql_con,$query);
        $Results = mysqli_fetch_array($result);
        if(count($Results)>=1)
        {
	    $loginid = $Results['loginid'];
            $query = "UPDATE customers SET accpassword='$password' where loginid='$loginid'";
            mysqli_query($mysql_con,$query);

            $query2 = "UPDATE customers SET linkstatus='expired' where loginid='$loginid'";
            mysqli_query($mysql_con,$query2);

            $message = "Your password changed sucessfully
             <a href=\"https://172.27.22.236/banking_application/sign_in_bank.php\">click here to login</a>.";
             echo "$message<br>";
        }
        else
        {
            $message = 'Invalid key2 please try again. <a href="https://172.27.22.236/banking_application/view_forget_password.php\">Forget Password?</a>';
            echo "$message<br>";
        }
    }
	else
	{
	$query = "SELECT * FROM customers where resetlink = '$encrypt'";

        $result = mysqli_query($mysql_con,$query);
        $Results = mysqli_fetch_array($result);
	if(count($Results)>=1)
        {
            $loginid = $Results['loginid'];
            $query2 = "UPDATE customers SET linkstatus='expired' where loginid='$loginid'";
            mysqli_query($mysql_con,$query2);


	   $message = 'Passwords did not match. Link is now expired. <a href="https://172.27.22.236/banking_application/view_forget_password.php\">Forget Password?</a>';
            echo "$message<br>";
	}		
	}
}
else
{
    header("location:sign_in_bank.php");
} 
$_SESSION = [];
session_destroy();

mysqli_close($mysql_con);
?>


