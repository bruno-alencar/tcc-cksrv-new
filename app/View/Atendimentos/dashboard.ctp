<div class="col-md-12 page-heading">
	<div class="row">
		<?php echo $this->Html->link('Novo Atendimento', array('action' => 'add'), array('class' => 'btn btn-sm btn-success pull-right showmodal', 'title' => 'Adicionar Atendimento', 'onclick' => 'exibeModal(this)')); ?>
	</div>
</div>
<div class="clearfix"></div>
<br>
<section class="col-sm-12">
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Agendamentos para hoje</b> <span class="badge pull-right badge-warning"><?php echo count($agendamentos) ?></span></div>
			<div class="panel-body">
				<table class="table no-margin no-border">
					<?php
						foreach ($agendamentos as $a) {
							echo '<tr>';
							echo '<td>';
							echo $this->Html->link(dataBr($a['AtendimentoAgendamento']['data_agendamento']).' - '.$a['AtendimentoAgendamento']['descricao'], array('action' => 'view', $a['AtendimentoAgendamento']['atendimento_id'], $a['AtendimentoAgendamento']['atendimento_servico_id'] ? 'servico_id:'.$a['AtendimentoAgendamento']['atendimento_servico_id'] : ''));
							echo '</td>';
							echo '<td>';
							echo $this->Html->link('<i class="fa fa-icon fa-check fa-lg"></i>', 'javascript:void(finalizar_agendamento('.$a['AtendimentoAgendamento']['id'].'))', array('escape' => false, 'class' => 'pull-right', 'title' => 'Finalizar agendamento'));
							echo $this->Html->link('<i class="fa fa-icon fa-edit fa-lg"></i>', array('controller' => 'atendimento_agendamentos', 'action' => 'edit', $a['AtendimentoAgendamento']['id']), array('escape' => false, 'class' => 'pull-right showmodal', 'title' => 'Editar agendamento', 'onclick' => 'exibeModal(this)'));
							echo date('Y-m-d H:i:s') > $a['AtendimentoAgendamento']['data_agendamento'] ? '<i class="fa fa-icon fa-thumbs-o-down fa-lg pull-right"></i>' : '<span class="fa fa-icon fa-thumbs-o-up fa-lg pull-right"></span>';
							echo "</td>";
							echo "</tr>";
						}
					?>
				</table>
			</div>
		</div>
	</div>
<!-- 	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">Header</div>
			<div class="panel-body">
				Content
			</div>
		</div>
	</div> -->
</section>
