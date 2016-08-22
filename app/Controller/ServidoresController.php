<?php 
class ServidoresController extends AppController {

	public function beforeFilter() {      
		// Load no model
		$this->loadModel('Servicos');
	}

	public function admin_index(){
		// Busca todos os servidores
		$servidores = $this->Servidor->find('all');

		// Joga a variavel na view
		$this->set(compact('servidores'));
	}



	public function admin_add(){
		// Entra caso seja post
		if ($this->request->is('post') && $this->request->data) {
			// Salva dos dados do servidor
			if ($this->Servidor->save($this->request->data)) {
				// Exibe mensagem de sucesso
				$this->Session->setFlash('Servidor adicionado com sucesso.', 'flash_success');
				// Redireciona para a view
				return $this->redirect(array('action' => 'view', $this->Servidor->id));
			} else {
				// Exibe mensagem de erro
				$this->Session->setFlash('Não foi possível registrar os dados do servidor.', 'flash_danger');
			}
		}
	}

	public function admin_view($servidor_id = null){
		// Entra caso seja post
		if ($this->request->is(array('post', 'put'))) {
			// Salva os dados do servidor
			if ($this->Servidor->save($this->request->data['Servidor'])) {
				// Exibe mensagem de sucesso
				$this->Session->setFlash('Servidor atualizado com sucesso.', 'flash_success');
				// redireciona para a index
				return $this->redirect(array('action' => 'index'));
			} else {
				// exibe mensagem de erro
				$this->Session->setFlash('Não foi possível atualizar os dados do servidor.', 'flash_danger');
			}
		}
		// define id para servidor
		$this->Servidor->id = $servidor_id;
		// busca dados e joga na view
		$this->request->data = $this->Servidor->read();
	}

	public function admin_altera_status_servidor_ativo_inativo($servidor_id){
		// Evita que o layout seja carregado
		$this->autoRender = false;

		// define id para servidor
		$this->Servidor->id = $servidor_id;
		// busca dados e joga na view
		$usuario = $this->Servidor->read();

		$ativar_desativar = $usuario['Servidor']['status_id'] == 1 ? 0 : 1;
		// salva apenas o campo status
		$this->Servidor->saveField('status_id', $ativar_desativar);
	}
}
?>