#!/bin/bash
while read line                                             # it reads line by line from the file
do
 if [ "$line" == "ls" ]                                     # checks that if the line is ls and if true then perform ls
 then ls -ma
 elif [ "$line" == "ipaddress" ]                            # checks if the line is ip-address and if true then prints out the ip-address
 then ip addr show eth0 |grep 'inet '|awk '{print $2}'|cut -d '/' -f 1         #it uses terminal command + grep + awk and then cut
 elif echo $line | grep -q "chmod [0-9][0-9][0-9]"          # checks if the line have "chmod <some number>"
 then
  touch new.cpp; stat -c %a new.cpp                         # if true then it makes the file show its permissions and then change its mode.
  $line new.cpp
 elif echo $line | grep -q ^[0-9][0-9]*$                    # checks if the line is a single number
 then
  date --date @$line +"%a %b %d %Y %T %Z %z(PDT)"           # print the date as required
 elif echo $line | grep -q ^[a-zA-Z0-9_]*@[a-zA-Z0-9]*      # checks for the email id
 then
  echo "System generated mail" |mail hardik                 # it then send mail to the user
  echo Sent
 elif echo $line | grep -q ^[0-9\(]                         # it then ckecks for calculation part
 then
  echo "scale=2;$line"| bc                                  # calculate it using bc command upto 2 decimal point
 elif echo $line | grep -q \/                               # it checks for the line in which we have to echo the given text.
 then
  tmp1=`echo -e "$line" |cut -d ',' -f 1`
  tmp2=`echo -e "$line" |cut -d ',' -f 2`                   #uses the cut command to store three part in 3 different variable
  tmp3=`echo -e "$line" |cut -d ',' -f 3`
  if [ ! -d $tmp2 ]                                         # checks if the directory exist
  then
   mkdir -p "$tmp2"                                         # if not then creats it
  fi
  if [ ! -f $tmp2"/"$tmp1 ]                                  # checks if the file exist and print the output as per the result
   then
   echo Created
  else
   echo Replaced
  fi
  echo $tmp3 > $tmp2"/"$tmp1
 else
  echo ${line~~}                                             # this command will revert the case of line.
 fi
done<new.txt
