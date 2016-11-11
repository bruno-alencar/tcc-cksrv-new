#!/bin/bash

USER=`whoami`
# # # Verifica se esta sendo executado como root # # #
if [ $USER != "root" ]; then
	echo "Favor executar como ROOT"
	exit
fi

# Cria diretório mysql
mkdir sql

# Pergunta ao usuário o ip do servidor de monitoramento
echo "Por gentileza ip do servidor de MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read ipserver
# # Joga os dados da variável em um arquivo de texto
echo $ipserver > sql/mysql_server.txt


# Pergunta ao usuário o nome da base de dados
echo "Por gentileza insira o nome da base de dados do MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read database
# # Joga os dados da variável em um arquivo de texto
echo $database > sql/mysql_database.txt


# Pergunta ao usuário o usuário mysql
echo "Por gentileza insira o usuário do MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read usermysql
# # Joga os dados da variável em um arquivo de texto
echo $usermysql > sql/mysql_user.txt


# Pergunta ao usuário a senha do mysql
echo "Por gentileza insira a senha do MYSQL: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read pwmysql
# # Joga os dados da variável em um arquivo de texto
echo $pwmysql > sql/mysql_password.txt


# Pergunta ao usuário o ip do servidor a ser monitorado
echo "Por gentileza insira o IP desta máquina que deverá ser monitorada: "
# Le o que foi digitado pelo usuário e atribui a uma variavel
read ip


# Cadastra o monitor no crontab
echo '* * * * * /home/cksrv/monitor/monitor_server.sh' >> /etc/crontab