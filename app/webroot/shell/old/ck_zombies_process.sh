#!/bin/bash

# Conta processos zombies
PROCESS_ZOMBIE=$(ps aux |grep Z |wc -l)

if [ $PROCESS_ZOMBIE -gt 3 ]; then
	echo "1"
	exit;
else	
	if [ $PROCESS_ZOMBIE -gt 5 ]; then
		echo "2"
		exit;
	else
		echo "3"
		exit;
	fi
fi