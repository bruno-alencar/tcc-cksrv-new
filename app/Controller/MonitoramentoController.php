<?php

    class MonitoramentoController extends AppController{

    public function beforeFilter() {

        // Carrega a model
        $this->loadModel('Servidor');
        $this->loadModel('Servico');
        $this->loadModel('Status');
    }


        public function index(){
            $servidores = $this->Servidor->find('all');

            foreach ($servidores as $ser) {
                $servidor[$ser['Servidor']['id']] = $ser;

                foreach ($ser['Servico'] as $s) {
                    
                    if($s['tipo_servico_id'] == 1){
                        $servicos[$s['servidor_id']][$s['tipo_servico_id']] = $s;
                    }else{
                        // Foreach para juntar os serviços com o id do servidor como indice
                        $servicos[$s['servidor_id']][$s['tipo_servico_id']][$s['id']] = $s;
                    }
                }
            }
            // envia a variavel para a view
        	$this->set(compact('servicos', 'servidor'));
        }


    }
    
?>