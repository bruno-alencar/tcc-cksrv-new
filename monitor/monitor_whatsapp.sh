#!/bin/bash

# Pega caminho do monitor
CAMINHO_MONITOR=`pwd`

# # # Atribuir dados de conexão e acesso # # #
# usuario sql
SQL_U=`cat /var/www/cksrv-new/monitor/sql/mysql_user.txt` 
# senha sql
SQL_P=`cat /var/www/cksrv-new/monitor/sql/mysql_password.txt` 
# ip do servidor mysql
SQL_SERVER=`cat /var/www/cksrv-new/monitor/sql/mysql_server.txt`
# database
SQL_DATABASE=`cat /var/www/cksrv-new/monitor/sql/mysql_database.txt`



ip_servidor=`cat /home/bruno/lista.txt | awk '{print $2}'`
numero_telefone=`cat /home/bruno/lista.txt | awk '{print $4}'`


# Busca todos os servidores ativos no sistema.
serv=`mysql --login-path=cksrv -e "select id from servicos where ip='$ip_servidor'" --database $SQL_DATABASE |sed 1d`
# Transforma o resultado da busca em um array
arr=($serv)

# Executa um foreach de todos os servidores
for i in "${arr[@]}"; do 
	# Busca todos dados do serviço
	servico=`mysql --login-path=cksrv -e "select * from servicos where id=$i" --database $SQL_DATABASE |sed 1d`
	ID=`echo $servico | awk '{print $1}'`
	TIPO_SERVICO_ID=`echo $servico | awk '{print $2}'`
	
	PARTICAO=`echo $servico | awk '{print $7}'`
	RESULTADO=`echo $servico | awk '{print $8}'`
	STATUS_PING=`echo $servico | awk '{print $9}'`
	
	# tipo_servico=`mysql --login-path=cksrv -e "select servico from tipo_servicos where id=$TIPO_SERVICO_ID" --database $SQL_DATABASE |sed 1d`
	
	# MENSAGEM='Serviço: '$tipo_servico
	# echo $MENSAGEM


	if [ $TIPO_SERVICO_ID -eq 1 ]; then
		if [ $STATUS_PING -eq 1 ]; then
			MENSAGEM='Ping ok'
			echo $MENSAGEM
			/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send $numero_telefone "$MENSAGEM"
		else
			MENSAGEM='Sem comunicação'
			echo $MENSAGEM
			/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send $numero_telefone "$MENSAGEM"
		fi	
	fi

	if [ $TIPO_SERVICO_ID -eq 2 ]; then
		MENSAGEM='Load '$RESULTADO
		echo $MENSAGEM
		/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send $numero_telefone "$MENSAGEM"
	fi

	if [ $TIPO_SERVICO_ID -eq 3 ]; then
		MENSAGEM='Quant. de usuários conectados: '$RESULTADO
		echo $MENSAGEM
		/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send $numero_telefone "$MENSAGEM"
	fi

	if [ $TIPO_SERVICO_ID -eq 4 ]; then
		MENSAGEM='Quant. de Processos: '$RESULTADO
		echo $MENSAGEM
		/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send $numero_telefone "$MENSAGEM"
	fi

	if [ $TIPO_SERVICO_ID -eq 5 ]; then
		MENSAGEM='Quant. de Processos Zombies: '$RESULTADO
		echo $MENSAGEM
		/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send $numero_telefone "$MENSAGEM"
	fi

	if [ $TIPO_SERVICO_ID -eq 6 ]; then
		MENSAGEM='Particao: '$PARTICAO' - '$RESULTADO'GB'
		echo $MENSAGEM
		/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send $numero_telefone "$MENSAGEM"
	fi
done

echo ' ' > /home/bruno/lista.txt