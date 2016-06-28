<?php
App::uses('AppModel', 'Model');


class AtendimentoOrigem extends AppModel {

	
	public $displayField = 'descricao';


	public $hasOne = array(
		'Atendimento' => array(
			'foreign_key' => 'atendimento_origem_id'
		)
	);
	
}