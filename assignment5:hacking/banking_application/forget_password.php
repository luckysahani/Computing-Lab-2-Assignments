<!DOCTYPE html>
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

if(isset($_POST['submit']))
{
    $email = prevent_mysql_injection($mysql_con,$_POST['email']);
    $user = prevent_mysql_injection($mysql_con,$_POST['user']);
    /*
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $message =  "Invalid email address please type a valid email!!";
    }
    else
    {
        */
    $query = "SELECT * FROM customers WHERE loginid = '$user' and email_id = '$email'";
    $result = mysqli_query($mysql_con,$query);
    $Results = mysqli_fetch_array($result);

    if(count($Results)>=1)
    {   
        function generateRandomString($length = 40) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;   
        }
        $encrypt = generateRandomString();
        //$encrypt = md5(1289*3+$Results['customerid']);
        $sql = "UPDATE customers SET resetlink = '$encrypt' WHERE loginid = '$user'";
        $result2 = mysqli_query($mysql_con,$sql);
        $sql2 = "UPDATE customers SET linkstatus = 'notused' WHERE loginid = '$user'";
        $result2 = mysqli_query($mysql_con,$sql2);

        $message = "Your password reset link send to your e-mail address.";
        $to=$email;
        $subject="Forget Password";
        $from = 'hacker1@agrawal.com';
        $body='Hi, <br/> <br/>'.' <br><br>Click here to reset your password https://172.27.22.236/banking_application/reset.php?encrypt='.$encrypt.'&action=reset   <br/> <br/>--<br>PHPGang.com<br>Solve your problems.';
        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($to,$subject,$body,$headers);
        echo "A mail has been send ... please check your email id.<br>";
    }
    else
    {
        $message = "Username and email id did not match!!";
        echo $message;
    }

}
echo "<a href=\"sign_in_bank.php\"> Back to Sign-in page </a>";
?>
