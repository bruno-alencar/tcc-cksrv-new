#!/bin/bash

# Pega caminho do monitor
CAMINHO_MONITOR=`pwd`

SERVIDOR_ID=`cat $CAMINHO_MONITOR/id.txt`
# usuario sql
SQL_U=`cat $CAMINHO_MONITOR/sql/mysql_user.txt`
# senha sql
SQL_P=`cat $CAMINHO_MONITOR/sql/mysql_password.txt`
# ip do servidor mysql
SQL_SERVER=`cat $CAMINHO_MONITOR/sql/mysql_server.txt`
# database
SQL_DATABASE=`cat $CAMINHO_MONITOR/sql/mysql_database.txt`


# Busca todos os servidores ativos no sistema.
serv=`mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "select id from servicos where status_id=1 AND servidor_id=$SERVIDOR_ID" --database $SQL_DATABASE |sed 1d`
# Transforma o resultado da busca em um array
arr=($serv)

MODIFIED=`date +"%y-%m-%d %H:%M:%S"`

# Executa um foreach de todos os servidores
for i in "${arr[@]}"; do 
	# Busca os dados do servico individualmente
	servico=`mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "select * from servicos where id = $i" --database $SQL_DATABASE |sed 1d`
	# Filtra o id para facil manuseio
	ID=`echo $servico |cut -d' ' -f1`
	# Filtra o Tipo do serviço para facil manuseio
	TIPO_SERVICO=`echo $servico |cut -d' ' -f2`
	# Filtra o Tipo do serviço para facil manuseio
	PARTICAO=`echo $servico |cut -d' ' -f7`

	# # # Caso o tipo do serviço for LOAD # # #
	if [ $TIPO_SERVICO -eq 2 ]; then
		LOAD=`uptime | awk '{print $9}' |cut -d',' -f1`
		# Da um insert na base com os dados
		mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "UPDATE servicos SET resultado=$LOAD, modified='$MODIFIED' where id=$ID;" --database $SQL_DATABASE
	fi

	# # # Caso o tipo do serviço for usuários conectados # # #
	if [ $TIPO_SERVICO -eq 3 ]; then
		USER=`w |grep user |cut -d' ' -f7`
		# Da um insert na base com os dados
		mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "UPDATE servicos SET resultado=$USER, modified='$MODIFIED' where id=$ID;" --database $SQL_DATABASE
	fi

	# # # Caso o tipo do serviço for quantidade de processos # # #
	if [ $TIPO_SERVICO -eq 4 ]; then
		PROCESS=`ps -ef |wc -l`
		# Da um insert na base com os dados
		mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "UPDATE servicos SET resultado=$PROCESS, modified='$MODIFIED' where id=$ID;" --database $SQL_DATABASE
	fi

	# # # Caso o tipo do serviço for quantidade de processos zombies # # #
	if [ $TIPO_SERVICO -eq 5 ]; then
		PROCESS_Z=`ps -ef |grep Z |wc -l`
		# Da um insert na base com os dados
		mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "UPDATE servicos SET resultado=$PROCESS_Z, modified='$MODIFIED' where id=$ID;" --database $SQL_DATABASE
	fi

	# # # Caso o tipo do serviço for espaço em disco # # #
	if [ $TIPO_SERVICO -eq 6 ]; then

		DISK=`df |grep $PARTICAO | awk '{print $3}'`
		MAX_SIZE=`df |grep $PARTICAO | awk '{print $2}'`

		X=$(($DISK * 100))
		Y=$(($X / $MAX_SIZE))
		# Da um insert na base com os dados
		mysql -h $SQL_SERVER -u $SQL_U -p$SQL_P -e "UPDATE servicos SET resultado=$Y, modified='$MODIFIED' where id=$ID;" --database $SQL_DATABASE
	fi
done
