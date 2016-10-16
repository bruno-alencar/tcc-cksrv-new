<?php
App::uses('AppModel', 'Model');

class Servidor extends AppModel {

	public $validate = array(
		'host' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o Host.'
			),
			'rule' => array('minLength', 5),
            'message' => 'Minimo 5 caracteres'

		),
		'ip' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o endereço IP.'
			),
			'rule' => array('minLength', 5),
            'message' => 'Minimo 5 caracteres'

		),
		'usuario' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o usuário.'
			),
			'rule' => array('minLength', 5),
            'message' => 'Minimo 5 caracteres'

		),
		'senha' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira a senha.'
			),
			'rule' => array('minLength', 5),
            'message' => 'Minimo 5 caracteres'
            
		),
		'detalhes_so' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o Sistema Operacional.'
			)
		),
	);
	
	public $hasMany = array(
		'Servico' => array(
			'foreign_key' => 'servidor_id'
		)
	);
}
?>