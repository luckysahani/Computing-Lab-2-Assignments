<html>
<head>
	<title>Lucky Sahani - Assignment 2</title>
	<meta content="CS252">
	<style>
		body{
			text-align: left;
		}
	</style>
</head>
<body>
	<form action="upl.php" method="post" enctype="multipart/form-data">
		<label for="file">Upload another file...</label><br>
		<input type="file" name="file" id="file"><br>
		<input type="submit" name="submit" value="Submit"><br>
	</form>

	<?php
		session_start();
		$email = sha1($_POST["email"]);
		$password = sha1($_POST['password']);
		//$password1 = $_POST['password'];
		$username = $_POST['username'];
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['email'] = $email;
		$username=$_SESSION['username']  ;
		$password=$_SESSION['password'];
		$email=$_SESSION['email'];
		$database_name="cs252assignment2";
		// echo "username=".$username."password=".$password."email=".$email;
		$con=mysqli_connect(localhost,"root","qwerty","test");
		$sql="CREATE DATABASE ".$database_name;
		mysqli_query($con,$sql);
		$database_name="cs252assignment2";
		$sql="USE ".$database_name;
		mysqli_query($con,$sql);
		$sql="CREATE TABLE login (username VARCHAR(40),name CHAR(40) ,password CHAR(40),primary key(name))";
		mysqli_query($con,$sql);
		$table_name="CS252";
		$sql="CREATE TABLE ".$table_name." (username CHAR(40),name CHAR(40),type CHAR(40),size INT,stored_temp CHAR(40),uploaded_file CHAR(100))";
		if (mysqli_query($con,$sql)) {
		  	//echo "Table ".$table_name." created successfully<br>";
		} 
		$insert = "INSERT INTO login VALUES ('" . $username."','" . $email. "','" . $password."')" ;
		mysqli_query($con,$insert);
		mysqli_close($con);
		$username=$_POST['email']; 
		$password=$_POST['password'];
		$ldaprdn = 'cn=admin,dc=cse,dc=iitk,dc=ac,dc=in';
		$ldappass = 'qwerty';
		$ldapconn = ldap_connect("localhost") or die ("Could not connect to the LDAP server");
		if($ldapconn)
		{	
			$ldapsearch = ldap_search($ldapconn, "ou=webserver,dc=cse,dc=iitk,dc=ac,dc=in", "cn=$username");
			//echo $ldapsearch."hi\n"; 
			$info = ldap_get_entries($ldapconn, $ldapsearch);
			// echo var_dump(ldap_count_entries($ds, $sr))."gkhga";
			///echo ldap_count_entries($ldapconn, $ldapsearch);
			//echo $info["count"]."entries returned\n";  		
			if((ldap_count_entries($ldapconn, $ldapsearch))){
		                echo "username already exist <BR>";
		                echo "<a href=index.html>Login</a> <BR>";
		                echo "<a href=register.html>Register</a>";
		    }

			else{
			$ldapbind = ldap_bind($ldapconn,$ldaprdn,$ldappass);
			$info["cn"] = $username;
			$info["userPassword"] = $password;
		    $info["sn"] = " ";
		    $info["objectclass"] = "person";
		    $dn = "cn=".$username.",ou=webserver,dc=cse,dc=iitk,dc=ac,dc=in";
			$ldapadd = ldap_add($ldapconn, $dn, $info);
		    echo "Welcome $username , you are now a member. </a>.";
			}
		}
	?> 
			<a href="logout.php"><br>Logout</a>

</body>
</html>