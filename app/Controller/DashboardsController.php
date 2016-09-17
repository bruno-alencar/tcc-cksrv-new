<?php 
class DashboardsController extends AppController {

	public function beforeFilter(){

		// Carrega a model
		$this->loadModel('Servidor');
		$this->loadModel('TipoServico');
		$this->loadModel('Servico');
		$this->loadModel('Usuario');

	}

	public function admin_index(){


		$servidor = $this->Servidor->findById(1);

		$tipoServicos = $this->TipoServico->find('list', array('conditions' => 'TipoServico.id > 0'));

		$nomeServico = $this->TipoServico->find('list');	

		$this->set(compact('tipoServicos','servidor','nomeServico'));
	
	}	

	public function admin_view(){

		if($this->request->data){
			$servico = $this->request->data['Dashboards']['tipo_servico_id'];
		}


		$nmeServico = $this->TipoServico->find('all',array(
													'fields' => array('TipoServico.servico'), 
													'conditions' => array('TipoServico.id = ' => $servico)
													));

		foreach ($nmeServico as $n) {

		$nmeServicoRetorno = $n['TipoServico']['servico'];

		}


	    $todosServidoresCritical = $this->Servico->find('all', array(
	    							'fields' => array('count(Servidor.id) as qtde,Servidor.host'),
	    							'conditions' => array('Servico.resultado > Servico.critical and Servico.tipo_servico_id = ' => $servico),	
	    							'group' => array('Servidor.id')
	     															));

	    $todosServidoresWarning = $this->Servico->find('all', array(
	    							'fields' => array('count(Servidor.id) as qtde,Servidor.host'),
	    							'conditions' => array('Servico.resultado > Servico.warning and Servico.tipo_servico_id = ' => $servico),	
	    							'group' => array('Servidor.id')
	     															));

	    $todosServidoresBarra = $this->Servico->find('all', array(
	    							'fields' => array('count(Servidor.id) as qtde,Servidor.host'),
	    							'conditions' => array('(Servico.resultado > Servico.warning or Servico.resultado > Servico.critical) and Servico.tipo_servico_id = ' => $servico),	
	    							'group' => array('Servidor.id')
	     															));


		$critical = $this->Servico->find('count',array('conditions' => ['Servico.resultado > Servico.critical and Servico.tipo_servico_id = ' => $servico]));

		$warning = $this->Servico->find('count',array('conditions' => ['Servico.resultado > Servico.warning and Servico.tipo_servico_id = ' => $servico]));




		$this->set(compact('critical','warning','todosServidoresCritical','nmeServicoRetorno','todosServidoresWarning','todosServidoresBarra'));

	}

}

?>	