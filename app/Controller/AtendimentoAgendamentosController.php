<?php

class AtendimentoAgendamentosController extends AppController{

	public function beforeFilter(){
		$this->loadModel('Status');
	}

	public function add(){

		$this->layout = 'ajax';

		if($this->request->is('post') && $this->request->data){

			if($this->AtendimentoAgendamento->save($this->request->data)){
				$this->Session->setFlash('Agendamento salvo com sucesso!');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoAgendamento']['atendimento_id']));
			}
			else{
				$this->Session->setFlash('Não foi possível incluir o agendamento. Por gentileza, tente novamente.');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoAgendamento']['atendimento_id']));
			}
		}

		$this->set('agendamentos', $this->AtendimentoAgendamento->findAllByAtendimentoId($this->request->params['pass'][0]));

	}

	public function edit($atendimento_agendamento_id = null){

		$this->layout = 'ajax';

		if($this->request->is('put') && $this->request->data){

			if($this->AtendimentoAgendamento->save($this->request->data)){
				$this->Session->setFlash('Agendamento salvo com sucesso!', 'flash_success');
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('Não foi possível incluir o agendamento. Por gentileza, tente novamente.', 'flash_danger');
				return $this->redirect($this->referer());
			}
		}

		$this->request->data = $this->AtendimentoAgendamento->findById($atendimento_agendamento_id);
		$this->render('add');

	}

	public function add_observacao_servico(){

		$this->layout = false;

		if($this->request->is('post') && $this->request->data){

			if($this->AtendimentoAgendamento->save($this->request->data)){
				$this->Session->setFlash('Agendamento salvo com sucesso!');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoAgendamento']['atendimento_id'], 'servico_id' => $this->request->data['AtendimentoAgendamento']['atendimento_servico_id']));
			}
			else{
				$this->Session->setFlash('Não foi possível incluir o agendamento. Por gentileza, tente novamente.');
				return $this->redirect(array('controller' => 'atendimentos', 'action' => 'view', $this->request->data['AtendimentoAgendamento']['atendimento_id'], 'servico_id' => $this->request->data['AtendimentoAgendamento']['atendimento_servico_id']));
			}
		}

	}

	public function finalizar_agendamento($agendamento_id = null){

		$this->autoRender = false;

		if($this->request->is('post') && $this->request->is('ajax')){
			$this->AtendimentoAgendamento->id = $agendamento_id;
			$this->AtendimentoAgendamento->saveField('status_id', Status::FINALIZADO);
			$this->AtendimentoAgendamento->saveField('data_finalizacao', date('Y-m-d H:i:s'));
		}
	}

}

?>