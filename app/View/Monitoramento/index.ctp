<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Monitorar Servidores</h3>
	</div>
</div>

<div class="row lista-servidores">
	<?php
		foreach ($servicos as $s):
			echo '<div class="col-lg-4 lista-servidores">';
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

								echo '<div class="col-sm-12" style="color:'.$status.'">';
									echo '<div class="col-sm-5">';
										echo '<p><i class="fa fa-spinner" style="margin-right:10px;"></i> Load da máquina: '.$load['Servico']['resultado'].'</p>';
									echo '</div>';
									echo '<div class="col-sm-7">';
										echo '<p>Ultima Verificação: '.dataBr($load['Servico']['modified']).'</p>';
									echo '</div>';
								echo '</div>';
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

								echo '<div class="col-sm-12" style="color:'.$status.'">';
									echo '<div class="col-sm-5">';
										echo '<p><i class="fa fa-user-times" style="margin-right:10px;"></i> Usuários Logados: '.$user['Servico']['resultado'].'</p>';
									echo '</div>';
									echo '<div class="col-sm-7">';
										echo '<p>Ultima Verificação: '.dataBr($user['Servico']['modified']).'</p>';
									echo '</div>';
								echo '</div>';
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

								echo '<div class="col-sm-12" style="color:'.$status.'">';
									echo '<div class="col-sm-5">';
										echo '<p><i class="fa fa-tasks" style="margin-right:10px;"></i> Qnt de Processos: '.$process['Servico']['resultado'].'</p>';
									echo '</div>';
									echo '<div class="col-sm-7">';
										echo '<p>Ultima Verificação: '.dataBr($process['Servico']['modified']).'</p>';
									echo '</div>';
								echo '</div>';
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

								echo '<div class="col-sm-12" style="color:'.$status.'">';
									echo '<div class="col-sm-5">';
										echo '<p><i class="fa" style="margin-right:15px;"><b>Z</b></i> Processos Zombie: '.$process_z['Servico']['resultado'].'</p>';
									echo '</div>';
									echo '<div class="col-sm-7">';
										echo '<p>Ultima Verificação: '.dataBr($process_z['Servico']['modified']).'</p>';
									echo '</div>';
								echo '</div>';
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

								echo '<div class="col-sm-12" style="color:'.$status.'">';
									echo '<div class="col-sm-5">';
										echo '<p><i class="fa fa-line-chart" style="margin-right:10px;"></i> Espaço '.$disk['Servico']['particao'].': '.$disk['Servico']['resultado'].'%</p>';
									echo '</div>';
									echo '<div class="col-sm-7">';
										echo '<p>Ultima Verificação: '.dataBr($disk['Servico']['modified']).'</p>';
									echo '</div>';
								echo '</div>';
							}
						}
					}else{
						echo '<p style="color:#cc0000"> Falha na comunicação com o servidor. <br> Ultima Verificação: '.$s[1]['Servico']['modified'].' </p>';
					}
					echo '<div class="clearfix"></div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		endforeach;
	?>	
</div>