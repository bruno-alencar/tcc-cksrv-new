<?php
App::uses('AppModel', 'Model');


class AtendimentoAgendamento extends AppModel {

	
	public $displayField = 'descricao';


	public $belongsTo = array(
		'Atendimento' => array(
			'foreign_key' => 'atendimento_id'
		),
		'AtendimentoServico' => array(
			'foreign_key' => 'atendimento_servico_id'
		),
		'Usuario' => array(
			'foreign_key' => 'usuario_id'
		),
	);
	
}