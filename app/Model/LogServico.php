<?php
App::uses('AppModel', 'Model');

class LogServico extends AppModel {

	public $belongsTo = array(
		'Servico' => array(
			'foreign_key' => 'id'
		)
	);
	
	
}
?>