<div class="col-md-12 white-bg">
<?php echo $this->Form->create('Usuario', array('admin' => true, 'novalidate', 'inputDefaults' => array('div' => array('class' => 'col-sm-6 form-group'))));?>

	<div >
		<h2><b><?php echo $this->action == 'admin_add_usuario' ? 'Novo Usuário' : 'Editar Usuário'?></b></h2>
	</div>
	<hr>

	<?php
		if($this->action == 'admin_edit_usuario')
			echo $this->Form->hidden('id',array('class' => 'col-sm-2', 'value' => $this->request->data['Usuario']['id']));
	?>

		<div class="col-sm-12">
			<?php echo $this->Form->input('nome_completo', array('class' => 'col-sm-9', 'placeholder' => 'Insira seu nome completo...', 'label' => array('text' => 'Nome:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('nome_consultor', array('class' => 'col-sm-9', 'placeholder' => 'Insira seu nome consultor...', 'label' => array('text' => 'Consultor:', 'class' => 'col-sm-2')));?>
		</div>

		<div class="col-sm-12">
			<?php echo $this->Form->input('email', array('class' => 'col-sm-9', 'placeholder' => 'Insira seu nome e-mail...', 'label' => array('text' => 'E-mail:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('telefone', array('class' => 'col-sm-5 telefone', 'placeholder' => '(99) 9999-9999', 'label' => array('text' => 'Telefone:', 'class' => 'col-sm-2')));?>
		</div>
		
		<div class="col-sm-12" style="margin-bottom:20px;">
			<?php echo $this->Form->input('senha', array('class' => 'col-sm-5', 'type' => 'password', 'placeholder' => 'Insira sua senha...', 'label' => array('text' => 'Senha:', 'class' => 'col-sm-2')));?>
		</div>
		<div class="col-sm-3">
			<?php echo $this->Form->input('sexo_id', array('empty' => 'Selecione o sexo', 'label' => array('text' => 'Sexo:', 'class' => 'col-sm-3'), 'div' => 'col-sm-12')); ?>
		</div>
		<div class="col-sm-3">
			<?php echo $this->Form->input('usuario_perfil_id', array('empty' => 'Selecione o perfil', 'label' => array('text' => 'Perfil:', 'class' => 'col-sm-3'), 'div' => 'col-sm-12')); ?>
		</div>
		<div class="col-sm-3">
			<?php echo $this->Form->input('usuario_grupo_id', array('empty' => 'Selecione o grupo', 'label' => array('text' => 'Grupo:', 'class' => 'col-sm-3'), 'div' => 'col-sm-12')); ?>
		</div>
		<div class="col-sm-3">
			<?php echo $this->Form->input('usuario_cargo_id', array('empty' => 'Selecione o cargo', 'label' => array('text' => 'Cargo:', 'class' => 'col-sm-3'), 'div' => 'col-sm-12')); ?>
		</div>

	<div class="text-center">
 		<?php echo $this->Form->end(array('label' => 'Salvar >>', 'class' => 'btn btn-success btn-lg', 'style'=>"margin-top:30px;", 'div' => false, 'onclick' => ''));?>
 	</div>
</div>