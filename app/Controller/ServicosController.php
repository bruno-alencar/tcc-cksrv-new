<?php 
class ServicosController extends AppController {

	public function beforeFilter(){
		$this->loadModel('Servidores');
	}

	public $belongsTo = array(
		'TipoServico' => array(
			'foreign_key' => 'tipo_servico_id'
		)
	);

}
?>