<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class AtendimentosController extends AppController{

	public function beforeFilter() {
		$this->loadModel('AtendimentoAgendamento');
		$this->loadModel('AtendimentoObservacao');
		$this->loadModel('AtendimentoOrigem');
		$this->loadModel('AtendimentoServico');
		$this->loadModel('Cliente');
		$this->loadModel('Anexo');
		$this->loadModel('ClienteEndereco');
		$this->loadModel('StatusAtendimento');
		$this->loadModel('StatusServico');
		$this->loadModel('Usuario');
		$this->loadModel('UsuarioGrupo');
	}

	public function index(){

		$grupos = $this->UsuarioGrupo->find('list');
		$status_atendimentos = $this->StatusAtendimento->find('list');
		$usuarios = $this->Usuario->find('list', array('fields' => array('id', 'nome_consultor')));

		if($this->request->data){
			foreach($this->request->data as $model => $value) {
				foreach ($this->request->data[$model] as $key => $value) {
					if (empty($this->request->data[$model][$key]))
						unset($this->request->data[$model][$key]);
				}
			}
			$conditions = $this->postConditions($this->request->data, array('razao_social' => 'LIKE'));
			$resultado_busca = $this->Atendimento->find('all', compact('conditions'));;
		}else
			$resultado_busca = $this->Atendimento->find('all');

		$this->set(compact('grupos', 'status_atendimentos', 'usuarios', 'resultado_busca'));
	}
	
	public function dashboard(){
		$agendamentos = $this->AtendimentoAgendamento->find('all', array('conditions' => array('AtendimentoAgendamento.usuario_id' => AuthComponent::user('id'), 'date_format(AtendimentoAgendamento.data_agendamento, "%Y-%m-%d")' => date('Y-m-d'), 'AtendimentoAgendamento.data_finalizacao' => NULL), 'order' => 'data_agendamento asc'));

		$this->set(compact('agendamentos'));
	}

	public function add(){
		$this->layout = false;

		if($this->request->is('post') && $this->request->data){
			if($this->Atendimento->save($this->request->data)){
				$this->Session->setFlash('Atendimento salvo com sucesso!', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->Atendimento->id));
			}
			else
				$this->Session->setFlash('Não foi possível incluir o Atendimento. Por gentileza, tente novamente.', 'flash_danger');
		}

	}

	public function view($id = null){

		$this->Atendimento->id = $id;

		$atendimento = $this->Atendimento->read();
		$cliente = $this->Cliente->findById($atendimento['Atendimento']['cliente_id']);
		$cliente_endereco = $this->ClienteEndereco->findByClienteIdAndEnderecoTipoId($atendimento['Atendimento']['cliente_id'], ClienteEndereco::MATRIZ);
		$servicos = $this->AtendimentoServico->findAllByAtendimentoId($id);
		
		$status_atendimentos = $this->StatusAtendimento->find('list');
		$status_servicos = $this->StatusServico->find('list');

		if(isset($this->request->named['servico_id'])){
			$servico_atual = $this->AtendimentoServico->findById($this->request->named['servico_id']);
			$observacoes = $this->AtendimentoObservacao->findAllByAtendimentoIdAndAtendimentoServicoId($id, $this->request->named['servico_id']);
			$arquivos = $this->Anexo->findAllByAtendimentoIdAndAtendimentoServicoId($id, $this->request->named['servico_id']);
		}
		else{
			$observacoes = $this->AtendimentoObservacao->findAllByAtendimentoId($id);
			$arquivos = $this->Anexo->findAllByAtendimentoId($id);
		}

		$this->set(compact('atendimento', 'cliente', 'cliente_endereco', 'servicos', 'status_servicos', 'status_atendimentos', 'servico_atual', 'observacoes', 'arquivos'));

	}

	public function altera_status_atendimento($atendimento_id, $novo_status_id){

		$this->autoRender = false;

		if($this->request->is('post') && $this->request->is('ajax') && $atendimento_id && $novo_status_id){
			$this->Atendimento->id = $atendimento_id;
			$this->Atendimento->saveField('status_atendimento_id', $novo_status_id);
		}
	}

}

?>