pkg load statistics
pi = zeros(7,10);
data = fopen('data2.mat','w+');
for n=8:8
    for i=1:10
        r = rand(10^n,2);
        r = r*2 - 1;
        a = r(:,1);
        b = r(:,2);
        a = a .^ 2;
        b = b .^ 2;
        c = a+b;
        d = c<=1;
	sum(d)
        val = sum(d)*4/10^n;
        pi(n-1,i)=val;
	clear r
    endfor
    fprintf(data,'%f ',pi(n-1,:))
    fprintf(data,'\n');
endfor
fclose(data);
