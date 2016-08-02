<?php
App::uses('AppModel', 'Model');


class Status extends AppModel {

	
	public $displayField = 'descricao';

	const INATIVO = 0;
	const ATIVO = 1;
	const FINALIZADO = 2;

}
?>