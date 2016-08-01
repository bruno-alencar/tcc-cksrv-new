#!/bin/bash

# Busca o load atual da máquina 
LOAD=$(uptime |cut -d',' -f6 |cut -d' ' -f2)

# verifica se o load é maior que 10
if [ $LOAD -gt 10 ]; then
	echo "1"
	exit;
else	
	# verifica se o load é maior que 5
	if [ $LOAD -gt 5 ]; then
		echo "2"
		exit;
	else
		echo "3"
		exit;
	fi
fi