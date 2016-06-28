<?php
App::uses('AppModel', 'Model');


class Usuario extends AppModel {


	public $validate = array(
		'nome_completo' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o seu nome.'
			)
		),
		'nome_consultor' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Insira o seu nome de Consultor.'
			)
		),
	);




	public $belongsTo = array(
		'Sexo' => array(
			'foreign_key' => 'sexo_id'
		),
		'UsuarioPerfil' => array(
			'foreign_key' => 'usuario_perfil_id'
		),
		'UsuarioGrupo' => array(
			'foreign_key' => 'usuario_grupo_id'
		),
		'UsuarioCargo' => array(
			'foreign_key' => 'usuario_cargo_id'
		)
	);

	public $hasMany = array(
		'AtendimentoObservacao' => array(
			'foreign_key' => 'usuario_id'
		),
	);

}