<?php

	echo $this->Form->create('AtendimentoObservacao', array('inputDefaults' => array('class' => 'form-control', 'div' => array('class' => 'form-group'), 'label' => false)));
	echo $this->Form->hidden('atendimento_id', array('value' => $this->params['pass'][0]));
	echo $this->Form->hidden('atendimento_servico_id', array('value' => $this->params['pass'][1]));
	echo $this->Form->hidden('usuario_id', array('value' => AuthComponent::user('id')));
	echo $this->Form->input('observacao_tipo_id', array('options' => $observacao_tipos, 'empty' => 'Selecione um tipo de observação'));
	echo $this->Form->input('observacao', array('placeholder' => 'Observação'));
	echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-sm btn-success'));

?>