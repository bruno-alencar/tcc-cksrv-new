<?php

class ClientesController extends AppController{

	public function beforeFilter() {       
		$this->loadModel('ClienteTipo');
		$this->loadModel('ClienteCnl');
		$this->loadModel('ClienteIl');
		$this->loadModel('Estado');
		$this->loadModel('EnderecoTipo');
		$this->loadModel('TelefoneTipo');
		$this->loadModel('ClienteTelefone');
		$this->loadModel('ClienteEmail');
		$this->loadModel('ClienteEndereco');
		$this->loadModel('Contato');
		$this->loadModel('ContatoCargo');
		$this->loadModel('Sexo');
		$this->loadModel('Cidade');
	}

	public function index(){
		$this->Cliente->recursive = -1;
		$clientes = $this->Cliente->find('all');

		$this->set(compact('clientes'));
	}

	public function add($tipo_pessoa = null, $cliente = null){

		if ($this->request->is('post') && $this->request->data) {

			if($this->Cliente->findByCpfCnpj($this->request->data['Cliente']['cpf_cnpj'])){
				$this->Session->setFlash('Já existe uma empresa cadastrada com o CPF/CNPJ informado', 'flash_danger');
				return $this->redirect(array('action' => 'index'));
			}

			if ($this->Cliente->saveAssociated($this->request->data)) {
				$this->Session->setFlash('Cliente adicionado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->Cliente->id));
			} else {
				$this->Session->setFlash('Não foi possível registrar os dados do usuário.', 'flash_danger');
			}
		}

		$estados = $this->Estado->find('list');

		$this->set(compact('tipo_pessoa', 'cliente', 'estados'));

	}

	public function busca_cliente_base_cnl_il(){
		$this->autoRender = false;

		$cliente['conlicitacao'] = $this->ClienteCnl->findByCnpj($_POST['cnpj']);
		$cliente['instituto'] = $this->ClienteIl->findByCnpj($_POST['cnpj']);

		return json_encode($cliente, true);
	}

	public function view($cliente_id){
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cliente->save($this->request->data)) {

				$this->Session->setFlash('Cliente atualizado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Não foi possível atualizar os dados do cliente.', 'flash_danger');
			}
		}

		$this->Cliente->id = $cliente_id;
		$this->request->data = $this->Cliente->read();

		$telefones = $this->ClienteTelefone->findAllByClienteIdAndStatusId($cliente_id, 1);
		$emails = $this->ClienteEmail->findAllByClienteIdAndStatusId($cliente_id, 1);
		$contatos = $this->Contato->findAllByClienteIdAndStatusId($cliente_id, 1);
		$enderecos = $this->ClienteEndereco->findAllByClienteIdAndStatusId($cliente_id, 1);
		
		$this->set(compact('telefones', 'emails', 'contatos', 'enderecos')); 
	}


// Crud - Contato_Cliente

	public function add_contato($cliente_id = null){
		$this->layout = false;

		if ($this->request->is('post') && $this->request->data) {
			if ($this->Contato->save($this->request->data)) {
				$this->Session->setFlash('Contato cadastrado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['Contato']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível cadastrar este contato.', 'flash_danger');
			}
		}

		$sexos = $this->Sexo->find('list');
		$contatoCargos = $this->ContatoCargo->find('list');
		$telefoneTipos = $this->TelefoneTipo->find('list');

		$this->set(compact('cliente_id', 'sexos', 'contatoCargos', 'telefoneTipos'));
	}

	public function edit_contato($contato_id){
		$this->layout = false;

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contato->save($this->request->data)) {
				$this->Session->setFlash('Contato atualizado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['Contato']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível atualizar este contato.', 'flash_danger');
			}
		}

		$this->Contato->id = $contato_id;
		$this->request->data = $this->Contato->read();

		$sexos = $this->Sexo->find('list');
		$contatoCargos = $this->ContatoCargo->find('list');
		$this->set(compact('sexos', 'contatoCargos'));

		$this->render('add_contato');
	}

	public function desativa_contato_cliente($contato_id){
		$this->autoRender = false;

		$this->Contato->id = $contato_id;
		$contato = $this->Contato->read();

		$this->Contato->saveField('status_id', 0);
	}



