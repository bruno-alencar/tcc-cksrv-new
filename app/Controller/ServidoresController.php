<?php 
class ServidoresController extends AppController {

	// public function beforeFilter() {       

	// }

	public function admin_index(){
		$servidores = $this->Servidor->find('all');

		$this->set(compact('servidores'));
	}



	public function admin_add(){
		if ($this->request->is('post') && $this->request->data) {
			if ($this->Servidor->save($this->request->data)) {
				$this->Session->setFlash('Servidor adicionado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->Servidor->id));
			} else {
				$this->Session->setFlash('Não foi possível registrar os dados do servidor.', 'flash_danger');
			}
		}
	}

	public function admin_view($servidor_id = null){
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Servidor->save($this->request->data['Servidor'])) {

				$this->Session->setFlash('Servidor atualizado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Não foi possível atualizar os dados do servidor.', 'flash_danger');
			}
		}
		$this->Servidor->id = $servidor_id;
		$this->request->data = $this->Servidor->read();
	}

	public function admin_altera_status_servidor_ativo_inativo($servidor_id){
		$this->autoRender = false;

		$this->Servidor->id = $servidor_id;
		$usuario = $this->Servidor->read();

		$ativar_desativar = $usuario['Servidor']['status_id'] == 1 ? 0 : 1;
		$this->Servidor->saveField('status_id', $ativar_desativar);
	}
}
?>