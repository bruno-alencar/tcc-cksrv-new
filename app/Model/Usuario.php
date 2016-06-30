<?php
App::uses('AppModel', 'Model');


class Usuario extends AppModel {


	// public $validate = array(
	// 	'nome' => array(
	// 		'notBlank' => array(
	// 			'rule' => 'notBlank',
	// 			'message' => 'Insira o seu nome.'
	// 		)
	// 	)
	// );




	public $belongsTo = array(
		'Sexo' => array(
			'foreign_key' => 'sexo_id'
		),
		'Perfil' => array(
			'foreign_key' => 'perfil_id'
		)
	);
}