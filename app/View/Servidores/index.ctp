<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Gerenciar Servidores</h3>
	</div>
</div>

<?php echo $this->Session->flash(); ?>
<?php echo $this->Html->css('usuarios/highlight.css') ?>
<?php echo $this->Html->css('usuarios/bootstrap-switch.min.css') ?>
<link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
<?php echo $this->Html->css('usuarios/main.css') ?>
<?php echo $this->Html->script('usuarios/bootstrap-switch.min.js') ?>

<script>
    $(function(argument) {
      $('[type="checkbox"]').bootstrapSwitch();
    })
</script>

<br>
<?php echo $this->Html->link("Novo Servidor", array('controller' => 'servidores' ,'action' => 'adicionar'), array('class' => 'btn btn-green-default', 'style' => 'margin-left:20px;')) ?>
<br><br>
<div class="white-bg">
	<table class="table table-striped table-hover">
		<tr>
			<th>#</th>
			<th>Host</th>
			<th>IP</th>
			<th>Sistema Operacional</th>
			<th>Status Monitoramento</th>
		</tr>

		

		<?php
		foreach ($servidores as $s) {
			echo '<tr data-href="'.$this->Html->url(array('controller' => 'servidores', 'action' => 'editar', $s['Servidor']['id'])).'">';
				echo '<td>'.$s['Servidor']['id'].'</td>';
				echo '<td>'.$s['Servidor']['host'].'</td>';
				echo '<td>'.$s['Servidor']['ip'].'</td>';
				echo '<td>'.$s['Servidor']['detalhes_so'].'</td>';
				$checked = $s['Servidor']['status_id'] == 1 ? 'checked' : '';
				echo '<td><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-switch-size bootstrap-switch-animate bootstrap-switch-off"><input class="form-control" onchange="altera_status_servidor_ativo_inativo('.$s['Servidor']['id'].')" type="checkbox" '.$checked.'></div></td>';
			echo '</tr>';
		}
		?>
	</table>
</div>