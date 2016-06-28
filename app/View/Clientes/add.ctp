<div class="col-md-12 white-bg">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->Form->create('Cliente', array('admin' => false, 'class' => 'form-horizontal', 'novalidate', 'inputDefaults' => array('class' => 'col-md-12', 'div' => array('class' => 'form-group col-md-12'), 'label' => false)));?>
		<div>
			<h2><b><?php echo $tipo_pessoa == 1 ? 'Cadastro Pessoa Jurídica' : 'Cadastro Pessoa Física';?></b></h2>
		</div>
		<hr>
			<?php

				echo $this->Form->hidden('cliente_tipo_id', array('value' => $tipo_pessoa));
				echo $this->Form->hidden('controle_cnl', array('value' => '', 'class' => 'controle_cnl')); 
				echo $this->Form->hidden('controle_il', array('value' => '', 'class' => 'controle_il'));
				echo $this->Form->hidden('ClienteEndereco.endereco_tipo_id', array('value' => 1));

			?>
			
			<div class="form-inline form-group col-sm-12">
			<?php

				if($tipo_pessoa == 1){
					echo $this->Form->input('cpf_cnpj', array('placeholder' => 'CNPJ', 'div' => false, 'class' => 'col-md-6 cnpj'));
					echo $this->Form->button('<i class="fa fa-icon fa-search"></i>', array('onclick' => 'busca_cliente_base_cnl_il()', 'class' => 'btn btn-info btn-sm disabledefaultfunction', 'escape' => false));
				}
			?>
				</div>
			<?php
				echo $this->Form->input('razao_social', array('class' => 'razao_social col-md-12', 'placeholder' => $tipo_pessoa == 1 ? 'Razão Social' : 'Nome'));

				if($tipo_pessoa == 1)
					echo $this->Form->input('nome_fantasia', array('class' => 'nome_fantasia col-md-12', 'placeholder' => 'Nome Fantasia'));

				if($tipo_pessoa == 1):
					echo $this->Form->input('site', array('class' => 'site col-md-12', 'div' => array('class' => 'form-group col-md-6'), 'placeholder' => 'Site'));
					echo $this->Form->input('ClienteEmail.email', array('class' => 'email col-md-12 col-md-offset-1', 'div' => array('class' => 'form-group col-md-6'), 'placeholder' => 'E-mail'));
				endif;

				if($tipo_pessoa == 2)
					echo $this->Form->input('cpf', array('class' => 'cpf  col-md-6', 'type' => 'text', 'div' => array('class' => 'form-group col-md-12'), 'placeholder' => 'CPF'));

				echo $this->Form->input('ClienteEndereco.cep', array('class' => 'cep  col-md-6', 'type' => 'text', 'div' => array('class' => 'form-group col-md-6'), 'placeholder' => 'CEP', 'onblur' => 'busca_info_cep(this.value)'));

				

				echo $this->Form->input('ClienteEndereco.logradouro', array('class' => 'logradouro  col-md-12', 'placeholder' => 'Endereço'));

				echo '<div class="form-inline form-group col-md-12">';
				echo $this->Form->input('ClienteEndereco.numero', array('class' => 'numero col-md-2', 'div' => false, 'placeholder' => 'Número'));
				echo $this->Form->input('ClienteEndereco.complemento', array('class' => 'complemento  col-md-5 col-md-offset-1', 'div' => false, 'placeholder' => 'Complemento'));
				echo $this->Form->input('ClienteEndereco.bairro', array('div' => false, 'class' => 'bairro col-md-3 col-md-offset-1', 'placeholder' => 'Bairro'));
				echo '</div>';

				echo '<div class="form-inline form-group col-md-12">';
				echo $this->Form->input('ClienteEndereco.estado_id', array('class' => 'estado col-md-4', 'div' => false, 'empty' => 'Selecione um Estado', 'onchange' => 'buscaCidades(this.value)'));
				echo $this->Form->input('ClienteEndereco.cidade_id', array('class' => 'cidade col-md-4 col-md-offset-1', 'div' => false, 'empty' => 'Selecione uma Cidade'));
				echo '</div>';

				echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success btn-sm', 'div' => array('class' => 'col-md-12 form-group')));

			?>
	</div>
</div>