<?php
App::uses('AppModel', 'Model');


class UsuarioGrupo extends AppModel {

	
	public $displayField = 'descricao';


	public $hasOne = array(
		'Usuario' => array(
			'foreign_key' => 'usuario_grupo_id'
		)
	);
}