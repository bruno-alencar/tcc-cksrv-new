#!/bin/bash

USUARIOS=$(uptime |cut -d',' -f3 |cut -d' ' -f2)

if [ $USUARIOS -gt 5 ]; then
	echo "1"
	exit;
else	
	if [ $USUARIOS -gt 3 ]; then
		echo "2"
		exit;
	else
		echo "3"
		exit;
	fi
fi
