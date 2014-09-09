A=load("data2.mat");
hist=A(:);
hist=hist';
histfile=fopen('hist.dat','w+');
fprintf(histfile,'%f\n',hist);
fprintf(histfile,'\n');
fclose(histfile);
