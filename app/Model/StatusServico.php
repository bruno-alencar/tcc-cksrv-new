<?php
App::uses('AppModel', 'Model');


class StatusServico extends AppModel {

	
	public $displayField = 'descricao';


	public $hasOne = array(
		'AtendimentoServico' => array(
			'foreign_key' => 'status_servico_id'
		)
	);
}