#!/bin/bash
CUANTOS=10
CONT=1

while [ $CONT -le $CUANTOS ]; do
	NUM=$RANDOM
	if [[ $NUM -ge 10 && $NUM -le 1000 ]]; then
		echo $NUM
		let "CONT += 1"
	fi
done
