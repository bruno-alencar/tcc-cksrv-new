<div class="col-md-12 page-heading">
	<div class="row">
		<?php echo $this->Html->link('Novo Atendimento', array('action' => 'add'), array('class' => 'btn btn-sm btn-success pull-right showmodal', 'title' => 'Adicionar Atendimento', 'onclick' => 'exibeModal(this)')); ?>
	</div>
</div>
<div class="col-md-12 border-bottom-content page-heading ">
	<h3>Filtros</h3>
	<?php echo $this->Form->create('Atendimento', array('class' => 'form-horizontal', 'inputDefaults' => array('class' => 'form-control', 'div' => array('class' => 'form-group'), 'label' => false))) ?>
	
	<div class="col-md-4">
		<?php echo $this->Form->input('id', array('type' => 'text', 'placeholder' => 'ID do atendimento')) ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->Form->input('Cliente.razao_social', array('placeholder' => 'Nome da Empresa/Pessoa Física')) ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->Form->input('usuario_id', array('empty' => array("" => 'Todos'))) ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->Form->input('usuario_grupo_id', array('empty' => 'Todos', 'options' => $grupos)) ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->Form->input('status_atendimento_id', array('empty' => 'Todos', 'options' => $status_atendimentos)); ?>
	</div>
	<?php echo $this->Form->end(array('label' => 'Filtrar', 'class' => 'btn-info btn-sm')) ?>
</div>
<div class="col-sm-12 white-bg" id="resultado-busca">
	<br>
	<table class="table table-bordered table-striped table-hover">
		<?php if(!empty($resultado_busca)): ?>
			<tr>
				<th>ID</th>
				<th>Status</th>
				<th>Empresa</th>
				<th>Consultor</th>
				<th>Grupo</th>
				<th>Serviços</th>
				<th>Última Modificação</th>	
			</tr>
			<?php foreach($resultado_busca as $r): ?>
			<tr data-href="<?php echo $this->Html->url(array('controller' => 'atendimentos', 'action' => 'view', $r['Atendimento']['id'])) ?>">
				<td><?php echo $r['Atendimento']['id'] ?></td>
				<td><?php echo $r['StatusAtendimento']['descricao'] ?></td>
				<td><?php echo $r['Cliente']['razao_social'] ?></td>
				<td><?php echo $r['Usuario']['nome_consultor'] ?></td>
				<td><?php echo $r['UsuarioGrupo']['descricao'] ?></td>
				<td><?php echo count($r['AtendimentoServico']) ?></td>
				<td><?php echo $r['Atendimento']['modified'] ?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td>
					<h3>Não foram encontrados atendimentos com os parâmetros fornecidos.</h3>
				</td>
			</tr>
		<?php endif; ?>
	</table>
</div>