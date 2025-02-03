#!/bin/bash
if [ -z "$1" ]; then
	echo -n "Introduce el directorio: "
	read directory
else
	directory=$1
fi

if [ -d "$directory" ]; then
	tar cvf "Backup-$(date +%d-%m-%Y).tar" "$directory"
else
	echo "ERROR: El directory es incorrecto o no existe"
fi

