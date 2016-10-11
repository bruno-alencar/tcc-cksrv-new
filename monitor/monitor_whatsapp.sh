#!/bin/bash

# Pega caminho do monitor
CAMINHO_MONITOR=`pwd`

# # # Atribuir dados de conexão e acesso # # #
# ip do servidor smtp
SMTP_SERVER=`cat $CAMINHO_MONITOR/smtp_server.txt`
# usuario sql
SQL_U=`cat $CAMINHO_MONITOR/sql/mysql_user.txt` 
# senha sql
SQL_P=`cat $CAMINHO_MONITOR/sql/mysql_password.txt` 
# ip do servidor mysql
SQL_SERVER=`cat $CAMINHO_MONITOR/sql/mysql_server.txt`
# database
SQL_DATABASE=`cat $CAMINHO_MONITOR/sql/mysql_database.txt`



# ip_servidor=`cat mensagem_usuario.txt | awk '{print $1}'`
# numero_telefone=`cat mensagem_usuario.txt | awk '{print $2}'`
ip_servidor="127.0.0.1"


# Busca todos os servidores ativos no sistema.
serv=`mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "select id from servicos where ip='127.0.0.1'" --database $SQL_DATABASE |sed 1d`
# Transforma o resultado da busca em um array
arr=($serv)


serv_id=`mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "select servidor_id from servicos where ip='127.0.0.1'" --database $SQL_DATABASE |sed 1d`
SERVIDOR_ID=`echo $serv_id | awk '{print $3}'`
servidor=`mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "select * from servidores where id=$SERVIDOR_ID" --database $SQL_DATABASE |sed 1d`
HOST=`echo $servidor | awk '{print $2}'`
IP=`echo $servidor | awk '{print $3}'`
STATUS_SERVIDOR=`echo $servidor | awk '{print $8}'`

MENSAGEM='Servidor '$HOST' - '$IP
echo $MENSAGEM
# ENVIAR MENSAGEM

# Executa um foreach de todos os servidores
for i in "${arr[@]}"; do 
	# Busca todos dados do serviço
	servico=`mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "select * from servicos where id=$i" --database $SQL_DATABASE |sed 1d`
	ID=`echo $servico | awk '{print $1}'`
	TIPO_SERVICO_ID=`echo $servico | awk '{print $2}'`
	
	PARTICAO=`echo $servico | awk '{print $7}'`
	RESULTADO=`echo $servico | awk '{print $8}'`
	STATUS_PING=`echo $servico | awk '{print $9}'`
	
	# tipo_servico=`mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "select servico from tipo_servicos where id=$TIPO_SERVICO_ID" --database $SQL_DATABASE |sed 1d`
	
	# MENSAGEM='Serviço: '$tipo_servico
	# echo $MENSAGEM

	if [ $TIPO_SERVICO_ID -eq 1 ]; then
		if [ $STATUS_PING -eq 1 ]; then
			MENSAGEM='Ping ok'
			echo $MENSAGEM
		else
			MENSAGEM='Sem comunicação'
			echo $MENSAGEM
		fi	
	fi

	if [ $TIPO_SERVICO_ID -eq 2 ]; then
		MENSAGEM='Load '$RESULTADO
		echo $MENSAGEM
	fi

	if [ $TIPO_SERVICO_ID -eq 3 ]; then
		MENSAGEM='Quant. de usuários conectados: '$RESULTADO
		echo $MENSAGEM
	fi

	if [ $TIPO_SERVICO_ID -eq 4 ]; then
		MENSAGEM='Quant. de Processos: '$RESULTADO
		echo $MENSAGEM
	fi

	if [ $TIPO_SERVICO_ID -eq 5 ]; then
		MENSAGEM='Quant. de Processos Zombies: '$RESULTADO
		echo $MENSAGEM
	fi

	if [ $TIPO_SERVICO_ID -eq 6 ]; then
		MENSAGEM='Particao: '$PARTICAO' - '$RESULTADO'MB'
		echo $MENSAGEM
	fi
done