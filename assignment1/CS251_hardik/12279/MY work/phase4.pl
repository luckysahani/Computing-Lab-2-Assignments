#!usr/bin/perl
use warnings;
open(MYINPUTFILE, "<phase3.out");
my(@lines) = <MYINPUTFILE>;
$i=1;
my @AA=(0,0,0,0,0,0,0,0,0,0);
my @A=(0,0,0,0,0,0,0,0,0,0);
my @B=(0,0,0,0,0,0,0,0,0,0);
my @C=(0,0,0,0,0,0,0,0,0,0);
my @D=(0,0,0,0,0,0,0,0,0,0);
my @F=(0,0,0,0,0,0,0,0,0,0);
for(;$i<=$#lines;$i=$i+1){
	@new=split("\t",$lines[$i]);
	if($new[0] eq "A"){
		$A[$new[1]]=$new[2];
	}
	if($new[0] eq "AA"){
		$AA[$new[1]]=$new[2];
	}
	if($new[0] eq "B"){
		$B[$new[1]]=$new[2];
	}
	if($new[0] eq "C"){
		$C[$new[1]]=$new[2];
	}
	if($new[0] eq "D"){
		$D[$new[1]]=$new[2];
	}
	if($new[0] eq "F"){
		$F[$new[1]]=$new[2];
	}
}
$i=1;
open (MYFILE, '>phase4.out');
print MYFILE "0\tAA\tA\tB\tC\tD\tF\n";
for(;$i<=9;$i=$i+1){
	print MYFILE $i."\t";
	@new1=split("\n",$AA[$i]);
	print MYFILE $new1[0]."\t";
	@new1=split("\n",$A[$i]);
	print MYFILE $new1[0]."\t";
	@new1=split("\n",$B[$i]);
	print MYFILE $new1[0]."\t";
	@new1=split("\n",$C[$i]);
	print MYFILE $new1[0]."\t";
	@new1=split("\n",$D[$i]);
	print MYFILE $new1[0]."\t";
	@new1=split("\n",$F[$i]);
	print MYFILE $new1[0]."\t";
	print MYFILE "\n";
}
