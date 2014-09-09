#!usr/bin/perl
use warnings;
$user=root;
$password=sahani;
system "mysql -u$user -p$password test -e 'use test'";
system "mysql -u$user -p$password test -e 'drop table marks'";
system "mysql -u$user -p$password test -e 'drop table names'";
system "mysql -u$user -p$password test -e 'create table marks (roll INT(5) ,course INT(1),assignment INT(2),project INT(2), exam INT(2),primary key(roll,course))'";
system "mysql -u$user -p$password test -e 'create table names (roll INT(5) primary key,name varchar(30))'";
$var=0;
open(FILE, "<phase1.out");
my @input = <FILE>;
open(FILE2, "<names.txt");
my(@input2) = <FILE2>;

for($var=0;$var<=$#input;$var=$var+1){
	@input1 = split(",",$input[$var]);
	system "mysql -u$user -p$password test -e 'insert into marks values ($input1[0] , $input1[1] , $input1[4] , $input1[7] , $input1[10])'";
	system "mysql -u$user -p$password test -e 'insert into marks values($input1[0],$input1[2],$input1[5],$input1[8],$input1[11])'";
	system "mysql -u$user -p$password test -e 'insert into marks values ($input1[0],$input1[3],$input1[6],$input1[9],$input1[12])'";
}
for($var=0;$var<=$#input2;$var=$var+1){
	@input3=split(",",$input[$var]);
	@input4=split(" ",$input2[$var]);
	system "mysql -u$user -p$password test -e 'insert into names values ($input3[0],\"$input4[0]\")'";
}