<?php
App::uses('AppModel', 'Model');


class Atendimento extends AppModel {

	public $belongsTo = array(
		'Cliente' => array(
			'foreign_key' => 'cliente_id'
		),
		'Usuario' => array(
			'foreign_key' => 'usuario_id'
		),
		'UsuarioGrupo' => array(
			'foreign_key' => 'usuario_grupo_id'
		),
		'StatusAtendimento' => array(
			'foreign_key' => 'status_atendimento_id'
		),
		'Status' => array(
			'foreign_key' => 'status_id'
		),
	);

	public $hasMany = array(
		'AtendimentoObservacao' => array(
			'foreign_key' => 'atendimento_id',
			'order' => 'AtendimentoObservacao.created desc'
		),
		'AtendimentoServico' => array(
			'foreign_key' => 'atendimento_id',
		),
	);
}