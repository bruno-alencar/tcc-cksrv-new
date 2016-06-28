<?php
App::uses('AppModel', 'Model');


class UsuarioCargo extends AppModel {

	
	public $displayField = 'descricao';


	public $hasOne = array(
		'Usuario' => array(
			'foreign_key' => 'usuario_cargo_id'
		)
	);
}