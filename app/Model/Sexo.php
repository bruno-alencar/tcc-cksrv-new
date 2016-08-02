<?php
App::uses('AppModel', 'Model');


class Sexo extends AppModel {

	public $useTable = 'sexos';
	public $displayField = 'descricao';


	public $hasOne = array(
		'Usuario' => array(
			'foreign_key' => 'sexo_id'
		),
		'Contato' => array(
			'foreign_key' => 'sexo_id'
		),
	);
}
?>