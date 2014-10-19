<html>
<head>
	<title>Lucky Sahani - Assignment 2</title>
	<meta content="CS252">
	<style></style>
</head>
<body>
	<form action="upl.php" method="post" enctype="multipart/form-data">
		<label for="file">Upload a file...</label>
		<input type="file" name="file" id="file"><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<a href="logout.php">Logout</a>
	<?php
		session_start();
		//$email2=stripslashes($_POST["email"]);
		$email = sha1($_POST["email"]);
		$password = sha1($_POST['password']);
		//$parts = explode("@", $_POST["email"]);
		//$username = $parts[0];
		//$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['email'] = $email;
		// echo "username=".$email."<br>password=".$password."<br>";
		$con=mysqli_connect(localhost,"root","qwerty","test");
		$database_name="cs252assignment2";
		$sql="USE ".$database_name;
		mysqli_query($con,$sql);
		$sql="CREATE DATABASE ".$database_name;
		mysqli_query($con,$insert);
		//$sql="CREATE TABLE login (name CHAR(40) ,password CHAR(40),primary key(name))";
		//mysqli_query($con,$sql);
		// echo "email=$email and password=$password";
		$sql="SELECT username from login where name= '$email' and password='$password'";
		echo $sql;
		$check=mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($check)) {
			//$row=mysqli_fetch_array(mysqli_query($con,$sql));
			// echo $row['username'];
			$_SESSION['username'] = $row['username'];
		}
		
		
		$check = mysqli_query($con,"SELECT * FROM login ")  ;
		$check2 = mysql_num_rows($check);
		$ans=0;
		while($row = mysqli_fetch_array($check)) {
		  // echo "<br>".$row['name'] . " " . $row['password'];
		  if(($row['name']==$email)&&($row['password']==$password)){$ans=1;}
		  elseif(($row['name']==$email)){$ans=2;}
		}
		if($ans==0){header("Location: http://127.0.0.1/register.html");}
		if($ans==2){header("Location: http://127.0.0.1/wrongpassword.html");}
		// echo "ans=$ans".$check4;
		mysqli_close($con);
	
	?> 

</body>
</html>