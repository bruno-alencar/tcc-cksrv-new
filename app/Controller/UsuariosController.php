<?php

class UsuariosController extends AppController{

	public function beforeFilter() {       
		$this->loadModel('Sexo');
		$this->loadModel('Perfil');
	}

	public function login(){
		// $user = AuthComponent::user();
			// if(!empty($user))
			//      return $this->redirect($this->Auth->redirect(array('controller'=>'atendimentos', 'action'=>'index')));
				if($this->request->is('post')){

						// $this->request->data['Usuario']['senha'] = md5($this->request->data['Usuario']['senha']);

						if ($this->Auth->login()) {
								return $this->redirect($this->Auth->redirect());
						} else {
							$this->Session->setFlash('Usuário ou senha inválido(s)');
						}
				}
	}

	public function logout() {
			return $this->redirect($this->Auth->logout());
	}


	public function admin_index(){
		$usuarios = $this->Usuario->find('all');

		$this->set(compact('usuarios'));
	}


	public function admin_add(){
		$sexos = $this->Sexo->find('list');
		$perfils = $this->Perfil->find('list');


		if ($this->request->is('post') && $this->request->data) {

			$NovoUsuario = ($this->request->data);

			$login = $NovoUsuario['Usuario']['login'];

			$usuarios = $this->Usuario->findAllByLogin($login);

			if(!empty($usuarios)){
				$this->Session->setFlash('Login já existente', 'flash_danger');
			}
			else {
				
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


	public function admin_edit($usuario_id){
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
		$this->render('admin_add');
	}

	public function admin_altera_status_usuario_ativo_inativo($usuario_id){
		$this->autoRender = false;

		$this->Usuario->id = $usuario_id;
		$usuario = $this->Usuario->read();

		$ativar_desativar = $usuario['Usuario']['status_id'] == 1 ? 0 : 1;
		$this->Usuario->saveField('status_id', $ativar_desativar);
	}

}

?>