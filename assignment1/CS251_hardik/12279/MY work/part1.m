pi=zeros(100,13);
r=10000+90000.*rand(100,1);
r=round(r);
r=sort(r);
r
fi = fopen('phase1.txt', 'w+');
for i =1:100
	k=round(1+rand()*8);
	pi(i,2)=k;
endfor
for i = 1:100
	k=1+round(rand()*8);
	while pi(i,2)==k
		k=1+round(rand()*8);
	endwhile
	pi(i,3)=k;
endfor
for i = 1:100
	k=round(1+rand()*8);
	while pi(i,2)==k || pi(i,3)==k
		k=1+round(rand()*8);
	endwhile
	pi(i,4)=k;
endfor
for i =(5:13)
	for j=(1:100)
		k=round(rand()*50);
		pi(j,i)=k;
	endfor
endfor
pi(:,1)=r;
csvwrite ("phase1.out",pi)
