<?php

class AtendimentoObservacoesController extends AppController{

	public function beforeFilter(){
		$this->loadModel('ObservacaoTipo');
	}


	public function add(){

		$this->layout = false;

		if($this->request->is('post') && $this->request->data){

			if($this->AtendimentoObservacao->save($this->request->data)){
				$this->Session->setFlash('Observação salva com sucesso!', 'flash_success');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoObservacao']['atendimento_id']));
			}
			else{
				$this->Session->setFlash('Não foi possível incluir a observação. Por gentileza, tente novamente.', 'flash_danger');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoObservacao']['atendimento_id']));
			}
		}

	}

	public function add_observacao_servico(){

		$this->layout = false;

		if($this->request->is('post') && $this->request->data){

			if($this->AtendimentoObservacao->save($this->request->data)){
				$this->Session->setFlash('Observação salva com sucesso!', 'flash_success');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoObservacao']['atendimento_id'], 'servico_id' => $this->request->data['AtendimentoObservacao']['atendimento_servico_id']));
			}
			else{
				$this->Session->setFlash('Não foi possível incluir a observação. Por gentileza, tente novamente.', 'flash_danger');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoObservacao']['atendimento_id'], 'servico_id' => $this->request->data['AtendimentoObservacao']['atendimento_servico_id']));
			}
		}

		$observacao_tipos = $this->ObservacaoTipo->find('list');

		$this->set(compact('observacao_tipos'));

	}

}

?>