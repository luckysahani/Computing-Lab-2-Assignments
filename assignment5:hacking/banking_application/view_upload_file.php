<!DOCTYPE html>
<?php
	include("header.php");

?>
<html>
	<title>Upload Files</title>
	<body>
	<?php echo "Login Successful<br>
		Hello ".$_SESSION['firstname']." ,Welcome to CS252 Banking Assignment<br>";
		?>
		<br>
		
		<br>
		<form action="upload_file.php" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Submit">
		</form>
		<br>
		<?php
			include("footer.php");
		?>
