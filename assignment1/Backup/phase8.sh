#!/bin/bash

octave phase1.m
perl phase2.pl
mysql -u root -psahani test < phase3.sql > temp1.out
sed '1d' temp1.out>phase3.out

