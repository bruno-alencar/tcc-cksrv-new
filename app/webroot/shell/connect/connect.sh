#!/bin/bash

#sshpass -p "$2" scp -r connect_test.txt $1@$3:/home/$1/ >> /dev/null
sshpass -p "conlicitacao" ssh conlicitacao@192.168.1.73

echo $?
