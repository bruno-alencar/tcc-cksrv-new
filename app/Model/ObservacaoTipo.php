<?php
App::uses('AppModel', 'Model');


class ObservacaoTipo extends AppModel {

	
	public $displayField = 'descricao';


	public $hasMany = array(
		'AtendimentoObservacao' => array(
			'foreign_key' => 'observacao_tipo_id'
		)
	);
}