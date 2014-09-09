#!/usr/bin/bash
mysql -u root -psahani test -e'select marks.course,marks.roll,names.name,marks.total from marks inner join names on marks.roll = names.roll;
' | sort -k1,1n -k4,4nr  > var1.in
sed -i 1d var1.in
var2=0
var3=0
var4=1
var5=151
while IFS=$'\t' read -r -a arr
do
        if [[ "$var4" -eq "${arr[0]}" ]] ; then
		if [[ "$var5" -ne "${arr[3]}" ]]; then
			var3=$((var2))
			var3=$((var3+1))
		fi
                echo $var3 >> temp.out
		var5=${arr[3]}
                var2=$((var2+1))
        else
                var3=1
                echo $var3 >> temp.out
		var2=1
                var4=${arr[0]}
		var5=151
        fi
done < var1.in
paste -d'	' var1.in temp.out > var6.out
rm -rf temp.out
rm -rf var1.in
awk -F "	" '{print $1, $2, $3, $5, $4}' var6.out > phase7.out
rm -rf var6.out
