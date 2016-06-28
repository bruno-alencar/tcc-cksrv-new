<?php
App::uses('AppModel', 'Model');


class EnderecoTipo extends AppModel {

	public $displayField = 'descricao';

	public $hasOne = array(
		'ClienteEndereco' => array(
			'foreign_key' => 'endereco_tipo_id'
		)
	);

}