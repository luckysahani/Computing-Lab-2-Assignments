create database if not exists library;

use library;

create table if not exists books (
	isbn char(10) unique,
	#isbn int unique,
	title varchar(30) not null,
	author varchar(20) default 'Anonymous',
	copies int unsigned default 1
);

create table if not exists users (
	student_id char(5) not null,
	birth_year char(4),
	gender ENUM('M','F'),
	#issued_books int  check(issued_books < 99)
	issued_books char(2) default '00'
);


	