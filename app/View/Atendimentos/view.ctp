<div class="col-md-12 border-bottom-content white-bg page-heading no-padding-bottom">
	<div class="col-md-3 min">
		<span class="header">Atendimento #<?php echo $atendimento['Atendimento']['id'] ?></span>
	</div>
	<div class="col-md-6 no-padding dados-cliente">
		<div class="col-md-12 no-padding">
			<div class="col-md-6 no-padding">
				<p><b>Empresa: </b><?php echo $cliente['Cliente']['razao_social'] ?></p>
				<p><b>CPF/CNPJ: </b><?php echo $cliente['Cliente']['cpf_cnpj'] ?></p>
				<p><b>Cidade/Estado: </b><?php echo $cliente_endereco['Cidade']['nome'].'/'.$cliente_endereco['Cidade']['uf']  ?></p>
			</div>
			<div class="col-md-6">
				<p><b>Contato: </b><?php echo $cliente['Contato']['nome'] ?></p>
				<p><b>Telefone: </b><?php echo $cliente['ClienteTelefone']['ddd'].' '.$cliente['ClienteTelefone']['numero'] ?></p>
			</div>
		</div>

	</div>
	<div class="col-md-3">
		<div class="pull-right">
			<?php echo $this->Html->link('<i class="fa fa-icon fa-plus"></i> Adicionar Serviço', array('controller' => 'atendimento_servicos', 'action' => 'add', $this->params['pass'][0]), array('class' => 'btn btn-sm btn-info showmodal', 'title' => 'Adicionar Serviço', 'escape' => false, 'onclick' => 'exibeModal(this)')); ?>
		</div>
	</div>
</div>

<!-- Conteúdo do atendimento -->

