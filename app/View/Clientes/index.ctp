<?php echo $this->Session->flash(); ?>

<br>
<?= $this->Html->link("Novo cliente PJ", array('controller' => 'clientes' ,'action' => 'add', ClienteTipo::PESSOAJURIDICA), array('class' => 'btn btn-success', 'style' => 'margin-left:20px;')) ?>
<?= $this->Html->link("Novo cliente PF", array('controller' => 'clientes' ,'action' => 'add', ClienteTipo::PESSOAFISICA), array('class' => 'btn btn-success', 'style' => 'margin-left:20px;')) ?>
<br><br>
<div class="white-bg">
	<table class="table table-striped table-hover">
		<tr>
			<th>#</th>
			<th>Razão Social / Nome</th>
			<th>Nome Fantasia</th>
			<th>CNPJ / CPF</th>
			<th>Site</th>
			<th>Controle CNL</th>
			<th>Controle IL</th>
		</tr>

		

		<?php
		foreach ($clientes as $c) {
			echo '<tr data-href="'.$this->Html->url(array('controller' => 'clientes', 'action' => 'view', $c['Cliente']['id'])).'">';
				echo '<td>'.$c['Cliente']['id'].'</td>';
				echo '<td>'.$c['Cliente']['razao_social'].'</td>';
				echo '<td>'.$c['Cliente']['nome_fantasia'].'</td>';
				echo '<td>'.$c['Cliente']['cpf_cnpj'].'</td>';
				echo '<td>'.$c['Cliente']['site'].'</td>';
				echo '<td>'.$c['Cliente']['controle_cnl'].'</td>';
				echo '<td>'.$c['Cliente']['controle_il'].'</td>';
			echo '</tr>';
		}
		?>
	</table>
</div>