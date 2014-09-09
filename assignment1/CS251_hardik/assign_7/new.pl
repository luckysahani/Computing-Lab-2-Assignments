#!usr/bin/perl
use warnings;
$user="root";
$case=$ARGV[0];
if($case eq "-i"){
	$i=1;$flag=1;$fields="";$values="";
	for(;$i<$#ARGV;$i=$i+2){
		if($ARGV[$i+1] =~ m/^[0-9-]+$/){
			$fields=$fields.$ARGV[$i]." ,";
			$values=$values."\"".$ARGV[$i+1]."\" ,";
		}
		else{ $x=$i;$flag=0; }
	}
	if($flag){
		chop($fields);chop($values);
		system "mysql -u $user -ps14 employees -e 'insert into salaries($fields) values($values)'";
	}
	else{
		$fields=$fields.$ARGV[$x];
		@values=split(",",$ARGV[$x+1]);
		$j=0;
		for(;$j<=$#values;$j=$j+1){
			@cval=split(":",$values[$j]);
			if($#cval==0){
				$tmp=$values."\"".$cval[0]."\"";
				system "mysql -u $user -ps14 employees -e 'insert into salaries($fields) values($tmp)'";
			}
			if($#cval==1){
				if(($ARGV[$x] eq "emp_no" || $ARGV[$x] eq "salary")){
					$val=$cval[0];
					for(;$val<=$cval[1];$val=$val+1){
						$tmp=$values."\"".$val."\"";
						system "mysql -u $user -ps14 employees -e 'insert into salaries($fields) values($tmp)'";
					}
				}
				else{
					@time = (0, 0, 0);
					($y, $m, $d) = split("-", $cval[0]);
					$y-=1900;$m--;
					$offset= 0;
						$tmp=$values."\"".$date."\"";
						$offset=$offset+1;
						system "mysql -u $user -ps14 employees -e 'insert into salaries($fields) values($tmp)'";
					while (($date = strftime("%Y-%m-%d", @time, $d + $offset, $m, $y)) le $cval[1]){
					}
				}
			}
		}
	}	
}
elsif($case eq "-u"){
	$que="update salaries set ";
	@arr=@ARGV;
	$key=$arr[1];
	$val=$arr[2];
	if($arr[3] ne "emp_no" and $arr[3] ne "salary" and $arr[3] ne "from_date" and $arr[3] ne "to_date"){
		$que2=$que.$key."=\"".$arr[3]."\" where ".$key."=\"".$val."\";";
#		print $que."\n";
		system "mysql -u root -ps14 employees -e '$que2'";
		exit();
	}
	$que1="where ";
	@arr2=split(":",$val);
	if($#arr2==0){
		$que1=$que1." ".$key." = \"".$arr2[0]."\" ";
	}
	elsif($#arr2==1 and ($key eq "emp_no" and $arr2[0]<=$arr2[1]) or ($key ne "emp_no" and $arr2[0] lt $arr2[1])){
		$que1=$que1." ".$key." between \"".$arr2[0]."\" and \"".$arr2[1]."\" ";
	}
	$i=3;
	for(;$i<=$#arr;$i=$i+2){
		$que =$que.$arr[$i]." = ".$arr[$i+1].",";
	}
	$que=~ s/,$/ /;
	$que=$que.$que1."\;";
#	print "$que"."\n";
	system "mysql -u root -ps14 employees -e '$que'";
}
else{
	if($ARGV[0] eq "-d"){
		$que="Delete from salaries where ";
		$i=1;
	}
	else{
		$que="Select * from salaries where ";
		$i=0;
	}
	%hash=();
		@arr=@ARGV;
	for(;$i<=$#ARGV;$i=$i+3){
	#	$ARGV[$i]=~ s/-(.*)$/$1/;
		$hash{$ARGV[$i+1]}=$ARGV[$i+2];
	}
	while (($key, $val) = each(%hash)){
		$que=$que." \( ";
		@arr1=split(",",$val);
		$j=0;
		for(;$j<=$#arr1;$j=$j+1){
			@arr2=split(":",$arr1[$j]);
			if($#arr2==0){
				$que=$que." ".$key." = \"".$arr2[0]."\" "." or";
			}
			elsif($#arr2==1 and ($key eq "emp_no" and $arr2[0]<=$arr2[1]) or ($key ne "emp_no" and $arr2[0] lt $arr2[1])){
				$que=$que." ".$key." between \"".$arr2[0]."\" and \"".$arr2[1]."\" "." or";
			}
			else{
				print "ERROR in "."$key"." \n";
				exit;
			}
		}
		$que=~s/or$/\) and/;
	}
	$que=~s/and$/\;/;
#	print "$que"."\n";
	system "mysql -u root -ps14 employees -e '$que'";
}
