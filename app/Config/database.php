<?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '127.0.0.1',
		'login' => 'root',
		'password' => '4334N@k0N',
		'database' => 'juridico',
		'prefix' => '',
		'encoding' => 'utf8',
	);

	public $controle_cnl = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '192.168.1.35',
		'login' => 'rubens',
		'password' => 'pereira',
		'database' => 'controle',
		'prefix' => '',
		'encoding' => 'utf8',
	);

	public $controle_il = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '192.168.1.35',
		'login' => 'rubens',
		'password' => 'pereira',
		'database' => 'instituto_licitar',
		'prefix' => '',
		'encoding' => 'utf8',
	);
}
