<?php 
class DashboardsController extends AppController {

	public function beforeFilter(){

		// Carrega a model
		$this->loadModel('Servidor');
		$this->loadModel('TipoServico');
		$this->loadModel('Servico');
		$this->loadModel('Usuario');
		$this->loadModel('LogServico');

	}

	public function index(){


		$servidor = $this->Servidor->findById(1);

		$tipoServicos = $this->TipoServico->find('list', array('conditions' => 'TipoServico.id > 1'));

		$nomeServico = $this->TipoServico->find('list');	

		$this->set(compact('tipoServicos','servidor','nomeServico'));
	
	}	

	public function visualizar(){

		if($this->request->data){
			$servico = $this->request->data['Dashboards']['tipo_servico_id'];
			$periodo = $this->request->data['Dashboards']['periodo_dash_id'];

			if(empty($periodo)){
				$periodo = 1;	
			}
		}


		if($periodo == 1){
			$tempo = date('Y-m-d');
			$tempo = $tempo.' 00:00:00';
		}
		if($periodo == 2){
			$timestamp = strtotime("-1 month");
			$tempo = date('Y-m-d', $timestamp);
			$tempo = $tempo.' 00:00:00';
		}
		if($periodo == 3){
			$timestamp = strtotime("-3 month");
			$tempo = date('Y-m-d', $timestamp);
			$tempo = $tempo.' 00:00:00';
		}


		$nmeServico = $this->TipoServico->find('all',array(
													'fields' => array('TipoServico.servico'), 
													'conditions' => array('TipoServico.id = ' => $servico)
													));

		foreach ($nmeServico as $n) {

		$nmeServicoRetorno = $n['TipoServico']['servico'];

		}


		$todosServidoresCritical = $this->LogServico->find('all', array(
	    							'fields' => array('count(LogServico.ip) as qtde,LogServico.ip'),
	    							'conditions' => array('LogServico.flg_critical = 1 and LogServico.servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),	
	    							'group' => array('LogServico.ip')
	     															));


		$todosServidoresWarning = $this->LogServico->find('all', array(
	    							'fields' => array('count(LogServico.ip) as qtde,LogServico.ip'),
	    							'conditions' => array('LogServico.flg_warning = 1 and LogServico.servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),	
	    							'group' => array('LogServico.ip')
	     		
	     															));

		$todosServidoresBarra = $this->LogServico->find('all', array(
	    							'fields' => array('count(LogServico.ip) as qtde,LogServico.ip'),
	    							'conditions' => array('(LogServico.flg_critical = 1 or LogServico.flg_warning = 1) and LogServico.servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),	
	    							'group' => array('LogServico.ip')
	     															));

		
		$critical = $this->LogServico->find('count',array('conditions' => ['LogServico.flg_critical = 1 and LogServico.servico_id = ' => $servico, array('LogServico.modified >' => $tempo)]));

		$warning = $this->LogServico->find('count',array('conditions' => ['LogServico.flg_warning = 1 and LogServico.servico_id = ' => $servico, array('LogServico.modified >' => $tempo)]));



		$periodoCritical = $this->LogServico->find('all',array(
									'fields' => array('MONTH(LogServico.modified) dia,count(LogServico.flg_critical) as qtde,LogServico.modified'),	
									'conditions' => array('LogServico.flg_critical = 1 and LogServico.servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),
									'group' => array('MONTH(LogServico.modified)')
											));

		$periodoWarning = $this->LogServico->find('all',array(
									'fields' => array('MONTH(LogServico.modified) dia,count(LogServico.flg_critical) as qtde,LogServico.modified'),	
									'conditions' => array('LogServico.flg_warning = 1 and LogServico.servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),
									'group' => array('MONTH(LogServico.modified)')
											));


		$this->set(compact('critical','warning','todosServidoresCritical','nmeServicoRetorno','todosServidoresWarning','todosServidoresBarra','periodoCritical','periodoWarning'));

	}

}

?>	