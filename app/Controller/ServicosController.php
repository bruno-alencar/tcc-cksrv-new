<?php 
class ServicosController extends AppController {

	public function beforeFilter(){
		$this->loadModel('Servidores');
		$this->loadModel('TipoServico');
	}

	public $belongsTo = array(
		'TipoServico' => array(
			'foreign_key' => 'tipo_servico_id'
		)
	);


	public function admin_add(){
		$this->layout = false;
		$tipoServicos = $this->TipoServico->find('list');
		if ($this->request->is('post') && $this->request->data) {
			if ($this->Servico->save($this->request->data)) {
				$this->Session->setFlash('Servico adicionado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'view', $this->request->data['Servico']['servidor_id']));
			} else {
				$this->Session->setFlash('Não foi possível registrar os dados do servico.', 'flash_danger');
			}
		}
		$this->set(compact('tipoServicos'));
	}

}
?>