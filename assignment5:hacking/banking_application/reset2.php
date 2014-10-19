!<DOCTYPE html>
<?php
$my_db_host = "172.27.22.237";
$my_db_name = "cs252";
$my_db_user = "hacker1";
$my_db_password = "wrong-password";

$mysql_con=mysqli_connect($my_db_host,$my_db_user,$my_db_password,$my_db_name); 
if (!$mysql_con) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if(isset($_POST['submit']))
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


