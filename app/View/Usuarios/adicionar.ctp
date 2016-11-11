<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Gerenciar Usuários</h3>
	</div>
</div>
<?php echo $this->Session->flash(); ?>
<div class="col-md-12 white-bg">
<?php echo $this->Form->create('Usuario', array('novalidate', 'inputDefaults' => array('div' => array('class' => 'col-sm-6 form-group'))));?>

	<div >
		<h2><b><?php echo $this->action == 'adicionar' ? 'Novo Usuário' : 'Editar Usuário'?></b></h2>
	</div>
	<hr>

	<?php
		if($this->action == 'editar')
			echo $this->Form->hidden('id',array('class' => 'col-sm-2', 'value' => $this->request->data['Usuario']['id']));
	?>

		<div class="col-sm-12">
			<?php echo $this->Form->input('nome', array('class' => 'col-sm-9', 'placeholder' => 'Insira seu nome completo', 'label' => array('text' => 'Nome:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('email', array('class' => 'col-sm-9', 'placeholder' => 'Insira seu e-mail', 'label' => array('text' => 'E-mail:', 'class' => 'col-sm-2')));?>
		</div>

		<div class="col-sm-12">
			<?php echo $this->Form->input('login', array('class' => 'col-sm-9', 'placeholder' => 'Insira seu nome login', 'label' => array('text' => 'Login:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('senha', array('class' => 'col-sm-5', 'type' => 'password', 'placeholder' => 'Insira sua senha...', 'label' => array('text' => 'Senha:', 'class' => 'col-sm-2')));?>
		</div>
		
		<div class="col-sm-12 form-group">
			<div class="col-sm-6">
				<?php echo $this->Form->input('ddd', array('class' => 'col-sm-2', 'placeholder' => 'DDD', 'type' => 'text', 'label' => array('text' => 'Celular:', 'class' => 'col-sm-2'), 'div' => false));?>
				<?php echo $this->Form->input('celular', array('class' => 'col-sm-5', 'placeholder' => 'Celular', 'style' => 'margin-left:5px;', 'type' => 'text', 'label' => false, 'div' => false));?>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-3">
				<?php echo $this->Form->input('sexo_id', array('empty' => 'Selecione o sexo', 'label' => array('text' => 'Sexo:', 'class' => 'col-sm-4'), 'div' => 'col-sm-12')); ?>
			</div>
			<div class="col-sm-3">
				<?php echo $this->Form->input('perfil_id', array('empty' => 'Selecione o perfil', 'label' => array('text' => 'Perfil:', 'class' => 'col-sm-4'), 'div' => 'col-sm-12')); ?>
			</div>
		</div>

	<div class="text-center">
 		<?php echo $this->Form->end(array('label' => 'Salvar >>', 'class' => 'btn btn-green-default btn-lg', 'style'=>"margin-top:30px;", 'div' => false, 'onclick' => ''));?>
 	</div>
</div>