<?php

    class MonitoramentoController extends AppController{

    public function beforeFilter() {
        $this->loadModel('Servidor');
        $this->loadModel('Servico');
        $this->loadModel('Status');
    }


        public function index(){
        	$serv = $this->Servico->find('all');
            $i = 0;
            foreach ($serv as $s) {
                $servicos[$s['Servico']['servidor_id']][$s['Servico']['tipo_servico_id']][$i] = $s;
                $i++;
            }
        	$this->set(compact('servicos'));
        }


    }
    
?>