
alter table books add primary key(isbn);


alter table users

modify issued_books char(1) default '0';

#add constraint checkconst check(issued_books < 9);