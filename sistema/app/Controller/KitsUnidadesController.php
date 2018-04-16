<?php
App::uses('AppController', 'Controller');
/**
 * KitsUnidades Controller
 *
 * @property KitsUnidade $KitsUnidade
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class KitsUnidadesController extends AppController {

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
		$this->KitsUnidade->recursive = 0;
		$this->set('kitsUnidades', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->KitsUnidade->exists($id)) {
			throw new NotFoundException(__('Invalid kits unidade'));
		}
		$options = array('conditions' => array('KitsUnidade.' . $this->KitsUnidade->primaryKey => $id));
		$this->set('kitsUnidade', $this->KitsUnidade->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->KitsUnidade->create();
			if ($this->KitsUnidade->save($this->request->data)) {
				$this->Session->setFlash(__('The kits unidade has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The kits unidade could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->KitsUnidade->exists($id)) {
			throw new NotFoundException(__('Invalid kits unidade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->KitsUnidade->save($this->request->data)) {
				$this->Session->setFlash(__('The kits unidade has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The kits unidade could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('KitsUnidade.' . $this->KitsUnidade->primaryKey => $id));
			$this->request->data = $this->KitsUnidade->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->KitsUnidade->id = $id;
		if (!$this->KitsUnidade->exists()) {
			throw new NotFoundException(__('Invalid kits unidade'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->KitsUnidade->delete()) {
			$this->Session->setFlash(__('The kits unidade has been deleted.'));
		} else {
			$this->Session->setFlash(__('The kits unidade could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
