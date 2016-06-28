<?php
App::uses('AppController', 'Controller');


class CidadesController extends AppController {


	public $components = array('Paginator');


	public function busca($id = null){

		$this->autoRender = false;

		$options = array('conditions' => array('estado_id'=>$id));
		$cidades = $this->Cidade->find('list',$options);

		$cidades = json_encode($cidades);
		echo $cidades;
	}
}