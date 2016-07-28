<?php
App::uses('AppModel', 'Model');


class Usuario extends AppModel {


	public $validate = array(
		'login' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o Login.'
			)
		),
		'senha' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira a senha.'
			)
		),
		'nome' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o nome.'
			)
		),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o e-mail.'
			)
		),
		'celular' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o celular.'
			)
		),
		'sexo_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Selecione um sexo.'
			)
		),
		'perfil_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Selecione um perfil.'
			)
		),
	);



	public $belongsTo = array(
		'Sexo' => array(
			'foreign_key' => 'sexo_id'
		),
		'Perfil' => array(
			'foreign_key' => 'perfil_id'
		)
	);
}