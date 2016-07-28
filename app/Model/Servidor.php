<?php
App::uses('AppModel', 'Model');

class Servidor extends AppModel {

	public $validate = array(
		'host' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o Host.'
			)
		),
		'ip' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o endereço IP.'
			)
		),
		'usuario' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o usuário.'
			)
		),
		'senha' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira a senha.'
			)
		),
		'detalhes_so' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o Sistema Operacional.'
			)
		),
	);
	
}

?>