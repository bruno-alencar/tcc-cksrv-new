<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Gerenciar Servidores</h3>
	</div>
</div>

<div class="col-md-12 white-bg">
<?php echo $this->Form->create('Servidor', array('admin' => true, 'novalidate', 'inputDefaults' => array('div' => array('class' => 'col-sm-6 form-group'))));?>

	<div >
		<h2><b><?php echo $this->action == 'admin_add' ? 'Novo Servidor' : 'Editar Servidor'?></b></h2>
	</div>
	<hr>

	<?php
		if($this->action == 'admin_edit')
			echo $this->Form->hidden('id',array('class' => 'col-sm-2', 'value' => $this->request->data['Usuario']['id']));
	?>

		<div class="col-sm-12">
			<?php echo $this->Form->input('host', array('class' => 'col-sm-9', 'placeholder' => 'Insira o host', 'label' => array('text' => 'Host:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('ip', array('class' => 'col-sm-9', 'placeholder' => 'Insira o ip', 'label' => array('text' => 'IP:', 'class' => 'col-sm-2')));?>
		</div>

		<div class="col-sm-12">
			<?php echo $this->Form->input('usuario', array('class' => 'col-sm-9', 'placeholder' => 'Insira o usuário', 'label' => array('text' => 'Usuário:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('senha', array('class' => 'col-sm-5', 'type' => 'password', 'placeholder' => 'Insira a senha', 'label' => array('text' => 'Senha:', 'class' => 'col-sm-2')));?>
		</div>
		
		<div class="col-sm-12">
			<?php echo $this->Form->input('detalhes_so', array('class' => 'col-sm-9', 'placeholder' => 'Insira o Sistema Operacional', 'label' => array('text' => 'Sistema Operacional:', 'class' => 'col-sm-2')));?>
		</div>


	<div class="text-center">
 		<?php echo $this->Form->end(array('label' => 'Salvar >>', 'class' => 'btn btn-success btn-lg', 'style'=>"margin-top:30px;", 'div' => false, 'onclick' => ''));?>
 	</div>
</div>