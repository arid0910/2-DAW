#!/bin/bash

function comproParams {
if [ -z $2 ]; then
	echo "Has introducido 2 parametros"
else 
	echo "No hay 2 parametros"
fi
}

comproParams
