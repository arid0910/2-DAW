#!/bin/bash
# Lee el fichero linea por linea
while read -r line; do
  # Pone : como delimitador
  IFS=':' read -r username _ userid _ <<< "$line"
  # Muestra el usuario y el id de usuario
  echo "$username => $userid"
done < /etc/passwd

