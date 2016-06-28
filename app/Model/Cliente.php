<?php
App::uses('AppModel', 'Model');


class Cliente extends AppModel {

	public $virtualFields = array(
	    'empresa' => 'CONCAT(Cliente.id, "-", Cliente.razao_social)'
	);

	public $belongsTo = array(
		'ClienteTipo' => array(
			'foreign_key' => 'cliente_tipo_id'
		),
	);

	public $hasOne = array(
		'Contato' => array(
			'foreign_key' => 'cliente_id'
		),
		'ClienteTelefone' => array(
			'foreign_key' => 'cliente_id'
		),
		'ClienteEmail' => array(
			'foreign_key' => 'cliente_id'
		),
		'ClienteEndereco' => array(
			'foreign_key' => 'cliente_id'
		),
	);
}
