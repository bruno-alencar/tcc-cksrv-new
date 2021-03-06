<div class="col-md-12 page-heading bg-color-title-pagina">
	<div class="row">
		<h3>Gerenciar Servidores</h3>
	</div>
</div>
<?php echo $this->Session->flash(); ?>
<div class="col-md-12 white-bg">
<?php echo $this->Form->create('Servidor', array('novalidate', 'inputDefaults' => array('div' => array('class' => 'col-sm-6 form-group'))));?>

	<div >
		<h2><b><?php echo $this->action == 'adicionar' ? 'Novo Servidor' : 'Editar Servidor'?></b></h2>
	</div>
	<hr>

	<?php
		if($this->action == 'editar')
			echo $this->Form->hidden('id',array('value' => $this->request->data['Usuario']['id']));
	?>

	<?php
		if($this->action == 'adicionar'){
			echo $this->Form->hidden('Servico.tipo_servico_id',array('value' => 1));
			echo $this->Form->hidden('Servico.critical',array('value' => 0));
			echo $this->Form->hidden('Servico.warning',array('value' => 0));
		}
	?>

		<div class="col-sm-12">
			<?php echo $this->Form->input('host', array('class' => 'col-sm-9', 'placeholder' => 'Insira o host', 'label' => array('text' => 'Host:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('ip', array('class' => 'col-sm-9', 'placeholder' => 'Insira o ip', 'label' => array('text' => 'IP:', 'class' => 'col-sm-2')));?>
		</div>

		<div class="col-sm-12">
			<?php echo $this->Form->input('usuario', array('class' => 'col-sm-9', 'placeholder' => 'Insira seu nome login', 'label' => array('text' => 'Usuario:', 'class' => 'col-sm-2')));?>
			<?php echo $this->Form->input('senha', array('class' => 'col-sm-5', 'type' => 'password', 'placeholder' => 'Insira sua senha...', 'label' => array('text' => 'Senha:', 'class' => 'col-sm-2')));?>
		</div>
		
		<div class="col-sm-12">
			<?php echo $this->Form->input('detalhes_so', array('class' => 'col-sm-9', 'placeholder' => 'Insira o Sistema Operacional', 'label' => array('text' => 'Sistema Operacional:', 'class' => 'col-sm-2')));?>
		</div>

		<div class="alert alert-info text-center col-sm-12">
			Após a inclusão do servidor, faça a copia da pasta <?php echo WWW_ROOT.'monitor'; ?> e execute o script denominado como install.sh.
			<br><br>
			Comandos:
			<br>
			sudo scp -rp /Library/WebServer/Documents/alfa_ck/app/webroot/monitor usuario@ip:~
			<br>
			ssh usuario@ip
			<br>
			cd ~/monitor
			<br>
			sudo ./install.sh
		</div>
	<div class="text-center">
 		<?php echo $this->Form->end(array('label' => 'Salvar >>', 'class' => 'btn btn-green-default btn-lg', 'style'=>"margin-top:30px;", 'div' => false, 'onclick' => ''));?>
 	</div>
</div>