<?php
	include("header.php");

	if(isset($_GET['file_name'])){
		$file = $_GET['file_name'];
		echo "$file<br>";
		if (file_exists($file))
		{
			$contents = file_get_contents($file);
			//header('Content-Type: ' . mime_content_type($filepath));
			echo $contents;
		}
		else
		{
			echo "The file you are looking for does not exist<br>";
		}
	}
	else{
		echo "You are at a wrong place<br>";

	}
?>
