<?php
App::uses('AppModel', 'Model');


class ContatoCargo extends AppModel {

	public $displayField = 'descricao';
	
	public $belongsTo = array(
		'Contato' => array(
			'foreign_key' => 'contato_cargo_id'
		)
	);
}