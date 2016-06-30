<?php
App::uses('AppModel', 'Model');


class Perfil extends AppModel {

	public $useTable = 'perfis';
	public $displayField = 'descricao';


	public $hasOne = array(
		'Usuario' => array(
			'foreign_key' => 'perfil_id'
		)
	);
}