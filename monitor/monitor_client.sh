#!/bin/bash

SERVIDOR_ID=`cat id.txt`


# Busca todos os servidores ativos no sistema.
serv=`mysql -h localhost -u root -p4334N@k0N -e "select id from servicos where status_id=1 AND servidor_id=$SERVIDOR_ID" --database cksrv |sed 1d`

# Transforma o resultado da busca em um array
arr=($serv)

# Executa um foreach de todos os servidores
for i in "${arr[@]}"; do 
	# Busca os dados do servico individualmente
	servico=`mysql -h localhost -u root -p4334N@k0N -e "select * from servicos where id = $i" --database cksrv |sed 1d`
	# Filtra o id para facil manuseio
	ID=`echo $servico |cut -d' ' -f1`
	# Filtra o Tipo do serviço para facil manuseio
	TIPO_SERVICO=`echo $servico |cut -d' ' -f2`
	# Filtra o Tipo do serviço para facil manuseio
	PARTICAO=`echo $servico |cut -d' ' -f7`
	# Filtra o campo Resultado para facil manuseio
	echo $TIPO_SERVICO

	# # # Caso o tipo do serviço for LOAD # # #
	if [ $TIPO_SERVICO -eq 2 ]; then
		LOAD=`uptime | awk '{print $11}' |cut -d',' -f1`
		# Da um insert na base com os dados
		mysql -h localhost -u root -p4334N@k0N -e "UPDATE servicos SET resultado=$LOAD where id=$ID;" --database cksrv
	fi

	# # # Caso o tipo do serviço for usuários conectados # # #
	if [ $TIPO_SERVICO -eq 3 ]; then
		USER=`w |grep user |cut -d' ' -f8`
		# Da um insert na base com os dados
		mysql -h localhost -u root -p4334N@k0N -e "UPDATE servicos SET resultado=$USER where id=$ID;" --database cksrv
	fi

	# # # Caso o tipo do serviço for quantidade de processos # # #
	if [ $TIPO_SERVICO -eq 4 ]; then
		PROCESS=`ps -ef |wc -l`
		# Da um insert na base com os dados
		mysql -h localhost -u root -p4334N@k0N -e "UPDATE servicos SET resultado=$PROCESS where id=$ID;" --database cksrv
	fi

	# # # Caso o tipo do serviço for quantidade de processos zombies # # #
	if [ $TIPO_SERVICO -eq 5 ]; then
		PROCESS_Z=`ps -ef |grep Z |wc -l`
		# Da um insert na base com os dados
		mysql -h localhost -u root -p4334N@k0N -e "UPDATE servicos SET resultado=$PROCESS_Z where id=$ID;" --database cksrv
	fi

	# # # Caso o tipo do serviço for espaço em disco # # #
	if [ $TIPO_SERVICO -eq 6 ]; then

		DISK=`df |grep $PARTICAO | awk '{print $3}'`
		MAX_SIZE=`df |grep $PARTICAO | awk '{print $2}'`

		X=$(($DISK * 100))
		Y=$(($X / $MAX_SIZE))
		# Da um insert na base com os dados
		mysql -h localhost -u root -p4334N@k0N -e "UPDATE servicos SET resultado=$Y where id=$ID;" --database cksrv
	fi
done