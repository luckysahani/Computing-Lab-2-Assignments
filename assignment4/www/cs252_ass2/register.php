<html>
<head>
	<title>Lucky Sahani - Assignment 2</title>
	<meta content="CS252">
	<style></style>
</head>
<body>
	<form action="upl.php" method="post" enctype="multipart/form-data">
		<label for="file">Upload another file...</label>
		<input type="file" name="file" id="file"><br>
		<input type="submit" name="submit" value="Submit">
	</form>
		<a href="logout.php">Logout</a>

	<?php
		session_start();
		$email = sha1($_POST["email"]);
		$password = sha1($_POST['password']);
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
		  echo "Table ".$table_name." created successfully<br>";
		} 
		$insert = "INSERT INTO login VALUES ('" . $username."','" . $email. "','" . $password."')" ;
		mysqli_query($con,$insert);
		mysqli_close($con);
	?> 
	
</body>
</html>