<div class="col-md-12 white-bg min-height">
	<div >
		<h2>
			<b><?php echo $this->request->data['Cliente']['nome_fantasia'];?></b>
			<?php echo $this->Html->link('Novo Atendimento', array('controller' => 'atendimentos', 'action' => 'add', 'empresa_id' => $this->request->data['Cliente']['id']), array('class' => 'btn btn-sm btn-success pull-right showmodal', 'title' => 'Adicionar Atendimento', 'onclick' => 'exibeModal(this)')); ?>
		</h2>
		<br>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<?php echo $this->Form->create('Cliente', array('admin' => false, 'class' => 'form-horizontal', 'novalidate', 'inputDefaults' => array('class' => 'col-md-12', 'div' => array('class' => 'form-group col-md-12'), 'label' => false)));?>
			
			<?php
				echo '<div class="form-inline form-group col-md-12">';
				echo $this->Form->input('id', array('type' => 'text', 'class' => 'col-md-2', 'div' => false));
				echo $this->Form->input('controle_cnl', array('class' => 'col-md-2 col-md-offset-1', 'placeholder' => 'Controle CNL', 'div' => false));
				echo $this->Form->input('controle_il', array('class' => 'col-md-2 col-md-offset-1', 'placeholder' => 'Controle IL', 'div' => false));
				echo '</div>';

				echo $this->Form->input('cpf_cnpj', array('class' => 'col-md-6'));

				echo $this->Form->input('razao_social', array('class' => 'razao_social col-md-12'));
				echo $this->Form->input('nome_fantasia', array('class' => 'nome_fantasia col-md-12', 'placeholder' => 'Nome Fantasia'));
				echo $this->Form->input('site', array('class' => 'site col-md-12', 'div' => array('class' => 'form-group col-md-6'), 'placeholder' => 'Site'));

				echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success btn-sm', 'div' => array('class' => 'col-md-12 form-group')));

			?>
	</div>
	<div class="row">

		<!-- Contatos -->
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Contatos</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
	                    	<i class="fa fa-chevron-up"></i>
	                    </a>
	                    <?php echo $this->Html->link('', array('controller' => 'clientes', 'action' => 'add_contato', $this->request->data['Cliente']['id']), array('title' => 'Adicionar Contato', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'fa fa-plus showmodal')); ?>
					</div>
				</div>
				<div class="ibox-content">
					<?php
						foreach ($contatos as $c) {
							$sexo_cor = '#ff66cc';
							if($c['Contato']['sexo_id'] == 1)
							$sexo_cor = '#0066ff';
							echo '<p><i class="fa fa-user fa-lg" style="color:'.$sexo_cor.'"></i> - '.$this->Html->link($c['Contato']['nome'], array('controller' => 'clientes', 'action' => 'edit_contato', $c['Contato']['id']), array('title' => 'Editar Contato', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'showmodal' , 'style' => 'color:#676a6c;')).' - '.$c['ContatoCargo']['descricao'].$this->Html->link(false, 'javascript:void(desativa_contato_cliente('.$c['Contato']['id'].'))', array('class' => 'fa fa-times fa-lg pull-right', 'style' => 'color:#cc0000')).'<br> '.$c['Contato']['ddd_1'].' - '.$c['Contato']['telefone_1'].' / '.$c['Contato']['ddd_2'].' - '.$c['Contato']['telefone_2'].'<br> '.$c['Contato']['email_1'].'<br> '.$c['Contato']['email_2'].'</p><hr>';
						}
					?>
				</div>
			</div>
		</div>

		<!-- E-mail -->
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>E-mail</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
	                    	<i class="fa fa-chevron-up"></i>
	                    </a>
	                    <?php echo $this->Html->link('', array('controller' => 'clientes', 'action' => 'add_email', $this->request->data['Cliente']['id']), array('title' => 'Adicionar E-mail', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'fa fa-plus showmodal')); ?>
					</div>
				</div>
				<div class="ibox-content">
					<?php
						foreach ($emails as $em) {
							echo '<p>'.$this->Html->link($em['ClienteEmail']['email'], array('controller' => 'clientes', 'action' => 'edit_email', $em['ClienteEmail']['id']), array('title' => 'Editar E-mail Cliente', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'showmodal' , 'style' => 'color:#676a6c;')).$this->Html->link(false, 'javascript:void(desativa_email_cliente('.$em['ClienteEmail']['id'].'))', array('class' => 'fa fa-times fa-lg pull-right', 'style' => 'color:#cc0000')).'</p><hr>';
						}


					?>
				</div>
			</div>
		</div>

		<!-- Endereço -->
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Endereço</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
	                    	<i class="fa fa-chevron-up"></i>
	                    </a>
	                    <?php echo $this->Html->link('', array('controller' => 'clientes', 'action' => 'add_endereco', $this->request->data['Cliente']['id']), array('title' => 'Adicionar Endereço', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'fa fa-plus showmodal')); ?>
					</div>
				</div>
				<div class="ibox-content">
					<?php
						foreach ($enderecos as $end) {
							echo '<p><b>'.$this->Html->link('Endereço '.$end['EnderecoTipo']['descricao'], array('controller' => 'clientes', 'action' => 'edit_endereco', $end['ClienteEndereco']['id']), array('title' => 'Editar Endereço Cliente', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'showmodal' , 'style' => 'color:#676a6c;')).'</b>: '.$this->Html->link($end['ClienteEndereco']['logradouro'], array('controller' => 'clientes', 'action' => 'edit_endereco', $end['ClienteEndereco']['id']), array('title' => 'Editar Endereço Cliente', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'showmodal' , 'style' => 'color:#676a6c;')).', '.$end['ClienteEndereco']['numero'].$this->Html->link(false, 'javascript:void(desativa_endereco_cliente('.$end['ClienteEndereco']['id'].'))', array('class' => 'fa fa-times fa-lg pull-right', 'style' => 'color:#cc0000'));
							echo '<br>Complemento: '.$end['ClienteEndereco']['complemento'].'<br> Bairro: '.$end['ClienteEndereco']['bairro'].' <br> CEP: '.$end['ClienteEndereco']['cep'];
							echo '<br>Cidade: '.$end['Cidade']['nome'].' / '.$end['Cidade']['uf'].'</p><hr>';
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<!-- Telefone -->
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Telefone</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
	                    	<i class="fa fa-chevron-up"></i>
	                    </a>
	                    <?php echo $this->Html->link('', array('controller' => 'clientes', 'action' => 'add_telefone', $this->request->data['Cliente']['id']), array('title' => 'Adicionar Telefone', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'fa fa-plus showmodal')); ?>
					</div>
				</div>
				<div class="ibox-content">
					<?php
						foreach ($telefones as $tel) {
							echo '<p><b>'.$tel['TelefoneTipo']['descricao'].': </b>('.$tel['ClienteTelefone']['ddd'].') '.$this->Html->link($tel['ClienteTelefone']['numero'], array('controller' => 'clientes', 'action' => 'edit_telefone', $tel['ClienteTelefone']['id']), array('title' => 'Editar Telefone Cliente', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'showmodal' , 'style' => 'color:#676a6c;')).'  -  <b>Ramal: </b>'.$tel['ClienteTelefone']['ramal'].$this->Html->link(false, 'javascript:void(desativa_telefone_cliente('.$tel['ClienteTelefone']['id'].'))', array('class' => 'fa fa-times fa-lg pull-right', 'style' => 'color:#cc0000')).'</p><hr>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>