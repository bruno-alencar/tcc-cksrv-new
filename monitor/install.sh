#!/bin/bash

# Cria diretório mysql
# mkdir sql

# Pergunta ao usuário o ip do servidor de monitoramento
echo "Por gentileza ip do servidor de monitoramento/MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read ipserver

# Pergunta ao usuário o nome da base de dados
echo "Por gentileza insira o nome da base de dados do MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read database

# Pergunta ao usuário o usuário mysql
echo "Por gentileza insira o usuário do MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read usermysql

# Pergunta ao usuário a senha do mysql
echo "Por gentileza insira a senha do MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read pwmysql

# # Joga os dados da variável em um arquivo de texto
# echo $ipserver > sql/mysql_server.txt

# # Joga os dados da variável em um arquivo de texto
# echo $database > sql/mysql_database.txt

# # Joga os dados da variável em um arquivo de texto
# echo $usermysql > sql/mysql_user.txt

# # Joga os dados da variável em um arquivo de texto
# echo $pwmysql > sql/mysql_password.txt

# Pergunta ao usuário o ip do servidor a ser monitorado
# echo "Por gentileza insira o IP desta máquina que deverá ser monitorada: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read ip

# Da um find no id do servidor cadastrado em base
serv_id=`mysql -h $ipserver -u $usermysql -p$pwmysql -e "select id from servidores where status_id=1 AND ip='$ip'" --database $database |sed 1d`

# Joga os dados da variavel em um arquivo
# echo $serv_id > id.txt
echo $serv_id
# Cadastra o monitor no crontab
# echo '* * * * * /home/cksrv/monitor/monitor_client.sh'