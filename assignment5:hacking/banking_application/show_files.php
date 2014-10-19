<!DOCTYPE html>
<html>
	<body>
<?php
	include("header.php");

?>
<html>
	<title>View Uploaded Files</title>
	<body>
	<?php echo "Login Successful<br>
		Hello ".$_SESSION['firstname']." ,Welcome to CS252 Banking Assignment<br>";
		?>
		<br>
<?php
echo "View your files here:<br>";
foreach(glob("upload/".$_SESSION['firstname']."_*") as $file){
	$temp = basename($file,PATHINFO_FILENAME);
	//echo $temp." size= ".filesize($file)." <br>";
	echo "<a href=\"show_files_2.php?&file_name=$file\"> $temp </a> <br>";
}
?>


	<br>
	<?php
		include("footer.php");
	?>
