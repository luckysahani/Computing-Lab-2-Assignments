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
		date_default_timezone_set('Asia/Kolkata');
		session_start();
		$username=$_SESSION['username'] ;
		$password=$_SESSION['password'] ;
		$email=$_SESSION['email'] ;
		$uploaddir = '/home/archit/upload/';
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['email'] = $email;
		// echo "username=".$username."password=".$password."email=".$email;
		$con=mysqli_connect(localhost,"root","qwerty","test");
		$database_name="cs252assignment2";
		$sql="USE ".$database_name;
		mysqli_query($con,$sql);
		$table_name="CS252";
		$sql="CREATE TABLE ".$table_name." (username CHAR(40),name CHAR(40),type CHAR(40),size INT,stored_temp CHAR(40),uploaded_file VARCHAR(100))";
		if (mysqli_query($con,$sql)) {
		  // echo "Table ".$table_name." created successfully<br>";
		} 
		if ($_FILES["file"]["error"] > 0) 
		{
			if ($_FILES["file"]["size"]>1000000){
				echo "<br>File size limit exceed. Allowable is max 1 Mb.";
			}
			else
			echo "<br>Error: " . $_FILES["file"]["error"] . "<br>";
		}
		if ($_FILES["file"]["size"]>1000000){
				echo "<br>File size limit exceed. Allowable is max 1 Mb.";
			}
		elseif($_FILES["file"]["type"]=="application/x-php"){
			echo "<br>Error: cant upload .php files";
		}

		// $date = date_create();
		// echo date_timestamp_get($date);
		else
		{
			 $date = date_create();
			// echo date_timestamp_get($date);
			 if (file_exists($uploaddir . basename($username."_".$_FILES['file']['name']))){
			 	$uploadfile=$uploaddir .$username."_".basename($_FILES['file']['name'],".".pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION))."_".date_timestamp_get($date).".".pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			 }
			 else{$uploadfile = $uploaddir . basename($username."_".$_FILES['file']['name']);}
			//$uploadfile = $uploaddir . basename($username."_".$_FILES['file']['name']);
			if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	    		echo "<br>File is valid, and was successfully uploaded.<br>";
			} 		
			else {
			    echo "<br>Possibly file upload interrupted!<br>";
			}
			
			$sql="INSERT INTO CS252 VALUES ('".$email."', '".$_FILES["file"]["name"]."', '".$_FILES["file"]["type"]."', '".$_FILES["file"]["size"]."' , '".$_FILES["file"]["tmp_name"]."', '".$uploadfile."')";
			mysqli_query($con,$sql);
			$result = mysqli_query($con,"SELECT * FROM ".$table_name." where username = '".$email."'");
			echo "<table border='1'><tr><th>File Name</th><th>Type</th><th>Size(B)</th><th>Stored in</th><th>Uploaded Location</th></tr>";
			while($row = mysqli_fetch_array($result)) {
				// if($row["type"]!="application/pdf"){
				echo "<tr>";
				echo "<td>" . $row["name"] . "</td>";
				echo "<td>" . $row['type'] . "</td>";
				echo "<td>" . $row['size'] . "</td>";
				echo "<td>" . $row['stored_temp'] . "</td>";
				echo "<td>" . $row['uploaded_file'] . "</td>";
				echo "</tr>";
				// }
			}
			echo "</table>";
			mysqli_close($con);
		}
	?> 
		<a href="logout.php"><br>Logout</a>

</body>
</html>