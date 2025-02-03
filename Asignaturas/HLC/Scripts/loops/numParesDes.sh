#!/bin/bash
contador=100
until [ $contador -eq 0 ]; 
do
	if [ $(( $contador % 2 )) -eq 0 ]; then
		echo $contador
	fi
	let contador=contador-1
done
