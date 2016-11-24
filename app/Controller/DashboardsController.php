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

		$tipoServicos = $this->TipoServico->find('list', array('conditions' => 'TipoServico.id > 0'));

		$nomeServico = $this->TipoServico->find('list');	

		$this->set(compact('tipoServicos','servidor','nomeServico'));
	
	}	

	public function visualizar(){

		if($this->request->data){
			$servico = $this->request->data['Dashboards']['tipo_servico_id'];
			$periodo = $this->request->data['Dashboards']['periodo_dash_id'];

			if(empty($servico) || empty($periodo)){
				
			}
		}

		if($periodo == 1){
			$timestamp = strtotime("-1 month");
			$tempo = date('Y-m-d', $timestamp);
			$tempo = $tempo.' 00:00:00';
		}
		if($periodo == 2){
			$timestamp = strtotime("-3 month");
			$tempo = date('Y-m-d', $timestamp);
			$tempo = $tempo.' 00:00:00';
		}
		if($periodo == 3){
			$timestamp = strtotime("2016-01-01");
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

		/*
	    $todosServidoresCritical = $this->Servico->find('all', array(
	    							'fields' => array('count(Servidor.id) as qtde,Servidor.host'),
	    							'conditions' => array('Servico.resultado > Servico.critical and Servico.tipo_servico_id = ' => $servico, array('Servico.modified >' => $tempo)),	
	    							'group' => array('Servidor.id')
	     															));

	    $todosServidoresWarning = $this->Servico->find('all', array(
	    							'fields' => array('count(Servidor.id) as qtde,Servidor.host'),
	    							'conditions' => array('Servico.resultado > Servico.warning and Servico.tipo_servico_id = ' => $servico, array('Servico.modified >' => $tempo)),	
	    							'group' => array('Servidor.id')
	    														));	

	    $todosServidoresBarra = $this->Servico->find('all', array(
	    							'fields' => array('count(Servidor.id) as qtde,Servidor.host'),
	    							'conditions' => array('(Servico.resultado > Servico.warning or Servico.resultado > Servico.critical) and Servico.tipo_servico_id = ' => $servico, array('Servico.modified >' => $tempo)),	
	    							'group' => array('Servidor.id')
	     															));


		$critical = $this->Servico->find('count',array('conditions' => ['Servico.resultado > Servico.critical and Servico.tipo_servico_id = ' => $servico, array('Servico.modified >' => $tempo)]));

		$warning = $this->Servico->find('count',array('conditions' => ['Servico.resultado > Servico.warning and Servico.tipo_servico_id = ' => $servico, array('Servico.modified >' => $tempo)]));
	*/ 
		

		$todosServidoresCritical = $this->LogServico->find('all', array(
	    							'fields' => array('count(LogServico.ip) as qtde,LogServico.ip'),
	    							'conditions' => array('LogServico.flg_critical = 1 and Servico.tipo_servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),	
	    							'group' => array('LogServico.ip')
	     															));


		$todosServidoresWarning = $this->LogServico->find('all', array(
	    							'fields' => array('count(LogServico.ip) as qtde,LogServico.ip'),
	    							'conditions' => array('LogServico.flg_warning = 1 and Servico.tipo_servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),	
	    							'group' => array('LogServico.ip')
	     		
	     															));

		$todosServidoresBarra = $this->LogServico->find('all', array(
	    							'fields' => array('count(LogServico.ip) as qtde,LogServico.ip'),
	    							'conditions' => array('(LogServico.flg_critical = 1 or LogServico.flg_warning = 1) and Servico.tipo_servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),	
	    							'group' => array('LogServico.ip')
	     															));

		
		$critical = $this->LogServico->find('count',array('conditions' => ['LogServico.flg_critical = 1 and Servico.tipo_servico_id = ' => $servico, array('LogServico.modified >' => $tempo)]));

		$warning = $this->LogServico->find('count',array('conditions' => ['LogServico.flg_warning = 1 and Servico.tipo_servico_id = ' => $servico, array('LogServico.modified >' => $tempo)]));



		$periodoCritical = $this->LogServico->find('all',array(
									'fields' => array('WEEKDAY(LogServico.modified) dia,count(LogServico.flg_critical) as qtde,LogServico.modified'),	
									'conditions' => array('LogServico.flg_critical = 1 and Servico.tipo_servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),
									'group' => array('WEEKDAY(LogServico.modified)')
											));

		$periodoWarning = $this->LogServico->find('all',array(
									'fields' => array('WEEKDAY(LogServico.modified) dia,count(LogServico.flg_critical) as qtde,LogServico.modified'),	
									'conditions' => array('LogServico.flg_warning = 1 and Servico.tipo_servico_id = ' => $servico, array('LogServico.modified >' => $tempo)),
									'group' => array('WEEKDAY(LogServico.modified)')
											));


		$this->set(compact('critical','warning','todosServidoresCritical','nmeServicoRetorno','todosServidoresWarning','todosServidoresBarra','periodoCritical','periodoWarning'));

	}

}

?>	