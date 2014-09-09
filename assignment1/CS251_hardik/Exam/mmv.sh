#!/bin/bash     
if [ $1 == '-a' ]                 # i am providing three modes a,b,c for different task. ai will move multiple files in multiple destination
 then
 shift                            # shifting the heads to save space
 while [ $# -gt 0 ]               # checking if we are not getting null character
 do
  if [ ! -d $2 ]                  #checks if directory with that name exist or not
  then
   mkdir -p "$2"                  # if not then it creats a new directory
  fi
   mv -f $1 $2                    # after that it moves the file into the folder
  shift 2
 done
elif [ $1 == '-b' ]               # this is second mode for moving multiple files in single destination
 then
 dest=$2                          # taking destination in input and store it in a variable
 if [ ! -d $2 ]                   #checking if that directory exist    
 then
  mkdir -p "$2"                   # if not then it creates it
 fi
 shift 2                          #shifting of headers to save space 
 while [ $# -gt 0 ]               # condition to break the loop
 do
  mv -f $1 $dest
  shift
 done
elif [ $1 == '-c' ]               #mode 3 for moving single file in multiple destination.
 then
 file=$2                          #taking the name of file to be moved and storingit in file variable.
 shift 2
 while [ $# -gt 0 ]               #condition to stop taking input
 do
  if [ ! -d $1 ]
  then
   mkdir -p "$1"
  fi
   cp -f $file $1                  # it copies the file becauuse we cannot move single file in multiple destination
  shift                 
 done
  rm $file                        # finally deleting the file  
fi
