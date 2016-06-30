<?php

    class MonitoramentoController extends AppController{

    public function beforeFilter() {
        $this->loadModel('Servidor');
        $this->loadModel('Status');
    }


        public function index(){
        	$servidores = $this->Servidor->findAllByStatusId(Status::ATIVO);

        	$this->set(compact('servidores'));
        }


    }
    
?>