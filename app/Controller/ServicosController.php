<?php 
class ServicosController extends AppController {

	public function beforeFilter(){

		// Carrega a model
		$this->loadModel('Servidores');
		$this->loadModel('TipoServico');

	}

	public function admin_add($servidor_id){
		// Não deixa carregar o layout default
		$this->layout = false;

		// busca os dados do servidor pelo id
		$servidor = $this->Servidores->findById($servidor_id);

		// Traz um array de tipo serviços pronto para um select
		$tipoServicos = $this->TipoServico->find('list', array('conditions' => 'TipoServico.id > 1'));

		// Caso for post
		if ($this->request->is('post') && $this->request->data) {
			// Salva os dados do serviço
			if ($this->Servico->save($this->request->data)) {
				// Exibe mensagem de sucesso
				$this->Session->setFlash('Servico adicionado com sucesso.', 'flash_success');
				// redireciona para a view da controller servidores
				return $this->redirect(array('controller' => 'servidores', 'action' => 'view', $this->request->data['Servico']['servidor_id']));
			} else {
				// Exibe menssagem de erro
				$this->Session->setFlash('Não foi possível registrar os dados do servico.', 'flash_danger');
			}
		}
		// Joga as variaveis na view
		$this->set(compact('tipoServicos', 'servidor'));
	}

}
?>