<?php
App::uses('AppModel', 'Model');


class UsuarioPerfil extends AppModel {

	
	public $displayField = 'descricao';


	public $hasOne = array(
		'Usuario' => array(
			'foreign_key' => 'usuario_perfil_id'
		)
	);
}