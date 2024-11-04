#!/bin/bash
keyword=$(cat "keyword.txt")

if [ "$keyword" = "myfpschool" ]; then
	echo "The keyword matches"
else
	echo "The keyword doesnt match"
fi
