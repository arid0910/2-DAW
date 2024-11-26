#!/bin/bash
VAR=0

while [ $VAR -ne 4 ]; do
	echo "1- List the script"
	echo "2- List the srcipt for the last line to the first"
	echo "3- List the script with the lines reversed form rigt to left"
	echo "4- Exit"
	
	read VAR
	
	case $VAR in
		1) cat ejr1Men.sh
		;;
		2) tac ejr1Men.sh
		;;
		3) cat ejr1Men.sh | rev
		;;
		4) echo "Goodbye"
		;;
	esac
done
