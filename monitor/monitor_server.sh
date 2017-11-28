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


# Busca todos os servidores ativos no sistema.
serv=`mysql --login-path=cksrv -e "select ip from servidores where status_id=1" --database $SQL_DATABASE |sed 1d`
# Transforma o resultado da busca em um array
arr=($serv)

# Executa um foreach de todos os servidores
for i in "${arr[@]}"; do 

	# Busca na base todos os serviços que devem ser monitorados pelo sistema do servidor em questão
	ids=`mysql --login-path=cksrv -e "select id from servicos where ip rlike '$i'" --database $SQL_DATABASE |sed 1d`
	# Transforma o resultado da busca em um array
	arr=($ids)

	# Executa um foreach de todos os serviços relacionados ao servidor
	for n in "${arr[@]}"; do 
		# Busca os dados do servico individualmente
		servico=`mysql --login-path=cksrv -e "select * from servicos where id = $n" --database $SQL_DATABASE |sed 1d`
		# Filtra o id para facil manuseio
		ID=`echo $servico |cut -d' ' -f1`
		# Filtra o Tipo do serviço para facil manuseio
		TIPO_SERVICO=`echo $servico |cut -d' ' -f2`
		# Filtra o campo Warning para facil manuseio
		WARNING=`echo $servico |cut -d' ' -f6`
		# Filtra o campo Resultado para facil manuseio
		RESULTADO=`echo $servico |cut -d' ' -f8`

		CRITICAL=`echo $servico |cut -d' ' -f5`

		# # # Caso o tipo do serviço for PING # # #
		if [ $TIPO_SERVICO -eq 1 ]; then


			MODIFIED=`date +"%y-%m-%d %H:%M:%S"`

			# Teste inicial: ping no servidor
			ping -c 1 -W 1 $i >> /dev/null

			# Testa se o comando foi executado com sucesso
			if [ $? -eq 0 ]; then
				# Sucesso, da um insert na base com os dados de sucesso
				mysql --login-path=cksrv -e "UPDATE servicos SET status_servidor=1, modified='$MODIFIED' where id=$ID;" --database $SQL_DATABASE
			# Caso não tenha sido executado com sucesso
			else
				# Falha, da um insert na base com os dados de falha na comunicação
				mysql --login-path=cksrv -e "UPDATE servicos SET status_servidor=0, modified='$MODIFIED' where id=$ID;" --database $SQL_DATABASE

				# # # Envia alerta para todos os usuários # # #
				# Busca na base uma lista de usuários ativos
				usuarios=`mysql --login-path=cksrv -e "select id from usuarios where status_id=1" --database $SQL_DATABASE |sed 1d`
				# Transforma o resultado da busca em um array
				arr=($usuarios)
				for u in "${arr[@]}"; do 
					# Busca os dados do usuário um a um
					usuario=`mysql --login-path=cksrv -e "select email,ddd,celular from usuarios where id=$u" --database $SQL_DATABASE |sed 1d`
					# Filtra o id para facil manuseio
					EMAIL=`echo $usuario |cut -d' ' -f1`
					# Filtra o Tipo do serviço para facil manuseio
					DDD=`echo $usuario |cut -d' ' -f2`
					# Filtra o campo Warning para facil manuseio
					CELULAR=`echo $usuario |cut -d' ' -f3`

					/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send  55$DDD$CELULAR "Sem comunicação com o servidor $i"
				done
				sleep 5
				sudo php /var/www/cksrv-new/monitor/envio.php $n
			fi
		fi

		# # # Caso o tipo do serviço for LOAD # # #
		if [ $TIPO_SERVICO -eq 2 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO -ge $WARNING ]; then
				### Envia alerta para todos os usuários###
				# Busca na base uma lista de usuários ativos
				usuarios=`mysql --login-path=cksrv -e "select id from usuarios where status_id=1" --database $SQL_DATABASE |sed 1d`
				# Transforma o resultado da busca em um array
				arr=($usuarios)
				for u in "${arr[@]}"; do 
					# Busca os dados do usuário um a um
					usuario=`mysql --login-path=cksrv -e "select email,ddd,celular from usuarios where id=$u" --database $SQL_DATABASE |sed 1d`
					# Filtra o id para facil manuseio
					EMAIL=`echo $usuario |cut -d' ' -f1`
					# Filtra o Tipo do serviço para facil manuseio
					DDD=`echo $usuario |cut -d' ' -f2`
					# Filtra o campo Warning para facil manuseio
					CELULAR=`echo $usuario |cut -d' ' -f3`

					/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send  55$DDD$CELULAR "Cksrv Alerta - Load da máquina - $i Load da máquina $i está acima do esperado."

				done
				php /var/www/cksrv-new/monitor/envio.php $n
				mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=1,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
			fi

			if [ $RESULTADO -ge $CRITICAL ]; then
				if [ $RESULTADO -lt $WARNING ]; then
					mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=0,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
				fi
			fi
		fi

		# # # Caso o tipo do serviço for usuários conectados # # #
		if [ $TIPO_SERVICO -eq 3 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO -ge $WARNING ]; then
				### Envia alerta para todos os usuários###
				# Busca na base uma lista de usuários ativos
				usuarios=`mysql --login-path=cksrv -e "select id from usuarios where status_id=1" --database $SQL_DATABASE |sed 1d`
				# Transforma o resultado da busca em um array
				arr=($usuarios)
				for u in "${arr[@]}"; do 
					# Busca os dados do usuário um a um
					usuario=`mysql --login-path=cksrv -e "select email,ddd,celular from usuarios where id=$u" --database $SQL_DATABASE |sed 1d`
					# Filtra o id para facil manuseio
					EMAIL=`echo $usuario |cut -d' ' -f1`
					# Filtra o Tipo do serviço para facil manuseio
					DDD=`echo $usuario |cut -d' ' -f2`
					# Filtra o campo Warning para facil manuseio
					CELULAR=`echo $usuario |cut -d' ' -f3`

					/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send  55$DDD$CELULAR "Cksrv Alerta - Quantidade de usuários - $i Quantidade de usuários na máquina $i está acima do esperado."
				done
				php /var/www/cksrv-new/monitor/envio.php $n
				mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=1,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
			fi

			if [ $RESULTADO -ge $CRITICAL ]; then
				if [ $RESULTADO -lt $WARNING ]; then
					mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=0,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
				fi
			fi
		fi

		# # # Caso o tipo do serviço for quantidade de processos # # #
		if [ $TIPO_SERVICO -eq 4 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO -ge $WARNING ]; then
				### Envia alerta para todos os usuários###
				# Busca na base uma lista de usuários ativos
				usuarios=`mysql --login-path=cksrv -e "select id from usuarios where status_id=1" --database $SQL_DATABASE |sed 1d`
				# Transforma o resultado da busca em um array
				arr=($usuarios)
				for u in "${arr[@]}"; do 
					# Busca os dados do usuário um a um
					usuario=`mysql --login-path=cksrv -e "select email,ddd,celular from usuarios where id=$u" --database $SQL_DATABASE |sed 1d`
					# Filtra o id para facil manuseio
					EMAIL=`echo $usuario |cut -d' ' -f1`
					# Filtra o Tipo do serviço para facil manuseio
					DDD=`echo $usuario |cut -d' ' -f2`
					# Filtra o campo Warning para facil manuseio
					CELULAR=`echo $usuario |cut -d' ' -f3`

					/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send  55$DDD$CELULAR "Cksrv Alerta - Quantidade de processos - $i Quantidade de processos da máquina $i está acima do esperado."
					
				done
				php /var/www/cksrv-new/monitor/envio.php $n
				mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=1,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
			fi
			if [ $RESULTADO -ge $CRITICAL ]; then
				if [ $RESULTADO -lt $WARNING ]; then
					mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=0,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
				fi
			fi
		fi

		# # # Caso o tipo do serviço for quantidade de processos zombies # # #
		if [ $TIPO_SERVICO -eq 5 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO -ge $WARNING ]; then
				### Envia alerta para todos os usuários###
				# Busca na base uma lista de usuários ativos
				usuarios=`mysql --login-path=cksrv -e "select id from usuarios where status_id=1" --database $SQL_DATABASE |sed 1d`
				# Transforma o resultado da busca em um array
				arr=($usuarios)
				for u in "${arr[@]}"; do 
					# Busca os dados do usuário um a um
					usuario=`mysql --login-path=cksrv -e "select email,ddd,celular from usuarios where id=$u" --database $SQL_DATABASE |sed 1d`
					# Filtra o id para facil manuseio
					EMAIL=`echo $usuario |cut -d' ' -f1`
					# Filtra o Tipo do serviço para facil manuseio
					DDD=`echo $usuario |cut -d' ' -f2`
					# Filtra o campo Warning para facil manuseio
					CELULAR=`echo $usuario |cut -d' ' -f3`

					/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send  55$DDD$CELULAR "Cksrv Alerta - Quantidade de processos Zombie - $i Quantidade de processos Zombie da máquina $i está acima do esperado."
				done
				php /var/www/cksrv-new/monitor/envio.php $n
				mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=1,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
			fi
			if [ $RESULTADO -ge $CRITICAL ]; then
				if [ $RESULTADO -lt $WARNING ]; then
					mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=0,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
				fi
			fi
		fi

		# # # Caso o tipo do serviço for espaço em disco # # #
		if [ $TIPO_SERVICO -eq 6 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO -le $WARNING ]; then
				### Envia alerta para todos os usuários###
				# Busca na base uma lista de usuários ativos
				usuarios=`mysql --login-path=cksrv -e "select id from usuarios where status_id=1" --database $SQL_DATABASE |sed 1d`
				# Transforma o resultado da busca em um array
				arr=($usuarios)
				for u in "${arr[@]}"; do 
					# Busca os dados do usuário um a um
					usuario=`mysql --login-path=cksrv -e "select email,ddd,celular from usuarios where id=$u" --database $SQL_DATABASE |sed 1d`
					# Filtra o id para facil manuseio
					EMAIL=`echo $usuario |cut -d' ' -f1`
					# Filtra o Tipo do serviço para facil manuseio
					DDD=`echo $usuario |cut -d' ' -f2`
					# Filtra o campo Warning para facil manuseio
					CELULAR=`echo $usuario |cut -d' ' -f3`

					/var/www/yowsup-master/yowsup-cli demos --config /var/www/yowsup-master/config --send  55$DDD$CELULAR "Cksrv Alerta - Espaço em disco insuficiente - $i O Espaço disponível na partição $PARTICAO do servidor $i está abaixo do esperado."
				done
				php /var/www/cksrv-new/monitor/envio.php $n
				mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=1,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
			fi
			if [ $RESULTADO -ge $CRITICAL ]; then
				if [ $RESULTADO -lt $WARNING ]; then
					mysql --login-path=cksrv -e "INSERT INTO  log_servicos SET servico_id=$TIPO_SERVICO,resultado=$RESULTADO,flg_critical=1,flg_warning=0,ip='$i',modified='$MODIFIED';" --database $SQL_DATABASE
				fi
			fi
		fi
	done
done
