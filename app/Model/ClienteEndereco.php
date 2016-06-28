<?php
App::uses('AppModel', 'Model');

class ClienteEndereco extends AppModel {

	const MATRIZ = 1;
	const FILIAL = 2;

	public $belongsTo = array(
		'Cliente' => array(
			'foreign_key' => 'cliente_id'
		),		
		'Cidade' => array(
			'foreign_key' => 'cidade_id'
		),
		'EnderecoTipo' => array(
			'foreign_key' => 'endereco_tipo_id'
		),
	);

}