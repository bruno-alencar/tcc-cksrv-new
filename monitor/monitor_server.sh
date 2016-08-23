#!/bin/bash

# Busca todos os servidores ativos no sistema.
serv=`mysql -h localhost -u root -p4334N@k0N -e "select ip from servidores where status_id=1" --database cksrv |sed 1d`
# Transforma o resultado da busca em um array
arr=($serv)

# Executa um foreach de todos os servidores
for i in "${arr[@]}"; do 

	# Busca na base todos os serviços que devem ser monitorados pelo sistema do servidor em questão
	ids=`mysql -h localhost -u root -p4334N@k0N -e "select id from servicos where ip rlike '$i'" --database cksrv |sed 1d`
	# Transforma o resultado da busca em um array
	arr=($ids)

	# Executa um foreach de todos os serviços relacionados ao servidor
	for n in "${arr[@]}"; do 
		# Busca os dados do servico individualmente
		servico=`mysql -h localhost -u root -p4334N@k0N -e "select * from servicos where id = $n" --database cksrv |sed 1d`
		# Filtra o id para facil manuseio
		ID=`echo $servico |cut -d' ' -f1`
		# Filtra o Tipo do serviço para facil manuseio
		TIPO_SERVICO=`echo $servico |cut -d' ' -f2`
		# Filtra o campo Resultado para facil manuseio
		RESULTADO=`echo $log_servico |cut -d' ' -f3`
		# Filtra o campo Warning para facil manuseio
		WARNING=`echo $servico |cut -d' ' -f6`

		# # # Caso o tipo do serviço for PING # # #
		if [ $TIPO_SERVICO -eq 1 ]; then
			# Teste inicial: ping no servidor
			ping -c 1 -W 0.1 $i >> /dev/null
			# Testa se o comando foi executado com sucesso
			if [ $? -eq 0 ]; then
				# Sucesso, da um insert na base com os dados de sucesso
				mysql -h localhost -u root -p4334N@k0N -e "UPDATE servicos SET status_servidor=1 where id=$ID;" --database cksrv
			# Caso não tenha sido executado com sucesso
			else
				# Falha, da um insert na base com os dados de falha na comunicação
				mysql -h localhost -u root -p4334N@k0N -e "UPDATE servicos SET status_servidor=0 where id=$ID;" --database cksrv
				# Envia alerta para todos os usuários
				echo 'ALERTA'
			fi
		fi

		# # # Caso o tipo do serviço for LOAD # # #
		if [ $TIPO_SERVICO -eq 2 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO > $WARNING ]; then
				# Caso não, envia alerta
				echo 'ALERTA'
			fi
		fi

		# # # Caso o tipo do serviço for usuários conectados # # #
		if [ $TIPO_SERVICO -eq 3 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO > $WARNING ]; then
				# Caso não, envia alerta
				echo 'ALERTA'
			fi
		fi

		# # # Caso o tipo do serviço for quantidade de processos # # #
		if [ $TIPO_SERVICO -eq 4 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO > $WARNING ]; then
				# Caso não, envia alerta
				echo 'ALERTA'
			fi
		fi

		# # # Caso o tipo do serviço for quantidade de processos zombies # # #
		if [ $TIPO_SERVICO -eq 5 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO > $WARNING ]; then
				# Caso não, envia alerta
				echo 'ALERTA'
			fi
		fi

		# # # Caso o tipo do serviço for espaço em disco # # #
		if [ $TIPO_SERVICO -eq 6 ]; then
			# Verifica se o resultado esta dentro do esperado
			if [ $RESULTADO > $WARNING ]; then
				# Caso não, envia alerta
				echo 'ALERTA'
			fi
		fi
	done
done