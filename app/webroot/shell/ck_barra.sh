#!/bin/bash

# Define tamanho total 
TAMANHO_ATUAL=$(df -h / |grep / |cut -d' ' -f9 |cut -d'G' -f1)


TAMANHO_TOTAL=$(df -h / |grep / |cut -d' ' -f3 |cut -d'G' -f1)

DEZ=$[$TAMANHO_TOTAL * 10/100]
CINCO=$[$TAMANHO_TOTAL * 5/100]

if [ "$TAMANHO_ATUAL" -lt "$CINCO" ]; then
	echo "1"
	exit;
else
	
	if ["$TAMANHO_ATUAL" -lt "$DEZ"]; then
		echo "2"
		exit;
	else
		echo "3"
		exit;
	fi
fi
