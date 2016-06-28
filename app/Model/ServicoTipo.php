<?php
App::uses('AppModel', 'Model');


class ServicoTipo extends AppModel {

	
	public $displayField = 'descricao';


	public $hasMany = array(
		'AtendimentoServico' => array(
			'foreign_key' => 'servico_tipo_id'
		)
	);
}