#!usr/bin/perl
use warnings;

system "mysql test -e 'drop table marks'";
system "mysql test -e 'create table marks (roll INT(5) ,course INT(1),assignment INT(2),project INT(2), exam INT(2),primary key(roll,course))'";
open(MYINPUTFILE, "<phase1.out");
my(@lines) = <MYINPUTFILE>;
$i=0;
for(;$i<=$#lines;$i=$i+1){
	@new=split(",",$lines[$i]);
	system "mysql test -e 'insert into marks values ($new[0] , $new[1] , $new[4] , $new[7] , $new[10])'";
	system "mysql test -e 'insert into marks values($new[0],$new[2],$new[5],$new[8],$new[11])'";
	system "mysql test -e 'insert into marks values ($new[0],$new[3],$new[6],$new[9],$new[12])'";
}
system "mysql test -e 'drop table names'";
system "mysql test -e 'create table names (roll INT(5) primary key,name varchar(30))'";
open(MYINPUTFILE, "<names.txt");
my(@lines1) = <MYINPUTFILE>;
$i=0;
for(;$i<=$#lines1;$i=$i+1){
	@new=split(",",$lines[$i]);
	@new1=split(" ",$lines1[$i]);
	system "mysql test -e 'insert into names values ($new[0],\"$new1[0]\")'";
}
