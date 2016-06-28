<?php
App::uses('AppModel', 'Model');


class StatusAtendimento extends AppModel {

	
	public $displayField = 'descricao';


	public $hasOne = array(
		'Atendimento' => array(
			'foreign_key' => 'status_atendimento_id'
		)
	);
}