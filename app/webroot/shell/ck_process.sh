#!/bin/bash

# Conta os processos
PROCESS=$(ps aux |wc -l)

# verifica se a quantidade de processos é maior que a estabelecida
if [ $PROCESS -gt 1000 ]; then
	echo "1"
	exit;
else	
	if [ $PROCESS -gt 500 ]; then
		echo "2"
		exit;
	else
		echo "3"
		exit;
	fi
fi