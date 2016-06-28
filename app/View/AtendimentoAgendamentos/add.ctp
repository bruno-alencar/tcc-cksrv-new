<?php

	echo $this->Form->create('AtendimentoAgendamento', array('inputDefaults' => array('class' => 'form-control', 'div' => array('class' => 'form-group'), 'label' => false)));

	if($this->action = 'edit')
		echo $this->Form->hidden('id', array('value' => $this->request->data['Atendimento']['id']));

	echo $this->Form->hidden('atendimento_id', array('value' => $this->params['pass'][0]));
	echo $this->Form->hidden('usuario_id', array('value' => AuthComponent::user('id')));
	echo $this->Form->input('data_agendamento', array('class' => 'form-control date', 'separator' => false, 'after' => '<div class="clearfix"></div>', 'timeFormat' => '24', 'dateFormat' => 'DMY', 'interval' => 5, 'label' => array('text' => 'Data do Agendamento:', 'class' => 'col-md-12 no-padding')));
	echo $this->Form->input('descricao', array('placeholder' => 'Descrição do agendamento'));
	echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-sm btn-success'));

	if(isset($agendamentos)){

		foreach ($agendamentos as $a):
	?>
		<table class="table table-striped">
			<tr>
				<th>ID Atendimento</th>
				<th>ID Serviço</th>
				<th>Descrição</th>
				<th>Usuário</th>
				<th>Data Agendada</th>
			</tr>
			<tr>
				<td><?php echo $a['AtendimentoAgendamento']['atendimento_id'] ?></td>
				<td><?php echo $a['AtendimentoAgendamento']['atendimento_servico_id'] ?></td>
				<td><?php echo $a['AtendimentoAgendamento']['descricao'] ?></td>
				<td><?php echo $a['Usuario']['nome_consultor'] ?></td>
				<td><?php echo dataBr($a['AtendimentoAgendamento']['data_agendamento']) ?></td>
			</tr>
		</table>
	<?php
		endforeach;

	}
?>