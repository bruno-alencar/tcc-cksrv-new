<?php

class UsuariosController extends AppController{

	public function beforeFilter() {       
				$this->loadModel('Sexo');
				$this->loadModel('UsuarioPerfil');
				$this->loadModel('UsuarioGrupo');
				$this->loadModel('UsuarioCargo');
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


	public function admin_add_usuario(){
		$sexos = $this->Sexo->find('list');
		$usuarioPerfis = $this->UsuarioPerfil->find('list');
		$usuarioGrupos = $this->UsuarioGrupo->find('list');
		$usuarioCargos = $this->UsuarioCargo->find('list');

		if ($this->request->is('post') && $this->request->data) {
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash('Usuário adicionado com sucesso.', 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Não foi possível registrar os dados do usuário.', 'flash_danger');
			}
		}

		$this->set(compact('sexos', 'usuarioPerfis', 'usuarioGrupos', 'usuarioCargos')); 
	}


	public function admin_edit_usuario($usuario_id){
		$sexos = $this->Sexo->find('list');
		$usuarioPerfis = $this->UsuarioPerfil->find('list');
		$usuarioGrupos = $this->UsuarioGrupo->find('list');
		$usuarioCargos = $this->UsuarioCargo->find('list');

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

		$this->set(compact('sexos', 'usuarioPerfis', 'usuarioGrupos', 'usuarioCargos')); 
		$this->render('admin_add_usuario');
	}

	public function admin_altera_status_usuario_ativo_inativo($usuario_id){
		$this->autoRender = false;

		$this->Usuario->id = $usuario_id;
		$usuario = $this->Usuario->read();

		$ativar_desativar = $usuario['Usuario']['status_id'] == 1 ? 2 : 1;
		$this->Usuario->saveField('status_id', $ativar_desativar);
	}

}

?>