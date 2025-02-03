#!/bin/bash

HELLO=hello #assign hello to the variable HELLO

function hello { #I created the hello function, the square brackets delimit the function

     local HELLO=holita #I create a local variable HELLO that will only work INSIDE the function

     echo $HELLO #show the content of the local variable HELLO that will contain “holita”

}

echo $HELLO #will display the contents of the variable HELLO on the second line

hello #I call the function that will show on the screen hello

echo $HELLO #show again the contents of the variable HELLO of the second line

function hola {
	local HOLA=Hola 
	echo $HOLA
}

hola
