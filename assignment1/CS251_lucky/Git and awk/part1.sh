#!/bin/bash
if [ $1 == '-a' ]
 then
 shift
 while [ $# -gt 0 ]
 do
  echo $1
  echo $2
  if [ ! -d $2 ]
  then
   mkdir -p "$2"
  fi
   mv -f $1 $2
  shift 2
 done
elif [ $1 == '-b' ]
 then
 dest=$2
 if [ ! -d $2 ]
 then
  mkdir -p "$2"
 fi
 shift 2
 while [ $# -gt 0 ]
 do
  echo $1
  mv -f $1 $dest
  shift
 done
elif [ $1 == '-c' ]
 then
 file=$2
 shift 2
 while [ $# -gt 0 ]
 do
  echo $1
  if [ ! -d $1 ]
  then
   mkdir -p $1
  fi
  cp -f $file $1
  rm $file
 done
fi

  #if [ ! -f "$tmp2$tmp1" ]
