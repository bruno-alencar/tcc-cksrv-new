<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Monitorar Servidores</h3>
	</div>
</div>

<div class="row lista-servidores">
	<?php
		foreach ($servidores as $s):
			echo '<div class="col-lg-4 lista-servidores">';
				echo '<div class="ibox float-e-margins borda-servidores">';
					echo '<div class="ibox-title">';

						$server_online = shell_exec('/Library/WebServer/Documents/cksrv/shell/ping.sh '.$s['Servidor']['ip']);
					
						$status_servidor = '#2eb82e'; // Verde
						if($server_online == 0)
							$status_servidor = '#cc0000'; // Vermelho

						echo '<h5 style="color:'.$status_servidor.'"><i class="fa fa-linux"></i> - '.$s['Servidor']['host'].' - '.$s['Servidor']['ip'].'</h5>';
						echo '<div class="ibox-tools">';
							echo '<a class="collapse-link">';
								echo '<i class="fa fa-chevron-up"></i>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
					echo '<div class="ibox-content">';
						
						echo '';

					echo '</div>';
				echo '</div>';
			echo '</div>';
		endforeach;
	?>	
</div>