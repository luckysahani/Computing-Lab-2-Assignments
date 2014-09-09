#!/bin/bash

ln -s phase1.out phase2.in
ln -s phase3.out phase4.in
ln -s phase4.out phase5.in


octave phase1.m
perl phase2.pl
mysql -u root -psahani test < phase3.sql > temp1.out
sed '1d' temp1.out>phase3.out
perl phase4.pl
gnuplot phase5.gnu
pdflatex phase6.tex
bibtex phase6
pdflatex phase6.tex
pdflatex phase6.tex
bash phase7.sh

