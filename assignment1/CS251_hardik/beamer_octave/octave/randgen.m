function randgen
	B=zeros(8,10);
	for j = (2:4)
		sz=10^j;
		for i = (1:10)
			printf ("%d\n",i);
			A=rand(sz,2);
			A=A.*2;
			total=0;
	#{		for k = (1:sz)
				if(((A(k,1))^2+(A(k,1))^2)<1)
				total=total+1;
				endif
			pi=(4*total)/sz;
			B(j,i)=pi
			endfor#}
		endfor
	endfor
endfunction

