<?php
App::uses('AppModel', 'Model');


class ClienteCnl extends AppModel {

	public $useDbConfig = 'controle_cnl';
	public $useTable = 'clientes';

	public $virtualFields = array(
	    'empresa' => 'CONCAT(ClienteCnl.id, " - ",ClienteCnl.razao_social)'
	);

}