#include <bits/stdc++.h>
using namespace std;
int DP[2600][2600];
int st[2600][2600],en[2600][2600];
int Count[2610][26];
char S[60000];
int bin_src(int i , int j)
{
	if(Count[j][S[j]-'a']-Count[i][S[j]-'a']<=0)return j;
	int l = i , r = j-1 , mid;
	while(r-l>1)
	{
		mid = (l+r)/2;
		if(Count[mid+1][S[j]-'a']-Count[i][S[j]-'a']>0)r = mid;
		else l = mid;
	}
	if(Count[l+1][S[j]-'a']-Count[i][S[j]-'a']>0)return l;
	else return r;
}

int solve(int i , int j)
{
	if(i>j)return 0;
	if(i==j)
	{
		DP[i][j] = 1;
		st[i][j]=en[i][j]=i;
		return 1;
	}
	if(DP[i][j]>0)return DP[i][j];

	int t = bin_src(i,j);
	int max1 = -1;
	if(t<j)max1 = solve(t+1,j-1)+2;
	int max2 = solve(i,j-1);
	if(max1>max2)
	{
		st[i][j]=t;
		en[i][j]=j;
	}
	else
	{
		st[i][j]=st[i][j-1];
		en[i][j]=en[i][j-1];
	}
	return DP[i][j]=max(max1,max2);
}
vector<char> vv;
void print_ans1(int i , int j)
{
	if(i>j)return;
	if(DP[i][j] == 1){
		vv.push_back(S[st[i][j]]);
		return;
	}
	int ss = st[i][j], e = en[i][j];
	vv.push_back(S[ss]);
	print_ans1(ss+1, e-1);
}

void print_ans(int i, int j){
	print_ans1(i,j);
	int n = DP[i][j];
	if(n == 101) vv.pop_back(), n-=1;
	for(int ii=0;ii<vv.size();++ii){
		putchar(vv[ii]);
	}
	reverse(vv.begin(), vv.end());
	for(int ii=n%2;ii<vv.size();++ii){
		putchar(vv[ii]);
	}
	putchar(10);
	return ;
}
int main()
{
	int l;
	scanf("%s",S);
	l = strlen(S);
	if(l>=2600)
	{
		int xx[26];
		memset(xx,0,sizeof xx);
		for(int i=0;i<l;i++)
		{
			xx[S[i]-'a']++;
		}
		for(int i=0;i<26;i++)
		{
			if(xx[i]>=100)
			{
				// printf("100\n");
				for(int k=0;k<100;k++)
					printf("%c",'a'+i);
				printf("\n");
				return 0;
			}
		}
	}
	else
	{
		memset(Count,0,sizeof Count);
		for(int i=0;i<l;i++)
		{
			for(int j=0;j<26;j++)
			{
				Count[i+1][j]=Count[i][j];
			}
			Count[i+1][S[i]-'a']++;
		}
		memset(DP,-1,sizeof DP);
		for(int i=0;i<l;i++)
			for(int j=i;j<l;j++)
				if(DP[i][j]<0)solve(i,j);
		int ans = -100;
		for(int i=0;i<l;i++)
		{
			for(int j=i;j<l;j++)
			{
				ans = max(ans , DP[i][j]);
				if(DP[i][j]==100 || DP[i][j] == 101)
				{
					// printf("%d\n",DP[i][j]);
					print_ans(i,j);
					return 0;
				}
			}
		}
		// printf("%d\n",ans);
		assert(ans < 100);
		for(int i=0;i<l;i++)
		{
			for(int j=i;j<l;j++)
			{
				if(DP[i][j]==ans)
				{
					print_ans(i,j);
					return 0;
				}
			}
		}

	}
}