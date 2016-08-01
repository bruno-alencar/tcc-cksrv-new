#!/bin/bash

#sshpass -p "\"$1\"" scp -r connect_test.txt $2@$3:/tmp >> /dev/null
#./connect.sh
/Library/WebServer/Documents/alfa_ck/app/webroot/shell/connect/connect.sh
echo $?;
