<?php
App::uses('AppModel', 'Model');


class ClienteTelefone extends AppModel {


	public $belongsTo = array(
		'TelefoneTipo' => array(
			'foreign_key' => 'telefone_tipo_id'
		)
	);

}