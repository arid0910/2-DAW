#!/bin/bash

if [ -z "$1" ]; then
    echo -n "Introduce el directorio: "
    read directory
else
    directory=$1
fi

if [ ! -d "$directory" ]; then
    echo "Error: El directorio '$directory' no existe."
    exit 1
fi

file_cont=0
dir_cont=0

for elem in $(ls "$directory"); do
    if [ -f "$directory/$elem" ]; then
        ((file_cont++))  
    elif [ -d "$directory/$elem" ]; then
        ((dir_cont++))  
    fi
done

echo "En el directorio '$directory':"
echo "Archivos regulares: $file_cont"
echo "Directorios: $dir_cont"

