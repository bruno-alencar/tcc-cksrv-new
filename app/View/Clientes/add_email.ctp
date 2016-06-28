<div class="white-bg col-md-8 col-md-offset-2">
<?php 

	echo $this->Form->create('ClienteEmail', array('admin' => false, 'novalidate', 'inputDefaults' => array('div' => array('class' => 'col-sm-12 form-group no-padding'))));

	if($this->action == 'edit_email'){
		echo $this->Form->hidden('id',array('value' => $this->request->data['ClienteEmail']['id']));
		echo $this->Form->hidden('cliente_id',array('value' => $this->request->data['ClienteEmail']['cliente_id']));
	}
 
	if($this->action == 'add_email')
		echo $this->Form->hidden('cliente_id',array('class' => 'col-sm-2', 'value' => $cliente_id)); 

	echo $this->Form->input('email', array('class' => 'col-sm-12', 'placeholder' => 'Insira o endereço do e-mail', 'label' => false));

 	echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success btn-sm'));
?>
</div>
<div class="clearfix"></div>