<?php
App::uses('AppModel', 'Model');

class Servidor extends AppModel {

	public $validate = array(
		'host' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o Host.'
			),
			'between' => array(
            'rule' => array('between', 1, 20),
            'message' => 'Entre 1 e 20 caracteres'
            )
		),
		'ip' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o endereço IP.'
			),
			'between' => array(
            'rule' => array('between', 5, 20),
            'message' => 'Entre 5 e 20 caracteres'
            )
		),
		'usuario' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o usuário.'
			),
			'between' => array(
            'rule' => array('between', 5, 15),
            'message' => 'Entre 5 e 20 caracteres'
            )	
		),
		'senha' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira a senha.'
			),
			'between' => array(
            'rule' => array('between', 8, 15),
            'message' => 'Entre 8 e 20 caracteres'
            )	
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