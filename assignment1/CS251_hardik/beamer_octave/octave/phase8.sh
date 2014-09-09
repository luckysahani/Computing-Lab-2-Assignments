#!/bin/bash
octave phase1.m
perl phase2.pl
mysql test < phase2.sql
mysql test -e 'select grade,course,count(*) from marks group by grade,course'> phase3.out
perl phase4.pl
gnuplot < histogram.txt
