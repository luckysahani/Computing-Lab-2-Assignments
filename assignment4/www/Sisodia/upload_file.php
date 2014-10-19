<?php session_start(); ?>
<html>
<body>

<h3>Welcome <?php echo $_SESSION['username'];?></h3>
<a href=logout.php>Logout</a>
<form action="upload_file.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>



<?php

$notAllowedExts = array("php");

$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if (($_FILES["file"]["size"] < 1073741824) && !in_array($extension, $notAllowedExts)) {

	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} 
	else {
		if (file_exists("upload/" . $_SESSION['username'] ."_". $_FILES["file"]["name"])) {
		$date = date_create();
			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_SESSION['username'] . "_" . $_FILES["file"]["name"]."_".date_format($date,'U'));
			echo $_FILES["file"]["name"]."_". date_format($date,'U') . " saved.";
		} 
		else {
			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_SESSION['username'] . "_" . $_FILES["file"]["name"]);
			echo $_FILES["file"]["name"] . " saved.";
		}
	}
}
else echo "Invalid File!";
	?>

		<a href=upload>Show Files</a>
		</body>
		</html>