<div class="col-md-12 no-padding">
	<div class="col-md-3 min-height bg-gray">
		<p class="titulos-interna"><?php echo $this->Html->link('Todo Histórico', array('action' => 'view', $this->request->params['pass'][0]), array('class' => 'btn btn-default btn -lg col-md-12 ')) ?></p>
		<?php
			foreach($servicos as $servico):
				$active = false;

				if(isset($this->request->named['servico_id']))
					$active = $this->request->named['servico_id'] == $servico['AtendimentoServico']['id'] ? 'active' : false;

					echo $this->Html->link(
						"<b>Serviço #".$servico['AtendimentoServico']['id'].' - '.$servico['ServicoTipo']['descricao']."</b><br>
						".$servico['Usuario']['nome_consultor']."<br>
						<span class='badge badge-primary'>".$servico['StatusServico']['descricao']."</span><br>",
						array('action' => 'view', $servico['AtendimentoServico']['atendimento_id'], 'servico_id' => $servico['AtendimentoServico']['id']), array('class' => "col-md-12 lista-servicos $active", 'escape' => false));
			endforeach;
		?>
	</div>
	<div class="col-md-6 no-padding">
		<ul class="list-inline lista-acoes text-center no-margin">
			<li><?php echo $this->Html->link('<i class="fa fa-icon fa-commenting-o fa-lg"></i>', array('controller' => 'atendimento_observacoes', 'action' => 'add', $this->request->params['pass'][0]), array('escape' => false, 'onclick' => 'exibeModal(this)', 'class' => 'showmodal', 'title' => 'Adicionar Observação')) ?></li>
			<li><?php echo $this->Html->link('<i class="fa fa-icon fa-calendar fa-lg"></i>', array('controller' => 'atendimento_agendamentos', 'action' => 'add', $this->request->params['pass'][0]), array('escape' => false, 'onclick' => 'exibeModal(this)', 'class' => 'showmodal', 'title' => 'Agenda')) ?></li>
			<li><i class="fa fa-icon fa-user"></i> <?php echo $atendimento['Usuario']['nome_consultor'] ?></li>
			<li>
				<?php echo $this->Form->input('status_atendimento_id', array('label' => false, 'options' => $status_atendimentos, 'default' => $atendimento['Atendimento']['status_atendimento_id'], 'data-atendimento' => $atendimento['Atendimento']['id'], 'class' => 'status-atendimento', 'style' => 'font-size:14px;')) ?>
			</li>
		</ul>
		<div class="col-md-12 border-top-content page-heading">
			<div class="col-md-12">
				<div class="ibox collapsed border-bottom no-margin">
					<div class="ibox-title">
						<?php if(isset($this->request->named['servico_id'])): ?>
						<h5>Resumo do Serviço</h5>
						<div class="ibox-tools">
							<?php echo $this->Html->link('<i class="fa fa-commenting-o fa-lg"></i>', array('controller' => 'atendimento_observacoes', 'action' => 'add_observacao_servico', $atendimento['Atendimento']['id'], $this->request->named['servico_id']), array('title' => 'Adicionar Observação - Serviço #'.$this->request->named['servico_id'], 'class' => 'showmodal pull-right', 'onclick' => 'exibeModal(this)', 'escape' => false)) ?>
							<?php echo $this->Html->link('', array('controller' => 'anexos', 'action' => 'add', $atendimento['Atendimento']['id'], $this->request->named['servico_id']), array('title' => 'Adicionar Documento - Serviço #'.$this->request->named['servico_id'], 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'pull-right showmodal fa fa-icon fa-paperclip fa-lg')); ?>
							<?php echo $this->Form->input('status_servico_id', array('label' => false, 'options' => $status_servicos, 'default' => $servico_atual['AtendimentoServico']['status_servico_id'], 'data-servico' => $this->request->named['servico_id'], 'class' => 'status-servico pull-right')) ?>
						</div>
						<?php
							else:
								echo '<h5>Resumo do Atendimento</h5>';
							endif; 
						?>
					</div>
					<div class="ibox-content" style="display: block;">
						<?php 
							echo isset($servico_atual) ? $servico_atual['AtendimentoServico']['resumo'] : '<p><b>Assunto: </b>'.$atendimento['Atendimento']['assunto'].'</p>'.$atendimento['Atendimento']['descricao'];
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 historico overflow">
			<!-- Histórico -->
			<?php 
				if(isset($observacoes)):
					foreach($observacoes as $obs):
			?>
					<div class="vertical-timeline-block">
						<div class="vertical-timeline-icon navy-bg">
							<?php echo date('d-m-Y') == date('d-m-Y', strtotime($obs['AtendimentoObservacao']['created'])) ? 'Hoje' : date('d M', strtotime($obs['AtendimentoObservacao']['created'])) ?>
						</div>
						<div class="vertical-timeline-content">
							 <span class="vertical-date">
							 	<small class="red"><b><?php echo empty($obs['AtendimentoObservacao']['atendimento_servico_id']) ? '' : 'Serviço #'.$obs['AtendimentoObservacao']['atendimento_servico_id'].' - '; ?></b></small>
								<small><?php echo date('d M Y H:i:s', strtotime($obs['AtendimentoObservacao']['created'])) ?></small>
								<small><b><?php echo $obs['ObservacaoTipo']['descricao'] ?></b></small>
							</span>
							<div class="clearfix"></div>
							<p><?php echo $obs['AtendimentoObservacao']['observacao'] ?></p>
						</div>
					</div>
				<?php
					endforeach;
				endif;
			?>
			<!-- Fim do Histórico -->
		</div>
	</div>
	<div class="col-md-3 min-height bg-gray no-padding">
		<div class="titulos-interna col-md-12">
			<span>Documentos - </span>
			<?php echo isset($this->request->named['servico_id']) ? 'Serviço #'.$this->request->named['servico_id'] : 'Geral' ?>
			<?php echo $this->Html->link('', array('controller' => 'anexos', 'action' => 'add', $atendimento['Atendimento']['id']), array('title' => 'Adicionar Documento', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'btn btn-sm btn-info pull-right showmodal fa fa-icon fa-plus')); ?>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-12 border-top-content">
		<br>
			<?php
				if(isset($arquivos)):
					foreach($arquivos as $a):
						if(isset($this->request->named['servico_id'])):
							echo $this->Html->link($a['Anexo']['nome'], Router::fullbaseUrl().'/juridico/arquivos/'.$a['Anexo']['atendimento_id'].'/'.$a['Anexo']['atendimento_servico_id'].'/'.$a['Anexo']['nome'],array('class' => 'btn btn-sm btn-info col-md-12', 'style' => 'margin-top:10px', 'target'=>'_blank'));
						else:
							if($a['Anexo']['atendimento_servico_id'] == null):
								echo $this->Html->link($a['Anexo']['nome'],Router::fullbaseUrl().'/juridico/arquivos/'.$atendimento['Atendimento']['id'].'/'.$a['Anexo']['nome'],array('class' => 'btn btn-sm btn-info col-md-12', 'style' => 'margin-top:10px', 'target'=>'_blank'));
							else:
								echo $this->Html->link($a['Anexo']['nome'], Router::fullbaseUrl().'/juridico/arquivos/'.$a['Anexo']['atendimento_id'].'/'.$a['Anexo']['atendimento_servico_id'].'/'.$a['Anexo']['nome'],array('class' => 'btn btn-sm btn-info col-md-12', 'style' => 'margin-top:10px', 'target'=>'_blank'));
						endif;
						endif;
					endforeach;
				else:
					echo '<h4 class="well">Não existem anexos para este atendimento.</h4>';
				endif;
			?>
		</div>
	</div>
</div>