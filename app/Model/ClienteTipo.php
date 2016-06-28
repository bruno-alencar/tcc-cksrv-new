<?php
App::uses('AppModel', 'Model');


class ClienteTipo extends AppModel {

	public $displayField = 'descricao';


	public $hasOne = array(
		'Cliente' => array(
			'foreign_key' => 'cliente_tipo_id'
		)
	);


	const PESSOAJURIDICA = 1;
	const PESSOAFISICA = 2;

}