<?php

class UsuariosController extends AppController{

	public function beforeFilter() {       
		$this->loadModel('Sexo');
		$this->loadModel('Perfil');
	}

	public function login(){
				if($this->request->is('post')){
						$this->request->data['Usuario']['senha'] = md5($this->request->data['Usuario']['senha']);

						if ($this->Auth->login()) {
								return $this->redirect($this->Auth->redirect());
						} else {
							$this->Session->setFlash('Usuário ou senha inválido(s)', 'flash_danger');
						}
				}
	}

	public function logout() {
			return $this->redirect($this->Auth->logout());
	}


	public function index(){
		$usuarios = $this->Usuario->find('all');

		$this->set(compact('usuarios'));
	}


	public function adicionar(){
		$sexos = $this->Sexo->find('list');
		$perfils = $this->Perfil->find('list');

		if ($this->request->is('post') && $this->request->data) {
			
			$usuarios = $this->Usuario->findAllByLogin($this->request->data['Usuario']['login']);
			if(!empty($usuarios)){
				$this->Session->setFlash('Login já existente', 'flash_danger');

			}else{
				$this->request->data['Usuario']['senha'] = md5($this->request->data['Usuario']['senha']);
				if ($this->Usuario->save($this->request->data)) {
					$this->Session->setFlash('Usuário adicionado com sucesso.', 'flash_success');
					return $this->redirect(array('action' => 'index'));
				}
				else {
				$this->Session->setFlash('Não foi possível registrar os dados do usuário.', 'flash_danger');
				}
			}
		}

		$this->set(compact('sexos', 'perfils')); 
	}


	public function editar($usuario_id){
		$sexos = $this->Sexo->find('list');
		$perfils = $this->Perfil->find('list');

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash('Usuário atualizado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Não foi possível atualizar os dados do usuário.', 'flash_danger');
			}
		}

		$this->Usuario->id = $usuario_id;
		$this->request->data = $this->Usuario->read();

		$this->set(compact('sexos', 'perfils')); 
		$this->render('adicionar');
	}

	public function altera_status_usuario_ativo_inativo($usuario_id){
		$this->autoRender = false;

		$this->Usuario->id = $usuario_id;
		$usuario = $this->Usuario->read();

		$ativar_desativar = $usuario['Usuario']['status_id'] == 1 ? 0 : 1;
		$this->Usuario->saveField('status_id', $ativar_desativar);
	}

}

?>