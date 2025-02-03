#!/bin/bash
DIA=$(date +%d)
MES=$(date +%B)

if [ "$DIA" = "25" ]; then
	echo "$DIA de $MES FU FU FU"
else
	echo "Hoy es $DIA de $MES no 25"
fi
