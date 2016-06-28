<div class="white-bg" style="padding:10px;">
	
	<?php 

		echo $this->Form->create('Contato', array('admin' => false, 'novalidate', 'inputDefaults' => array('label' => false, 'div' => array('class' => 'col-md-12 form-group no-padding'))));

		if($this->action == 'edit_contato'){
			echo $this->Form->hidden('id',array('class' => 'col-md-2', 'value' => $this->request->data['Contato']['id']));
			echo $this->Form->hidden('cliente_id',array('class' => 'col-md-2', 'value' => $this->request->data['Contato']['cliente_id']));		
		}

		if($this->action == 'add_contato')
		echo $this->Form->hidden('cliente_id',array('class' => 'col-md-2', 'value' => $cliente_id)); 

		echo $this->Form->input('nome', array('class' => 'col-md-8', 'class' => 'col-md-4', 'placeholder' => 'Nome do Contato'));
		echo $this->Form->input('cpf', array('class' => 'col-md-8', 'id' => 'cpf', 'placeholder' => 'CPF'));

		echo '<div class="form-inline col-md-12 form-group no-padding">';
		echo $this->Form->input('sexo_id', array('empty' => 'Selecione o Sexo', 'div' => false, 'class' => 'col-md-4 form-control'));
		echo $this->Form->input('contato_cargo_id', array('empty' => 'Selecione o cargo', 'div' => false, 'class' => 'col-md-4 col-md-offset-1 form-control'));
		echo '</div>';
?>


	<?php 
		echo '<div class="form-inline col-md-12 form-group no-padding">';
			echo $this->Form->input('ddd_1', array('class' => 'col-sm-2', 'type' => 'text', 'div' => false, 'placeholder' => 'DDD'));
			echo $this->Form->input('telefone_1', array('class' => 'col-sm-5 col-md-offset-1', 'type' => 'text', 'div' => false, 'placeholder' => 'Número do Telefone Principal'));
			echo $this->Form->input('ramal_1', array('class' => 'col-sm-2 col-md-offset-1', 'type' => 'text', 'div' => false, 'placeholder' => 'Ramal'));
		echo '</div>';
	?>

	<?php 
		echo '<div class="form-inline col-md-12 form-group no-padding">';
			echo $this->Form->input('ddd_2', array('class' => 'col-sm-2', 'type' => 'text', 'div' => false, 'placeholder' => 'DDD'));
			echo $this->Form->input('telefone_2', array('class' => 'col-sm-5 col-md-offset-1', 'type' => 'text', 'div' => false, 'placeholder' => 'Número do Telefone Adicional'));
			echo $this->Form->input('ramal_2', array('class' => 'col-sm-2 col-md-offset-1', 'type' => 'text', 'div' => false, 'placeholder' => 'Ramal'));
		echo '</div>';
	?>

	<?php 
		echo '<div class="form-inline col-md-12 form-group no-padding">';
			echo $this->Form->input('email_1', array('class' => 'col-sm-8', 'placeholder' => 'Insira o endereço do e-mail principal', 'label' => false));
		echo '</div>';
	?>

	<?php 
		echo '<div class="form-inline col-md-12 form-group no-padding">';
			echo $this->Form->input('email_2', array('class' => 'col-sm-8', 'placeholder' => 'Insira o endereço do e-mail adicional', 'label' => false));
		echo '</div>';
	?>

	


	<?php echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success btn-sm', 'div' => array('class' => 'form-inline form-group'))); ?>
 

<script type="text/javascript">
	jQuery(function($){
	  $("#cpf").mask("999.999.999-99");
	});
</script>