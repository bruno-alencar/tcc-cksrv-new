<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Monitorar Servidores</h3>
	</div>
</div>

<div class="row lista-servidores">
	<?php
		foreach ($servicos as $s):
			if($servidor[$s[1]['servidor_id']]['Servidor']['status_id'] == 1):
				echo '<div class="col-lg-4 lista-servidores">';
					echo '<div class="ibox float-e-margins borda-servidores">';
						echo '<div class="ibox-title">';
						
							$status_servidor = '#2eb82e'; // Verde
							if($s[1]['status_servidor'] == 0)
								$status_servidor = '#cc0000'; // Vermelho

							echo '<h5 style="color:'.$status_servidor.'"><i class="fa fa-linux"></i> - '.$s[1]['ip'].' - '.$servidor[$s[1]['servidor_id']]['Servidor']['host'].'</h5>';
							echo '<div class="ibox-tools">';
								echo '<a class="collapse-link">';
									echo '<i class="fa fa-chevron-up"></i>';
								echo '</a>';
							echo '</div>';
						echo '</div>';
						echo '<div class="ibox-content">';

						if($s[1]['status_servidor'] == 1){
							if (!empty($s[2])) {
								foreach ($s[2] as $load) {
									if($load['resultado'] < $load['critical'])
										$status = '#2eb82e'; // Verde
									if($load['resultado'] >= $load['critical'] && $load['resultado'] < $load['warning'])
										$status = '#ff8000'; // Laranja
									if($load['resultado'] >= $load['warning'])
										$status = '#cc0000'; // Vermelho

									echo '<div class="col-sm-12" style="color:'.$status.'">';
										echo '<div class="col-sm-5">';
											echo '<p><i class="fa fa-spinner" style="margin-right:10px;"></i> Load da máquina: '.$load['resultado'].'</p>';
										echo '</div>';
										echo '<div class="col-sm-7">';
											echo '<p>Ultima Verificação: '.dataBr($load['modified']).'</p>';
										echo '</div>';
									echo '</div>';
								}
							}

							if (!empty($s[3])) {
								foreach ($s[3] as $user) {
									if($user['resultado'] < $user['critical'])
										$status = '#2eb82e'; // Verde
									if($user['resultado'] >= $user['critical'] && $user['resultado'] < $user['warning'])
										$status = '#ff8000'; // Laranja
									if($user['resultado'] >= $user['warning'])
										$status = '#cc0000'; // Vermelho

									echo '<div class="col-sm-12" style="color:'.$status.'">';
										echo '<div class="col-sm-5">';
											echo '<p><i class="fa fa-user-times" style="margin-right:10px;"></i> Usuários Logados: '.$user['resultado'].'</p>';
										echo '</div>';
										echo '<div class="col-sm-7">';
											echo '<p>Ultima Verificação: '.dataBr($user['modified']).'</p>';
										echo '</div>';
									echo '</div>';
								}
							}

							if (!empty($s[4])) {
								foreach ($s[4] as $process) {
									if($process['resultado'] < $process['critical'])
										$status = '#2eb82e'; // Verde
									if($process['resultado'] >= $process['critical'] && $process['resultado'] < $process['warning'])
										$status = '#ff8000'; // Laranja
									if($process['resultado'] >= $process['warning'])
										$status = '#cc0000'; // Vermelho

									echo '<div class="col-sm-12" style="color:'.$status.'">';
										echo '<div class="col-sm-5">';
											echo '<p><i class="fa fa-tasks" style="margin-right:10px;"></i> Qnt de Processos: '.$process['resultado'].'</p>';
										echo '</div>';
										echo '<div class="col-sm-7">';
											echo '<p>Ultima Verificação: '.dataBr($process['modified']).'</p>';
										echo '</div>';
									echo '</div>';
								}
							}

							if (!empty($s[5])) {
								foreach ($s[5] as $process_z) {
									if($process_z['resultado'] < $process_z['critical'])
										$status = '#2eb82e'; // Verde
									if($process_z['resultado'] >= $process_z['critical'] && $process_z['resultado'] < $process_z['warning'])
										$status = '#ff8000'; // Laranja
									if($process_z['resultado'] >= $process_z['warning'])
										$status = '#cc0000'; // Vermelho

									echo '<div class="col-sm-12" style="color:'.$status.'">';
										echo '<div class="col-sm-5">';
											echo '<p><i class="fa" style="margin-right:15px;"><b>Z</b></i> Processos Zombie: '.$process_z['resultado'].'</p>';
										echo '</div>';
										echo '<div class="col-sm-7">';
											echo '<p>Ultima Verificação: '.dataBr($process_z['modified']).'</p>';
										echo '</div>';
									echo '</div>';
								}
							}

							if (!empty($s[6])) {
								foreach ($s[6] as $disk) {
									if($disk['resultado'] > $disk['critical'])
										$status = '#2eb82e'; // Verde
									if($disk['resultado'] <= $disk['critical'] && $disk['resultado'] > $disk['warning'])
										$status = '#ff8000'; // Laranja
									if($disk['resultado'] <= $disk['warning'])
										$status = '#cc0000'; // Vermelho

									echo '<div class="col-sm-12" style="color:'.$status.'">';
										echo '<div class="col-sm-5">';
											echo '<p><i class="fa fa-line-chart" style="margin-right:10px;"></i> Espaço '.$disk['particao'].': '.$disk['resultado'].'%</p>';
										echo '</div>';
										echo '<div class="col-sm-7">';
											echo '<p>Ultima Verificação: '.dataBr($disk['modified']).'</p>';
										echo '</div>';
									echo '</div>';
								}
							}
						}else{
							echo '<p style="color:#cc0000"> Falha na comunicação com o servidor. <br> Ultima Verificação: '.$s[1]['modified'].' </p>';
						}
						echo '<div class="clearfix"></div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			endif;
		endforeach;
	?>	
</div>