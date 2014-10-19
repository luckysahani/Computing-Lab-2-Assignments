<?php
//$con=mysqli_connect("localhost","root","","file_uploader");
// Check connection
//if (mysqli_connect_errno()) {
//	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
//}
// escape variables for security
//$username = mysqli_real_escape_string($con, $_POST['username']);
//$password = md5(mysqli_real_escape_string($con, $_POST['password']));

//$sql="INSERT INTO users (username, firstname, lastname, email, password)
//VALUES ('$username' ,'$firstname', '$lastname', '$email', '$password')";

//if (!mysqli_query($con,$sql)) {
//	    die('Error: ' . mysqli_error($con));
//}
$username=$_POST['username']; 
$password=$_POST['password'];
$ldaprdn = 'cn=admin,dc=cse,dc=iitk,dc=ac,dc=in';
$ldappass = 'qwerty';
$ldapconn = ldap_connect("localhost") or die ("Could not connect to the LDAP server");
if($ldapconn)
{	
	$ldapsearch = ldap_search($ldapconn, "ou=webserver,dc=cse,dc=iitk,dc=ac,dc=in", "cn=$username"); 
	if(ldap_count_entries($ldapconn, $ldapsearch)){
                echo "username already exist <BR>";
                echo "<a href=login.html>Login</a> <BR>";
                echo "<a href=register.php>Register</a>";
    }

	else{
	$ldapbind = ldap_bind($ldapconn,$ldaprdn,$ldappass);
	$info["cn"] = $username;
	$info["userPassword"] = $password;
    $info["sn"] = " ";
    $info["objectclass"] = "person";
    $dn = "cn=".$username.",ou=webserver,dc=cse,dc=iitk,dc=ac,dc=in";
	$ldapadd = ldap_add($ldapconn, $dn, $info);
    echo "Welcome $username , you are now a member. You can login at <a href=login.html>Login Page</a>.";
	}
}

//mysqli_close($con);
?>

