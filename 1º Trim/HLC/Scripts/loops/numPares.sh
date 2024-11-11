#!/bin/bash
contador=0
while [ $contador -lt 101 ]; 
do
	if [ $(( $contador % 2 )) -eq 0 ]; then
		echo $contador
	fi
	let contador=contador+1
done
