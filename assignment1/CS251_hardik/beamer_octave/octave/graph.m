A=load("data2.mat");
A=A';
boxplot(A);
print -deps -color graph.eps
