<?php
	echo $this->Form->create('Anexo',array('type'=>'file','inputDefaults'=>array('div'=>false,'label'=>false)));
		echo $this->Form->input('Anexo.nome', array('type' => 'file', 'required'));
		echo '<br>';
	echo $this->Form->end(array('label'=>'Enviar','class'=>'btn btn-xs btn-success'));
?>