<?php
App::uses('AppModel', 'Model');


class Contato extends AppModel {

	public $belongsTo = array(
		'Cliente' => array(
			'foreign_key' => 'cliente_id'
		),
		'ContatoCargo' => array(
			'foreign_key' => 'contato_cargo_id'
		),
		'Sexo' => array(
			'foreign_key' => 'sexo_id'
		)
	);
}