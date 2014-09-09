list=zeros(100,13);
roll=zeros(100,1);
temp=sort(rand(100,1));
for i=1:100
	roll(i)=10000+90000*temp(i);
	roll=round(roll);
	list(i,1)=roll(i);
	course1=1+round(8*rand(1,1));
	list(i,2)=course1;
	course2=1+round(8*rand(1,1));
	while course2==course1
		course2=1+round(8*rand(1,1));
	endwhile
	list(i,3)=course2;
	course3=1+round(8*rand(1,1));
	while course3==course1 || course3==course2
			course3=1+round(8*rand(1,1));
	endwhile
	list(i,4)=course3;
	for j=5:13
		list(i,j)=round(50*rand(1,1));
	endfor
endfor

list(:,1)=sort(list(:,1));
csvwrite("phase1.out",list);


