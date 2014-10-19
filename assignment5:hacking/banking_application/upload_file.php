<!DOCTYPE html>
<?php
include("header.php");
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);


if($_FILES["file"]["error"]>0){
	echo "UPLOAD ERROR ! Return Code: " . $_FILES["file"]["error"] . "<br>";
}
elseif ($extension == "php") {
	echo "SORRY, .php files are not allowed !<br>";
}
elseif($_FILES["file"]["size"] > 1024*1024){
	echo "Error: File size is above than 1 MB ! <br>";
}
else{
	echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    $time_stamp = time();
    if (file_exists("upload/" . $_SESSION['firstname']."_".$_FILES["file"]["name"])) {
      	$cwd= getcwd();
      	$name_arr = split("\.",$_FILES["file"]["name"]);
      	move_uploaded_file($_FILES["file"]["tmp_name"],
      	$cwd."/upload/" .$_SESSION['firstname']."_".$name_arr[0]."_".$time_stamp.".".$name_arr[1]);
      	echo "Successfully Uploaded in: " .$_SESSION['firstname']."_".$name_arr[0]."_".$time_stamp.".".$name_arr[1]."<br>";
    } 
    else {

    	$cwd= getcwd();
      	move_uploaded_file($_FILES["file"]["tmp_name"],
      	$cwd."/upload/" .$_SESSION['firstname']."_".$_FILES["file"]["name"]);
      	echo "Successfully Uploaded in: " .$_SESSION['firstname']."_".$_FILES["file"]["name"]."<br>";
    }
}

?>
<html>
  <title>Upload</title>
	<body>
	<?php
    include("footer.php");
  ?>
