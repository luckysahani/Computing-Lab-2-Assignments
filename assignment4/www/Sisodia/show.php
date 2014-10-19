
<h3> Hello! </h3>

<?php
//echo "Welcome";
session_start();

echo "Welcome ";
echo $_SESSION['username'];

// open this directory 
$myDirectory = opendir("upload/");

// get each entry
while($entryName = readdir($myDirectory)) {
	//if(preg_match('^$_SESSION['username']', $entryName)>0){
		$dirArray[] = $entryName;
	//}
}

// close directory
closedir($myDirectory);

//	count elements in array
$indexCount	= count($dirArray);
echo "<br>$indexCount files<br>\n";

// sort 'em
//sort($dirArray);

// print 'em
echo "<TABLE border=1 cellpadding=5 cellspacing=0 class=whitelinks>\n";
echo "<TR><TH>Filename</TH><th>Filetype</th><th>Filesize</th></TR>\n";
// loop through the array of files and print them all
//for($index=0; $index < $indexCount; $index++) {
        //if (substr($dirArray[$index], 0, 1) != "."){ // don't list hidden files
		//echo "<TR><TD><a href=" . $dirArray[$index] . ">" . $dirArray[$index] . "</a></td>";
		//echo "<TR><TD><a href=upload_file.php>Go</a></td>";
		//echo "<td>";
		//echo filetype($dirArray[$index]);
		//echo "</td>";
		//echo "<td>"
		//echo filesize($dirArray[$index]);
		//echo "</td>";
		//echo "</TR>\n";
	//}
//}
echo $dirArray[2];
echo "</TABLE>\n";

?>
