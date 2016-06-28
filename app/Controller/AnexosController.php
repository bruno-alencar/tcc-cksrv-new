<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * AnexoTipos Controller
 *
 * @property AnexoTipo $AnexoTipo
 * @property PaginatorComponent $Paginator
 */
class AnexosController extends AppController {

	public function add($atendimento_id = null, $servico_id = null){
		$this->layout = false;

		if($this->request->is('post') && !empty($this->request->data)){

			$this->request->data['Anexo']['atendimento_id'] = $atendimento_id;
			$this->request->data['Anexo']['atendimento_servico_id'] = $servico_id;


			if ($servico_id != null) {
				$dir = WWW_ROOT.'arquivos/'.$atendimento_id.DS.$servico_id.DS;
			}else{
				$dir = WWW_ROOT.'arquivos/'.$atendimento_id.DS;
			}

			$this->checa_dir($dir);
			$arquivo = $this->checa_nome($this->request->data['Anexo']['nome'],$dir);

			$this->request->data['Anexo']['nome'] = $arquivo['name'];

			if($this->Anexo->save($this->request->data)){

				$this->move_arquivos($arquivo,$dir);
			}

			$this->Session->setFlash('Arquivo salvo com sucesso.','flash_success');
			return $this->redirect(array('controller'=>'atendimentos','action' => 'view', $atendimento_id, $servico_id ? 'servico_id:'.$servico_id : ''));
		}
	}

	public function checa_dir($dir)
	{
		App::uses('Folder', 'Utility');
		$folder = new Folder();
		if (!is_dir($dir)){
			$folder->create($dir);
		}
	}

	public function checa_nome($arquivo, $dir)
	{
		$arquivo_info = pathinfo($dir.$arquivo['name']);
		$arquivo_nome = $this->trata_nome($arquivo_info['filename']).'.'.$arquivo_info['extension'];
		$conta = 2;
		while (file_exists($dir.$arquivo_nome)) {
			$arquivo_nome  = $this->trata_nome($arquivo_info['filename']).'-'.$conta;
			$arquivo_nome .= '.'.$arquivo_info['extension'];
			$conta++;
		}
		$arquivo['name'] = $arquivo_nome;
		return $arquivo;
	}

	/**
	 * Trata o nome removendo espaços, acentos e caracteres em maiúsculo.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/ 
	public function trata_nome($imagem_nome)
	{
		$imagem_nome = strtolower(Inflector::slug($imagem_nome,'-'));
		return $imagem_nome;
	}

	/**
	 * Move o arquivo para a pasta de destino.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/ 
	public function move_arquivos($tmp_arquivo, $dir)
	{
		App::uses('File', 'Utility');
		$arquivo = new File($tmp_arquivo['tmp_name']);
		$arquivo->copy($dir.$tmp_arquivo['name']);
		$arquivo->close();
	}
}