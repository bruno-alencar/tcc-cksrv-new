<?php 
class ServidoresController extends AppController {

	public function beforeFilter() {      
		// Load no model
		$this->loadModel('Servico');
		$this->loadModel('TipoServico');
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

			$servidores = $this->Servidor->findAllByIp($this->request->data['Servidor']['ip']);
			if(!empty($servidores)){
				$this->Session->setFlash('IP já existente', 'flash_danger');
			}
			else {
				
				if ($this->Servidor->save($this->request->data['Servidor'])) {

					$this->request->data['Servico']['servidor_id'] = $this->Servidor->id;
					$server = $this->Servidor->findById($this->Servidor->id);
					$this->request->data['Servico']['ip'] = $server['Servidor']['ip'];
					$this->Servico->save($this->request->data['Servico']);

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

		// Busca todos os tipos de servico cadastrado
		$tipoServicoTmp = $this->TipoServico->find('all');

		// Faz um foreach que passa um a um
		foreach ($tipoServicoTmp as $t) {
			// Atribui o id do tipo servico ao indice
			$tipoServico[$t['TipoServico']['id']] = $t;
		}

		// define id para servidor
		$this->Servidor->id = $servidor_id;
		// busca dados e joga na view
		$this->request->data = $this->Servidor->read();
		$this->set(compact('tipoServico')); 
	}

	public function admin_altera_status_servidor_ativo_inativo($servidor_id){
		// Evita que o layout seja carregado
		$this->autoRender = false;

		// define id para servidor
		$this->Servidor->id = $servidor_id;
		// busca dados e joga na view
		$server = $this->Servidor->read();

		// Executa ternario com o status do servidor e atribui a uma váriavel que define ativo ou nao
		$ativar_desativar = $server['Servidor']['status_id'] == 1 ? 0 : 1;
		// salva apenas o campo status
		$this->Servidor->saveField('status_id', $ativar_desativar);
	}
}
?>