<?php echo $this->Form->create('Servico', array('admin' => true, 'novalidate', 'inputDefaults' => array('div' => false, 'style'=>'margin-top:30px;')));?>
<?php echo $this->Html->script('funcoes.js') ?>
	<?php echo $this->Form->input('tipo_servico_id', array('empty' => 'Selecione o tipo de serviço', 'onchange' => "javascript:void(altera_texto_adicionar_servico(this.value))", 'label' => array('text' => false), 'div' => 'col-sm-12', 'style' => 'margin-bottom:30px;')); ?>

	<div class="alert alert-info col-sm-12" id="mensagem-tipo-servico6" style="display:none">
		<p>Monitoramento de Espaço:</p><br>
		<p>O monitoramento de espaço em disco trabalha da seguinte forma:<br>
		Primeiro: é necessário escolher a partição que deverá ser monitorada. Ex: /home</p>
		<p>Segundo: selecione abaixo o nível em que o sistema deverá alarmar. (Lembrando que os dados que devem ser inseridos abaixo, refere-se a % a ser monitorada) Ex: com 5% de espaço livre o sistema alarma em tela (Critical) e com 2% o sistema começa a disparar os alertas (warning).</p><br>
		<p class="critical-color"><b>Critical</b> - neste caso o sistema irá alarmar em tela, porém não irá disparar os alertas.</p>
		<p class="warning-color"><b>Warning</b> - neste caso o sistema irá alarmar em tela e irá disparar os alertas.</p>
	</div>
	<div class="alert alert-info col-sm-12" id="mensagem-tipo-servico2" style="display:none">
		<p>Monitoramento de Load:</p><br>
		<p>Selecione abaixo o nivel em que o sistema deverá monitorar.</p>
		<p>Os dados informados abaixo serão exatamente a quantidade de load da máquina. Ex: passando de 5 de load irá alarmar em tela (Critical) e com 10 ou mais de load o sistema começa a disparar os alertas (warning).</p>
		<p class="critical-color"><b>Critical</b> - neste caso o sistema irá alarmar em tela, porém não irá disparar os alertas.</p>
		<p class="warning-color"><b>Warning</b> - neste caso o sistema irá alarmar em tela e irá disparar os alertas.</p>
	</div>
	<div class="alert alert-info col-sm-12" id="mensagem-tipo-servico3" style="display:none">
		<p>Monitoramento de Usuários conectados:</p><br>
		<p>Selecione abaixo o nivel em que o sistema deverá monitorar.</p>
		<p>Os dados informados abaixo serão exatamente a quantidade de usuários logados no momento no servidor alvo. Ex: passando de 2 usuários logados no servidor, ele começa a alarmar em tela (Critical) e passando de 4 usuários logados o sistema começa a disparar os alertas (warning).</p>
		<p class="critical-color"><b>Critical</b> - neste caso o sistema irá alarmar em tela, porém não irá disparar os alertas.</p>
		<p class="warning-color"><b>Warning</b> - neste caso o sistema irá alarmar em tela e irá disparar os alertas.</p>
	</div>
	<div class="alert alert-info col-sm-12" id="mensagem-tipo-servico4" style="display:none">
		<p>Monitoramento de Processos:</p><br>
		<p>Selecione abaixo o nivel em que o sistema deverá monitorar.</p>
		<p>Os dados informados abaixo serão exatamente a quantidade de processos executando no servidor alvo. Ex: passando de 100 processos em execução o servidor começa a alarmar em tela (Critical) e passando de 300 processos em execução o sistema começa a disparar os alertas (warning).</p>
		<p class="critical-color"><b>Critical</b> - neste caso o sistema irá alarmar em tela, porém não irá disparar os alertas.</p>
		<p class="warning-color"><b>Warning</b> - neste caso o sistema irá alarmar em tela e irá disparar os alertas.</p>
	</div>
	<div class="alert alert-info col-sm-12" id="mensagem-tipo-servico5" style="display:none">
		<p>Monitoramento de Processos Zombies:</p><br>
		<p>Selecione abaixo o nivel em que o sistema deverá monitorar.</p>
		<p>Os dados informados abaixo serão exatamente a quantidade de processos zombies no servidor alvo. Ex: passando de 1 processo zombie o servidor começa a alarmar em tela (Critical) e passando de 3 processos zombies o sistema começa a disparar os alertas (warning).</p>
		<p class="critical-color"><b>Critical</b> - neste caso o sistema irá alarmar em tela, porém não irá disparar os alertas.</p>
		<p class="warning-color"><b>Warning</b> - neste caso o sistema irá alarmar em tela e irá disparar os alertas.</p>
	</div>

	<div class="col-sm-12" id="particao" style="display:none">
		<?php echo $this->Form->input('particao', array('label' => array('text' => 'Partição: ', 'class' => 'col-sm-3', 'style'=>'margin-top:30px;'), 'div' => 'col-sm-6', 'disabled', 'id' => 'botao-particao')); ?>
	</div>

	<div class="col-sm-12">
		<?php echo $this->Form->input('critical', array('label' => array('text' => 'Critical: ', 'class' => 'col-sm-3 critical-color', 'style'=>'margin-top:30px;'), 'div' => 'col-sm-6 critical-border')); ?>
		<?php echo $this->Form->input('warning', array('label' => array('text' => 'Warning: ', 'class' => 'col-sm-3 warning-color', 'style'=>'margin-top:30px;'), 'div' => 'col-sm-6 warning-border')); ?>
	</div>
		<?php
			echo $this->Form->hidden('servidor_id',array('value' => $servidor['Servidores']['id']));
			echo $this->Form->hidden('ip',array('value' => $servidor['Servidores']['ip']));
		?>

<div class="text-center">
	<?php echo $this->Form->end(array('label' => "Salvar", 'class' => 'btn btn-green-default btn-lg',  'id' => 'salvar_servico', 'style'=>"margin-top:30px;", 'div' => false, 'onclick' => ''));?>
</div>