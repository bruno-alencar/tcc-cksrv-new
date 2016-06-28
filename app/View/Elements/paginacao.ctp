	<?php
	if($conteudo){
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages} | Total: {:count} Registros')
	));
	?>	
	</p>
	<div class="text-center">
		<div class="btn-group">
	<?php
		echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array(), null, array('class' => 'prev disabled btn btn-white', 'escape' => false));
		echo '&nbsp;';
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-white'));
		echo '&nbsp;';
		echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array(), null, array('class' => 'next disabled btn btn-white', 'escape' => false));
	}
	?>
		</div>
	</div>