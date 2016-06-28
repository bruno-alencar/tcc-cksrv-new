<?php

class AtendimentoServicosController extends AppController{

	public function beforeFilter(){
		$this->loadModel('ServicoTipo');
	}

	public function add(){
		$this->layout = false;

		if($this->request->is('post') && $this->request->data){
			if($this->AtendimentoServico->save($this->request->data)){
				$this->Session->setFlash('Serviço salvo com sucesso!', 'flash_success');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoServico']['atendimento_id'],'servico_id:'.$this->AtendimentoServico->id));
			}
			else
				$this->Session->setFlash('Não foi possível incluir o Serviço. Por gentileza, tente novamente.', 'flash_danger');
		}

		$this->set('servico_tipos', $this->ServicoTipo->find('list'));

	}

	public function view($id = null){
		$this->AtendimentoServico->id = $id;
		$atendimento = $this->AtendimentoServico->read();

		$this->set(compact('atendimento'));

	}

	public function altera_status_servico($servico_id, $novo_status_id){

		$this->autoRender = false;

		if($this->request->is('post') && $this->request->is('ajax') && $servico_id && $novo_status_id){
			$this->AtendimentoServico->id = $servico_id;
			$this->AtendimentoServico->saveField('status_servico_id', $novo_status_id);
		}
	}

}

?>