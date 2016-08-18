<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(	 
	        'loginAction' => array(
	            'controller' => 'usuarios',
	            'action' => 'login'
	        ),
	        'loginRedirect' => array('controller' => 'monitoramento', 'action' => 'index'),
			'authError'=>'Você tem permissão para acessar esta página?',
			'authenticate' => array(
			    'Form' => array(
			    	'userModel' => 'Usuario',
			        'fields' => array('username'=>'login', 'password' => 'senha')
			    )
			)
    	)
	);
}

function dataBr($data){
	if(strlen($data) == 19)
		return date('d/m/Y H:i', strtotime($data));
	else
		return date('d/m/Y', strtotime($data));
}

function horaBr($data){
		return date('H:i', strtotime($data));
}

function diaBr($data){
		return date('d/m/Y', strtotime($data));
}

function dataCompletaBr($data){
	if(strlen($data) == 19)
		return date('d/m/Y H:i:s', strtotime($data));
	else
		return date('d/m/Y', strtotime($data));
}
