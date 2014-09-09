#!usr/bin/perl
use warnings;
open(FILE1, "phase3.out");
open (FILE2, '>phase4.out');
my @phase3 = <FILE1>;
my @phase4 = <FILE2>;
$i=0;
for (;$i<11;$i=$i+1)
{
	$AA[$i]=0;
	$A[$i]=0;
	$B[$i]=0;
	$C[$i]=0;
	$D[$i]=0;
	$F[$i]=0;
	$temp1[$i]=0;
	$temp2[$i]=0;
	$temp3[$i]=0;
	$temp4[$i]=0;
	$temp5[$i]=0;
	$temp6[$i]=0;


}
$i=0;
for(;$i<=$#phase3;$i=$i+1)
{
	@temp=split("\t",$phase3[$i]);
	if($temp[1] eq "AA")
	{
		$AA[$temp[0]]=$temp[2];
	}
	if($temp[1] eq "A")
	{
		$A[$temp[0]]=$temp[2];
	}
	if($temp[1] eq "B")
	{
		$B[$temp[0]]=$temp[2];
	}
	if($temp[1] eq "C")
	{
		$C[$temp[0]]=$temp[2];
	}
	if($temp[1] eq "D")
	{
		$D[$temp[0]]=$temp[2];
	}
	if($temp[1] eq "F")
	{
		$F[$temp[0]]=$temp[2];
	}
}
$i=1;
for(;$i<10;$i=$i+1){
	print FILE2 $i."\t";
	@temp1=split("\n",$AA[$i]);
	@temp2=split("\n",$A[$i]);
	@temp3=split("\n",$B[$i]);
	@temp4=split("\n",$C[$i]);
	@temp5=split("\n",$D[$i]);
	@temp6=split("\n",$F[$i]);
	print FILE2 $temp1[0]."\t";
	print FILE2 $temp2[0]."\t";
	print FILE2 $temp3[0]."\t";
	print FILE2 $temp4[0]."\t";
	print FILE2 $temp5[0]."\t";
	print FILE2 $temp6[0]."\t";
	print FILE2 "\n";

}
