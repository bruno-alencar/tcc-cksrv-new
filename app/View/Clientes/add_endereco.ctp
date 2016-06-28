<?php

echo $this->Form->create('ClienteEndereco', array('admin' => false, 'novalidate', 'inputDefaults' => array('class' => 'col-md-12', 'div' => array('class' => 'form-group col-md-12'), 'label' => false)));

	if($this->action == 'add_endereco')
	echo $this->Form->hidden('cliente_id',array('class' => 'col-sm-2', 'value' => $cliente_id)); 

	if($this->action == 'edit_endereco'){
		echo $this->Form->hidden('id',array('class' => 'col-sm-2', 'value' => $this->request->data['ClienteEndereco']['id']));
		echo $this->Form->hidden('cliente_id',array('class' => 'col-sm-2', 'value' => $this->request->data['ClienteEndereco']['cliente_id']));
	}

	echo $this->Form->input('ClienteEndereco.cep', array('class' => 'cep  col-md-6', 'type' => 'text', 'div' => array('class' => 'form-group col-md-6'), 'placeholder' => 'CEP', 'onblur' => 'busca_info_cep(this.value)'));

	echo $this->Form->input('ClienteEndereco.logradouro', array('class' => 'logradouro  col-md-12', 'placeholder' => 'Endereço'));

	echo '<div class="form-inline form-group col-md-12">';
	echo $this->Form->input('ClienteEndereco.numero', array('class' => 'numero col-md-2', 'div' => false, 'placeholder' => 'Número'));
	echo $this->Form->input('ClienteEndereco.complemento', array('class' => 'complemento  col-md-5 col-md-offset-1', 'div' => false, 'placeholder' => 'Complemento'));
	echo $this->Form->input('ClienteEndereco.bairro', array('div' => false, 'class' => 'bairro col-md-3 col-md-offset-1', 'placeholder' => 'Bairro'));
	echo '</div>';

	echo '<div class="form-inline form-group col-md-12">';
	echo $this->Form->input('ClienteEndereco.estado_id', array('class' => 'estado col-md-4', 'div' => false, 'empty' => 'Selecione um Estado', 'onchange' => 'buscaCidades(this.value)'));
	echo $this->Form->input('ClienteEndereco.cidade_id', array('class' => 'cidade col-md-4 col-md-offset-1', 'div' => false, 'empty' => 'Selecione uma Cidade'));
	echo '</div>';

	echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success btn-sm', 'div' => array('class' => 'col-md-12 form-group')));

?>
<div class="clearfix"></div>