<?php
App::uses('AppModel', 'Model');


class AtendimentoServico extends AppModel {

	public $belongsTo = array(
		'Usuario' => array(
			'foreign_key' => 'usuario_id'
		),
		'UsuarioGrupo' => array(
			'foreign_key' => 'usuario_grupo_id'
		),
		'Atendimento' => array(
			'foreign_key' => 'atendimento_id'
		),
		'ServicoTipo' => array(
			'foreign_key' => 'servico_tipo_id'
		),
		'StatusServico' => array(
			'foreign_key' => 'status_servico_id'
		),
		'Status' => array(
			'foreign_key' => 'status_id'
		),
	);
}