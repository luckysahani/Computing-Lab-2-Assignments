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
	
	<?php
		session_start();
		$username=$_SESSION['username'] ;
		$password=$_SESSION['password'] ;
		$email=$_SESSION['email'] ;
		$uploaddir = '/home/lucky/cs252/assignment2/';
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['email'] = $email;
		echo "username=".$username."password=".$password."email=".$email;
		$uploadfile = $uploaddir . basename($username."_".$_FILES['file']['name']);
		$con=mysqli_connect(localhost,"lucky","sahani","test");
		$database_name="cs252assignment2";
		$sql="USE ".$database_name;
		mysqli_query($con,$sql);
		$table_name="CS252";
		$sql="CREATE TABLE ".$table_name." (username CHAR(40),name CHAR(40),type CHAR(40),size INT,stored_temp CHAR(40),uploaded_file CHAR(40))";
		if (mysqli_query($con,$sql)) {
		  echo "Table ".$table_name." created successfully<br>";
		} 
		if ($_FILES["file"]["error"] > 0) 
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
	    		echo "File is valid, and was successfully uploaded.<br>";
			} 		
			else {
			    echo "Possibly file upload interrupted!<br>";
			}
			$sql="INSERT INTO ".$table_name." VALUES ('".$email."', '".$_FILES["file"]["name"]."', '".$_FILES["file"]["type"]."', ".($_FILES["file"]["size"] );
			$sql=$sql." , '".$_FILES["file"]["tmp_name"]."', '".$uploadfile ."')";
			$result = mysqli_query($con,"SELECT * FROM ".$table_name." where username = '".$email."'");
			echo "<table border='1'><tr><th>File Name</th><th>Type</th><th>Size(B)</th><th>Stored in</th><th>Uploaded Location</th></tr>";
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $row["name"] . "</td>";
				echo "<td>" . $row['type'] . "</td>";
				echo "<td>" . $row['size'] . "</td>";
				echo "<td>" . $row['stored_temp'] . "</td>";
				echo "<td>" . $row['uploaded_file'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			mysqli_close($con);
		}
	?> 
</body>
</html>