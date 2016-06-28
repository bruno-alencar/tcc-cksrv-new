<?php
App::uses('AppModel', 'Model');


class AtendimentoObservacao extends AppModel {

	
	public $displayField = 'observacao';


	public $belongsTo = array(
		'Atendimento' => array(
			'foreign_key' => 'atendimento_id',
			'order' => 'AtendimentoObservacao.created desc'
		),
		'Usuario' => array(
			'foreign_key' => 'usuario_id'
		),
		'ObservacaoTipo' => array(
			'foreign_key' => 'observacao_tipo_id'
		),		
	);
	
}