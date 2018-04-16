<?php
App::uses('AppController', 'Controller');
/**
 * SetoresUsuarios Controller
 *
 * @property SetoresUsuario $SetoresUsuario
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SetoresUsuariosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SetoresUsuario->recursive = 0;
		$this->set('setoresUsuarios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SetoresUsuario->exists($id)) {
			throw new NotFoundException(__('Invalid setores usuario'));
		}
		$options = array('conditions' => array('SetoresUsuario.' . $this->SetoresUsuario->primaryKey => $id));
		$this->set('setoresUsuario', $this->SetoresUsuario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SetoresUsuario->create();
			if ($this->SetoresUsuario->save($this->request->data)) {
				$this->Session->setFlash(__('The setores usuario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setores usuario could not be saved. Please, try again.'));
			}
		}
		$setors = $this->SetoresUsuario->Setor->find('list');
		$usuarios = $this->SetoresUsuario->Usuario->find('list');
		$this->set(compact('setors', 'usuarios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SetoresUsuario->exists($id)) {
			throw new NotFoundException(__('Invalid setores usuario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SetoresUsuario->save($this->request->data)) {
				$this->Session->setFlash(__('The setores usuario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setores usuario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SetoresUsuario.' . $this->SetoresUsuario->primaryKey => $id));
			$this->request->data = $this->SetoresUsuario->find('first', $options);
		}
		$setors = $this->SetoresUsuario->Setor->find('list');
		$usuarios = $this->SetoresUsuario->Usuario->find('list');
		$this->set(compact('setors', 'usuarios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SetoresUsuario->id = $id;
		if (!$this->SetoresUsuario->exists()) {
			throw new NotFoundException(__('Invalid setores usuario'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SetoresUsuario->delete()) {
			$this->Session->setFlash(__('The setores usuario has been deleted.'));
		} else {
			$this->Session->setFlash(__('The setores usuario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
