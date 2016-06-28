<?php echo $this->Form->create('ClienteTelefone', array('admin' => false, 'novalidate', 'inputDefaults' => array('label' => false, 'div' => array('class' => 'form-group col-md-12'))));?>

<?php
	if($this->action == 'edit_telefone'){
		echo $this->Form->hidden('id',array('class' => 'col-sm-2', 'value' => $this->request->data['ClienteTelefone']['id']));
		echo $this->Form->hidden('cliente_id',array('class' => 'col-sm-2', 'value' => $this->request->data['ClienteTelefone']['cliente_id']));
	}else{
		echo $this->Form->hidden('cliente_id',array('class' => 'col-sm-2', 'value' => $this->request->params['pass'][0]));
	}
?>

<div class="form-inline form-group col-md-12">
	<?php 
		echo $this->Form->input('ddd', array('class' => 'col-sm-2', 'type' => 'text', 'div' => false, 'placeholder' => 'DDD'));
		echo $this->Form->input('numero', array('class' => 'col-sm-5 col-md-offset-1', 'type' => 'text', 'div' => false, 'placeholder' => 'Número do Telefone'));
		echo $this->Form->input('ramal', array('class' => 'col-sm-2 col-md-offset-1', 'type' => 'text', 'div' => false, 'placeholder' => 'Ramal'));
	?>
</div>
	<?php
		echo $this->Form->input('telefone_tipo_id', array('empty' => 'Selecione o tipo de telefone'));
		echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success btn-sm', 'div' => array('class' => 'col-md-12 form-group')));
	?>
<div class="clearfix"></div>