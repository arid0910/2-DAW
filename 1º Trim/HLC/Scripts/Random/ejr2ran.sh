#!/bin/bash
CUANTOS=6
CONT=1
NUMEROS=""

while [ $CONT -le $CUANTOS ]; do
	NUM=$RANDOM
	#El $NUM entre * funciona como un include mirando si $NUM esta 	incluido en $NUMEROS
	if [[ $NUM -ge 1 && $NUM -lt 50  && "$NUMEROS" != *"$NUM"* ]]; then
		echo $NUM
		NUMEROS="$NUMEROS $NUM"
		let "CONT += 1"
	fi
done 