// Crud - E-mail_Cliente

	public function add_email($cliente_id = null){
		$this->layout = false;

		if ($this->request->is('post') && $this->request->data) {
			if ($this->ClienteEmail->save($this->request->data)) {
				$this->Session->setFlash('E-mail cadastrado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['ClienteEmail']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível cadastrar este e-mail.', 'flash_danger');
			}
		}

		$this->set(compact('cliente_id'));
	}

	public function edit_email($email_cliente_id){
		$this->layout = false;
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClienteEmail->save($this->request->data)) {
				$this->Session->setFlash('E-mail atualizado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['ClienteEmail']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível atualizar este e-mail.', 'flash_danger');
			}
		}

		$this->ClienteEmail->id = $email_cliente_id;
		$this->request->data = $this->ClienteEmail->read();

		$this->render('add_email');
	}

	public function desativa_email_cliente($email_cliente_id){
		$this->autoRender = false;

		$this->ClienteEmail->id = $email_cliente_id;
		$cliente_email = $this->ClienteEmail->read();

		$this->ClienteEmail->saveField('status_id', 0);
	}


// Crud - Telefone_Cliente

	public function add_telefone($cliente_id = null){
		$this->layout = false;
		
		if ($this->request->is('post') && $this->request->data) {
			if ($this->ClienteTelefone->save($this->request->data)) {
				$this->Session->setFlash('Telefone cadastrado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['ClienteTelefone']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível cadastrar este telefone.', 'flash_danger');
			}
		}

		$telefoneTipos = $this->TelefoneTipo->find('list');
		$this->set(compact('cliente_id', 'telefoneTipos'));
	}
	
	public function edit_telefone($telefone_cliente_id){
		$this->layout = false;
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClienteTelefone->save($this->request->data)) {
				$this->Session->setFlash('Telefone atualizado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['ClienteTelefone']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível atualizar este telefone.', 'flash_danger');
			}
		}

		$this->ClienteTelefone->id = $telefone_cliente_id;
		$this->request->data = $this->ClienteTelefone->read();

		$telefoneTipos = $this->TelefoneTipo->find('list');
		$this->set(compact('telefoneTipos'));

		$this->render('add_telefone');
	}

	public function desativa_telefone_cliente($telefone_cliente_id){
		$this->autoRender = false;

		$this->ClienteTelefone->id = $telefone_cliente_id;
		$cliente_telefone = $this->ClienteTelefone->read();

		$this->ClienteTelefone->saveField('status_id', 0);
	}


// Crud - Endereco_Cliente

	public function add_endereco($cliente_id = null){
		$this->layout = false;

		if ($this->request->is('post') && $this->request->data) {
			if ($this->ClienteEndereco->save($this->request->data)) {
				$this->Session->setFlash('Endereço cadastrado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['ClienteEndereco']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível cadastrar este telefone.', 'flash_danger');
			}
		}

		$estados = $this->Estado->find('list');
		$enderecoTipos = $this->EnderecoTipo->find('list');

		$this->set(compact('cliente_id', 'estados', 'enderecoTipos')); 
	}

	public function edit_endereco($endereco_cliente_id){
		$this->layout = false;
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClienteEndereco->save($this->request->data)) {
				$this->Session->setFlash('Telefone atualizado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['ClienteEndereco']['cliente_id']));
			} else {
				$this->Session->setFlash('Não foi possível atualizar este telefone.', 'flash_danger');
			}
		}

		$this->ClienteEndereco->id = $endereco_cliente_id;
		$this->request->data = $this->ClienteEndereco->read();

		$cidades = $this->Cidade->find('list');
		$enderecoTipos = $this->EnderecoTipo->find('list');
		$this->set(compact('enderecoTipos',  'cidades'));

		$this->render('add_endereco');
	}



	public function desativa_endereco_cliente($endereco_cliente_id){
		$this->autoRender = false;

		$this->ClienteEndereco->id = $endereco_cliente_id;
		$cliente_endereco = $this->ClienteEndereco->read();

		$this->ClienteEndereco->saveField('status_id', 0);
	}


// Autocomplete add atendimento
	function autocomplete_empresas(){

		$this->autoRender = false;
		$this->layout = 'ajax';

		if($_GET['term'] && $this->request->is('ajax')){

			$clientes = $this->Cliente->find('list', array('fields' => array('Cliente.empresa'), 'conditions' => array('OR' => array('Cliente.razao_social LIKE' => '%'.$_GET['term'].'%', 'Cliente.nome_fantasia LIKE' => '%'.$_GET['term'].'%'))));

			echo json_encode($clientes);

		}
	}

	function carrega_contatos($cliente_id){

		$this->autoRender = false;
		$this->layout = 'ajax';

		if(is_numeric($cliente_id) && $this->request->is('ajax')){

			$contatos = $this->Contato->find('list', array('fields' => array('Contato.id', 'Contato.nome'), 'conditions' => array('Contato.cliente_id' => $cliente_id)));

			echo json_encode($contatos);

		}

	}

}
