<?php

    class MonitoramentoController extends AppController{

    public function beforeFilter() {

        // Carrega a model
        $this->loadModel('Servidor');
        $this->loadModel('Servico');
        $this->loadModel('Status');
    }


        public function index(){
            // Da um select na base e busca todos os servidores cadastrados
            $servidores = $this->Servidor->findAllByStatusId(1);

            // Faz um foreach que passa por todos os servidores
            foreach ($servidores as $ser) {

                if (!empty($servidores)) {

                    // Atribui o ID do servidor como seu indice
                    $servidor[$ser['Servidor']['id']] = $ser;

                    // Faz um Foreach que passa por todos os servicos do servidor
                    foreach ($ser['Servico'] as $s) {
                        
                        // Caso o tipo do serviço seja ping ele atribui como indice
                        if($s['tipo_servico_id'] == 1){
                            $servicos[$s['servidor_id']][$s['tipo_servico_id']] = $s;
                        }else{
                            // Foreach para juntar os serviços com o id do servidor como indice
                            $servicos[$s['servidor_id']][$s['tipo_servico_id']][$s['id']] = $s;
                        }
                    }
                }
            }
            // envia a variavel para a view
        	$this->set(compact('servicos', 'servidor'));
        }


    }
    
?>