A=load("data2.mat");
A=A';
B=zeros(7,1);
for i=(1:7)
	B(i,1)=mean(A(:,i));
endfor
boxplot(B);
print -deps -color graph2.eps
