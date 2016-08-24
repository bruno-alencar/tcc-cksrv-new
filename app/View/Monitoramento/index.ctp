<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Monitorar Servidores</h3>
	</div>
</div>

<div class="row lista-servidores">
	<?php
		foreach ($servicos as $s):
			echo '<div class="col-lg-3 lista-servidores">';
				echo '<div class="ibox float-e-margins borda-servidores">';
					echo '<div class="ibox-title">';
					
						$status_servidor = '#2eb82e'; // Verde
						if($s[1]['Servico']['status_servidor'] == 0)
							$status_servidor = '#cc0000'; // Vermelho

						echo '<h5 style="color:'.$status_servidor.'"><i class="fa fa-linux"></i> - '.$s[1]['Servico']['ip'].' - '.$servidor[$s[1]['Servico']['servidor_id']]['Servidor']['host'].'</h5>';
						echo '<div class="ibox-tools">';
							echo '<a class="collapse-link">';
								echo '<i class="fa fa-chevron-up"></i>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
					echo '<div class="ibox-content">';

					if($s[1]['Servico']['status_servidor'] == 1){
						if (!empty($s[2])) {
							foreach ($s[2] as $load) {
								if($load['Servico']['resultado'] < $load['Servico']['critical'])
									$status = '#2eb82e'; // Verde
								if($load['Servico']['resultado'] >= $load['Servico']['critical'] && $load['Servico']['resultado'] < $load['Servico']['warning'])
									$status = '#ff8000'; // Laranja
								if($load['Servico']['resultado'] > $load['Servico']['warning'])
									$status = '#cc0000'; // Vermelho

								echo '<p style="color:'.$status.'"> Load da máquina: '.$load['Servico']['resultado'].' - Ultima Verificação: '.dataBr($load['Servico']['modified']).'</p>';
							}
						}

						if (!empty($s[3])) {
							foreach ($s[3] as $user) {
								if($user['Servico']['resultado'] < $user['Servico']['critical'])
									$status = '#2eb82e'; // Verde
								if($user['Servico']['resultado'] >= $user['Servico']['critical'] && $user['Servico']['resultado'] < $user['Servico']['warning'])
									$status = '#ff8000'; // Laranja
								if($user['Servico']['resultado'] > $user['Servico']['warning'])
									$status = '#cc0000'; // Vermelho

								echo '<p style="color:'.$status.'"> Usuários Logados: '.$user['Servico']['resultado'].' - Ultima Verificação: </p>';
							}
						}

						if (!empty($s[4])) {
							foreach ($s[4] as $process) {
								if($process['Servico']['resultado'] < $process['Servico']['critical'])
									$status = '#2eb82e'; // Verde
								if($process['Servico']['resultado'] >= $process['Servico']['critical'] && $process['Servico']['resultado'] < $process['Servico']['warning'])
									$status = '#ff8000'; // Laranja
								if($process['Servico']['resultado'] > $process['Servico']['warning'])
									$status = '#cc0000'; // Vermelho

								echo '<p style="color:'.$status.'"> Qnt de Processos: '.$process['Servico']['resultado'].' - Ultima Verificação: </p>';
							}
						}

						if (!empty($s[5])) {
							foreach ($s[5] as $process_z) {
								if($process_z['Servico']['resultado'] < $process_z['Servico']['critical'])
									$status = '#2eb82e'; // Verde
								if($process_z['Servico']['resultado'] >= $process_z['Servico']['critical'] && $process_z['Servico']['resultado'] < $process_z['Servico']['warning'])
									$status = '#ff8000'; // Laranja
								if($process_z['Servico']['resultado'] > $process_z['Servico']['warning'])
									$status = '#cc0000'; // Vermelho

								echo '<p style="color:'.$status.'"> Processos Zombie: '.$process_z['Servico']['resultado'].' - Ultima Verificação: </p>';
							}
						}

						if (!empty($s[6])) {
							foreach ($s[6] as $disk) {
								if($disk['Servico']['resultado'] > $disk['Servico']['critical'])
									$status = '#2eb82e'; // Verde
								if($disk['Servico']['resultado'] <= $disk['Servico']['critical'] && $disk['Servico']['resultado'] > $disk['Servico']['warning'])
									$status = '#ff8000'; // Laranja
								if($disk['Servico']['resultado'] < $disk['Servico']['warning'])
									$status = '#cc0000'; // Vermelho

								echo '<p style="color:'.$status.'"> Espaço '.$disk['Servico']['particao'].': '.$disk['Servico']['resultado'].'% - Ultima Verificação: </p>';
							}
						}
					}else{
						echo '<p style="color:#cc0000"> Falha na comunicação com o servidor. <br> Ultima Verificação: '.$s[1]['Servico']['modified'].' </p>';
					}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		endforeach;
	?>	
</div>