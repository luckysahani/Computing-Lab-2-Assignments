create view new1 as  select dept_no, gender, count(*) as count from dept_emp d join  employees e on e.emp_no = d.emp_no  group by gender, dept_no;

select a.count/b.count from new a join new b on a.dept_no = b.dept_no and a.gender = 'M' and b.gender = 'F';

#select emp_no,gender,birth_date,first_name from employees where (first_name like 'a%' or first_name like 'A%') and timestampdiff(year,birth_date, current_date()) and gender = 'F';


#select dept_name, count, from_date from(select dept_no,count,from_date from  (select dept_no,count(*) as count,from_date from dept_emp group by dept_no, from_date)as hello where count = (select max(count2) from (select dept_no,count(*) as count2 from dept_emp group by dept_no,from_date) as hello2 )) as dep join departments d on d.dept_no = dep.dept_no ;
