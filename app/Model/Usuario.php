<?php
App::uses('AppModel', 'Model');


class Usuario extends AppModel {


	public $validate = array(
		'login' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o Login.'
			),
            'between' => array(
                'rule' => array('between', 8, 10),
            'message' => 'Entre 8 e 10 caracteres'
            )
		),
		'senha' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira a senha.'
			),
			'between' => array(
                'rule' => array('between', 8, 10),
            'message' => 'Entre 8 e 10 caracteres'
            )
		),
		'nome' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o nome.'
			),
			//'rule' => array('minLength', 8),
            //'message' => 'Minimo de 8 caracteres'
            'between' => array(
                'rule' => array('between', 8, 30),
            'message' => 'Entre 8 e 30 caracteres'
            )
		),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o e-mail.'
			),
			'rule' => 'email',
			'message' => 'Insira um e-mail válido.'
		),
		'celular' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o celular.'
			),
			'between' => array(
            'rule' => array('between', 8, 9),
            'message' => 'Entre 8 e 9 caracteres'
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
?>