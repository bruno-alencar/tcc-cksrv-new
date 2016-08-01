#!/bin/bash

# Atenção, a variavel $1 deve ser passada na hora de chamar o script ex: "./ck_ping.sh 192.168.2.215"
timeout 5s ping -c1 $1 > /dev/null

if [ $? -ne 0 ];
	echo "1"
	exit;
else
	echo "2"
	exit;
fi