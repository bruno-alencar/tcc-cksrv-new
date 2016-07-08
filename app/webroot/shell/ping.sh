#!/bin/bash

ping -t1 -c1 $1 > /dev/null

if [ $? -eq 0 ];
then
	echo '1'
else
	echo '0'
fi