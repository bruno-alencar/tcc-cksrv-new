#!/bin/bash

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

# Da um find no id do servidor cadastrado em base
serv_id=`mysql -h $ipserver -u $usermysql -p$pwmysql -e "select id from servidores where status_id=1 AND ip rlike '$ip'" --database $database |sed 1d`

# Joga os dados da variavel em um arquivo
echo $serv_id > id.txt

# Cadastra o monitor no crontab
echo '* * * * * /home/cksrv/monitor/monitor_client.sh' >> /etc/crontab