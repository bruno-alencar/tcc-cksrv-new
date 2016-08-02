<?php
App::uses('AppModel', 'Model');


class TipoServico extends AppModel {

	public $displayField = 'servico';


	public $hasOne = array(
		'Servico' => array(
			'foreign_key' => 'tipo_servico_id'
		)
	);
}
?>