#!/bin/bash
if [ -d "$1" ]; then
    	directorio="$1"

    	archivo_mas_reciente=$(ls -t "$directorio" | head -n 1)
    
	ruta_archivo="$directorio/$archivo_mas_reciente"
	lineas_con_error=$(grep -o "Error" "$ruta_archivo" | wc -l)
	echo "La palabra 'Error' aparece en $lineas_con_error líneas del archivo $ruta_archivo"
else
    echo "El primer parámetro no es un directorio válido."
fi

