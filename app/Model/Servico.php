<?php
App::uses('AppModel', 'Model');

class Servico extends AppModel {

	public $belongsTo = array(
		'Servidor' => array(
			'foreign_key' => 'servidor_id'
		)
	);
	
}
?>

