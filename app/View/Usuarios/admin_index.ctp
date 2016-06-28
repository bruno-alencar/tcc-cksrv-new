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
<?= $this->Html->link("Novo usuário", array('admin' => true, 'controller' => 'usuarios' ,'action' => 'add_usuario'), array('class' => 'btn btn-success', 'style' => 'margin-left:20px;')) ?><br>
<br>

<div class="crud-fundo-branco">
	<table class="table table-striped">
		<tr>
			<th>Nome</th>
			<th>Nome Consultor</th>
			<th>E-mail</th>
			<th>Perfil</th>
			<th>Grupo</th>
			<th>Cargo</th>
			<th>Telefone</th>
			<th></th>
		</tr>
		<?php
		foreach ($usuarios as $u) {
			echo '<tr>';
				echo '<td>'.$this->Html->link($u['Usuario']['nome_completo'], array('admin' => true, 'controller' => 'usuarios' ,'action' => 'edit_usuario', $u['Usuario']['id']), array()).'</td>';
				echo '<td>'.$u['Usuario']['nome_consultor'].'</td>';
				echo '<td>'.$u['Usuario']['email'].'</td>';
				echo '<td>'.$u['UsuarioPerfil']['descricao'].'</td>';
				echo '<td>'.$u['UsuarioGrupo']['descricao'].'</td>';
				echo '<td>'.$u['UsuarioCargo']['descricao'].'</td>';
				echo '<td>'.$u['Usuario']['telefone'].'</td>';

				$checked = $u['Usuario']['status_id'] == 1 ? 'checked' : '';
				echo '<td><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini bootstrap-switch-id-switch-size bootstrap-switch-animate bootstrap-switch-off"><input class="form-control" onchange="altera_status_usuario_ativo_inativo('.$u['Usuario']['id'].')" type="checkbox" '.$checked.'></div></td>';
			echo '</tr>';
		}
		?>
	</table>
</div>