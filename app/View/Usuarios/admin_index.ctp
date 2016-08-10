<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Gerenciar Usuários</h3>
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
<?= $this->Html->link("Novo usuário", array('admin' => true, 'controller' => 'usuarios' ,'action' => 'add'), array('class' => 'btn btn-green-default', 'style' => 'margin-left:20px;')) ?><br>
<br>

<div class="crud-fundo-branco">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Login</th>
			<th>Perfil</th>
			<th>Celular</th>
			<th></th>
		</tr>
		<?php
		foreach ($usuarios as $u) {
			echo '<tr data-href="'.$this->Html->url(array('admin' => true, 'controller' => 'usuarios' ,'action' => 'edit', $u['Usuario']['id'])).'">';
				echo '<td>'.$u['Usuario']['nome'].'</td>';
				echo '<td>'.$u['Usuario']['email'].'</td>';
				echo '<td>'.$u['Usuario']['login'].'</td>';
				echo '<td>'.$u['Perfil']['descricao'].'</td>';
				echo '<td>('.$u['Usuario']['ddd'].') '.$u['Usuario']['celular'].'</td>';
				$checked = $u['Usuario']['status_id'] == 1 ? 'checked' : '';
				echo '<td><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-switch-size bootstrap-switch-animate bootstrap-switch-off"><input class="form-control" onchange="altera_status_usuario_ativo_inativo('.$u['Usuario']['id'].')" type="checkbox" '.$checked.'></div></td>';
			echo '</tr>';
		}
		?>
	</table>
</div>