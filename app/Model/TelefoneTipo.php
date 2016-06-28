<?php
App::uses('AppModel', 'Model');


class TelefoneTipo extends AppModel {

	public $displayField = 'descricao';

	public $hasOne = array(
		'ClienteTelefone' => array(
			'foreign_key' => 'telefone_tipo_id'
		),
		'ContatoTelefone' => array(
			'foreign_key' => 'telefone_tipo_id'
		),
	);
}