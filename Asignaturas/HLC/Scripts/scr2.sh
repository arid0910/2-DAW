#!/bin/bash

#creacion de directorio y archivos
mkdir pruebaScr;
cd pruebaScr;
touch scr1.sh;
touch scr2.sh;

#Creación del tar
cd ..;
tar cvf `hola$(date +%d-%m-%Y)`  `/home/usuario/pruebaScr`


