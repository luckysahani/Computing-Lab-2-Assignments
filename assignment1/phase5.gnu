set title "Phase 5"
set auto x
set yrange [0:30]
set style data histogram
set style histogram cluster gap 1
set ylabel "No. of students"
set xlabel "Course No."
set style fill solid border -1
set boxwidth 0.9
set term png
set output "phase5.png"
plot 'phase4.out' using 2:xtic(1)  ti col, '' u 3 ti col, '' u 4 ti col, '' u 5 ti col, '' u 6 ti col,'' u 7 ti col
