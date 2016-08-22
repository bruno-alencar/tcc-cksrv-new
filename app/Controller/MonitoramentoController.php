<?php

    class MonitoramentoController extends AppController{

    public function beforeFilter() {

        // Carrega a model
        $this->loadModel('Servidor');
        $this->loadModel('Servico');
        $this->loadModel('Status');
    }


        public function index(){

            // Busca todos os serviços da base
        	$serv = $this->Servico->find('all');

            $servidores = $this->Servidor->find('all');

            foreach ($servidores as $ser) {
                $servidor[$ser['Servidor']['id']] = $ser;
            }


            // inicia um contador
            $i = 0;
            foreach ($serv as $s) {

                if($s['Servico']['tipo_servico_id'] == 1){
                     $servicos[$s['Servico']['servidor_id']][$s['Servico']['tipo_servico_id']] = $s;
                }else{
                // Foreach para juntar os serviços com o id do servidor como indice
                $servicos[$s['Servico']['servidor_id']][$s['Servico']['tipo_servico_id']][$i] = $s;
                }

                // incrementa o contador
                $i++;
            }

            // envia a variavel para a view
        	$this->set(compact('servicos', 'servidor'));
        }


    }
    
?>