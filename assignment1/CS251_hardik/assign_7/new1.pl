#!/usr/bin/perl
open(MYINPUTFILE, "<new.txt");
my(@lines) = <MYINPUTFILE>;
use warnings;
@new=split("\t",$lines[1]);
$curr1=$new[0];
$sum=$new[1];
$count=1;
$i=2;
$max=0;
for(;$i<=$#lines;$i=$i+1){
	@new=split("\t",$lines[$i]);
	#	print $new[0]."\n";
		if($new[0] > $curr1){
			$avg=$sum/$count;
	#		print $avg."\n";
			if($avg>$max){
				$max=$avg;
			}
			$curr1=$new[0];
			$count=0;
			$sum=0;
		}
		$count=$count+1;
		$curr=$sum+$new[1];
		$sum=$curr;
	#	print $sum."\n";
}
$avg=$sum/$count;
if($avg>$max){
	$max=$avg;
}
print $max."\n";

