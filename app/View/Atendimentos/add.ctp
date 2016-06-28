<?php

echo $this->Form->create('Atendimento', array('inputDefaults' => array('class' => 'form-control', 'div' => array('class' => 'form-group'), 'label' => array('text' => false))));

if(isset($this->request->named['empresa_id']))
	echo $this->Form->hidden('cliente_id', array('type' => 'text', 'value' => $this->request->named['empresa_id']));
else{
	echo '<div class="form-inline">';
		echo $this->Form->input('autocomplete.cliente_id', array('type' => 'text', 'label' => false, 'placeholder' => 'Cliente', 'class' => 'autocomplete form-control width80', 'div' => false));
		echo $this->Html->link('Adicionar Cliente', array('controller' => 'clientes', 'action' => 'index'), array('class' => 'btn btn-sm btn-info'));
		echo $this->Form->input('cliente_id', array('type' => 'hidden'));
	echo '</div>';
}

echo $this->Form->hidden('usuario_id', array('value' => AuthComponent::user('id')));
echo $this->Form->input('contato_id', array('empty' => 'Selecione um contato', 'class' => 'contatos form-control'));
echo $this->Form->input('atendimento_origem_id', array('empty' => 'Selecione uma origem', 'options' => array(1 => 'E-Mail', 2 => 'Telefone')));
echo $this->Form->input('assunto', array('placeholder' => 'Assunto'));
echo $this->Form->input('descricao', array('type' => 'textarea', 'placeholder' => 'Descrição do atendimento'));
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-sm btn-success'));

?>

<?php echo $this->Html->script('jquery-2.2.3.min.js') ?>
<?php echo $this->Html->script('bootstrap/js/bootstrap.min.js') ?>
<?php echo $this->Html->script('metisMenu.min.js') ?>
<?php echo $this->Html->script('jquery.slimscroll.min.js') ?>
<?php echo $this->Html->script('inspinia.js') ?>
<?php echo $this->Html->script('jquery-ui.min.js') ?>
<?php echo $this->Html->script('funcoes.js') ?>