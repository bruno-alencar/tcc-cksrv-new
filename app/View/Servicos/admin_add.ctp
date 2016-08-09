<?php echo $this->Form->create('Servico', array('admin' => true, 'novalidate', 'inputDefaults' => array('div' => false, 'style'=>'margin-top:30px;')));?>

	<?php echo $this->Form->input('tipo_servico_id', array('empty' => 'Selecione o tipo de serviço', 'onchange' => "javascript:void(altera_texto_adicionar_servico(this.value))", 'label' => array('text' => false), 'div' => 'col-sm-12', 'style' => 'margin-bottom:30px;')); ?>

	<div class="alert alert-info text-center col-sm-12" id="mensagem-tipo-servico1" style="display:none">
		serv 1
	</div>
	<div class="alert alert-info text-center col-sm-12" id="mensagem-tipo-servico2" style="display:none">
		serv 2
	</div>
	<div class="alert alert-info text-center col-sm-12" id="mensagem-tipo-servico3" style="display:none">
		serv 3
	</div>
	<div class="alert alert-info text-center col-sm-12" id="mensagem-tipo-servico4" style="display:none">
		serv 4
	</div>
	<div class="alert alert-info text-center col-sm-12" id="mensagem-tipo-servico5" style="display:none">
		serv 5
	</div>
		
	<?php echo $this->Form->input('critical', array('label' => array('text' => 'Critical: ', 'class' => 'col-sm-3 critical-color', 'style'=>'margin-top:30px;'), 'div' => 'col-sm-6 critical-border')); ?>
	<?php echo $this->Form->input('warning', array('label' => array('text' => 'Warning: ', 'class' => 'col-sm-3 warning-color', 'style'=>'margin-top:30px;'), 'div' => 'col-sm-6 warning-border')); ?>
		

<div class="text-center">
	<?php echo $this->Form->end(array('label' => 'Salvar >>', 'class' => 'btn btn-success btn-lg', 'disabled', 'id' => 'salvar_servico', 'style'=>"margin-top:30px;", 'div' => false, 'onclick' => ''));?>
</div>