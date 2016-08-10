<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Gerenciar Servidores</h3>
	</div>
</div>

<div class="col-md-12 white-bg min-height">
	<div >
		<h2><b><?php echo $this->request->data['Servidor']['host'];?></b></h2>
		<br>
	</div>
	<div class="col-md-8 col-md-offset-2">
		<?php echo $this->Form->create('Servidor', array('admin' => true, 'class' => 'form-horizontal', 'novalidate', 'inputDefaults' => array('class' => 'col-md-12', 'div' => array('class' => 'form-group col-md-12'), 'label' => false)));?>
		<?php echo $this->Form->hidden('id', array('value' => $this->request->data['Servidor']['id'])); ?>
		<div class="col-sm-12">
			<?php echo $this->Form->input('host', array('class' => 'col-sm-9', 'placeholder' => 'Insira o host', 'label' => array('text' => 'Host:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('ip', array('class' => 'col-sm-9', 'placeholder' => 'Insira o ip', 'label' => array('text' => 'IP:', 'class' => 'col-sm-2')));?>
		</div>

		<div class="col-sm-12">
			<?php echo $this->Form->input('usuario', array('class' => 'col-sm-9', 'placeholder' => 'Insira o usuário', 'label' => array('text' => 'Usuário:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('senha', array('class' => 'col-sm-5', 'type' => 'password', 'placeholder' => 'Insira a senha', 'label' => array('text' => 'Senha:', 'class' => 'col-sm-2')));?>
		</div>
		
		<div class="col-sm-12">
			<?php echo $this->Form->input('detalhes_so', array('class' => 'col-sm-9', 'placeholder' => 'Insira o Sistema Operacional', 'label' => array('text' => 'Sistema Operacional:', 'class' => 'col-sm-2')));?>
		</div>

		<?php echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-green-default btn-sm', 'div' => array('class' => 'col-md-12 form-group text-center'))); ?>
			
	</div>
	<div class="row text-center">

		<!-- Serviços -->
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Serviços</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
	                    	<i class="fa fa-chevron-up"></i>
	                    </a>
	                    <?php echo $this->Html->link('', array('controller' => 'servicos', 'action' => 'admin_add', $this->request->data['Servidor']['id']), array('title' => 'Adicionar Serviço', 'onclick' => 'javascript:void(exibeModal(this))', 'class' => 'fa fa-plus showmodal pull-right')); ?>
					</div>
				</div>
				<div class="ibox-content">
					
				</div>
			</div>
		</div>
	</div>
</div>