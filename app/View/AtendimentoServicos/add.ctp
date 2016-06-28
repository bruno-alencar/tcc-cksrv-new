<?php

echo $this->Form->create('AtendimentoServico', array('inputDefaults' => array('class' => 'form-control', 'div' => array('class' => 'form-group'), 'label' => false)));
echo $this->Form->hidden('atendimento_id', array('value' => $this->params['pass'][0]));
echo $this->Form->hidden('usuario_id', array('value' => AuthComponent::user('id')));
echo $this->Form->input('servico_tipo_id', array('options' => $servico_tipos, 'empty' => 'Selecione um tipo de serviço'));
echo $this->Form->input('resumo', array('placeholder' => 'Resumo'));
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-sm btn-success'));