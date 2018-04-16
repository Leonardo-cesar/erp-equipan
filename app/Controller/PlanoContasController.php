<?php
App::uses('AppController', 'Controller');
/**
 * PlanoContas Controller
 *
 * @property PlanoConta $PlanoConta
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PlanoContasController extends AppController {

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
		$this->PlanoConta->recursive = 0;
		$this->set('planoContas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PlanoConta->exists($id)) {
			throw new NotFoundException(__('Invalid plano conta'));
		}
		$options = array('conditions' => array('PlanoConta.' . $this->PlanoConta->primaryKey => $id));
		$this->set('planoConta', $this->PlanoConta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PlanoConta->create();
			if ($this->PlanoConta->save($this->request->data)) {
				$this->Session->setFlash(__('The plano conta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plano conta could not be saved. Please, try again.'));
			}
		}
		$unidades = $this->PlanoConta->Unidade->find('list');
		$this->set(compact('unidades'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PlanoConta->exists($id)) {
			throw new NotFoundException(__('Invalid plano conta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PlanoConta->save($this->request->data)) {
				$this->Session->setFlash(__('The plano conta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plano conta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PlanoConta.' . $this->PlanoConta->primaryKey => $id));
			$this->request->data = $this->PlanoConta->find('first', $options);
		}
		$unidades = $this->PlanoConta->Unidade->find('list');
		$this->set(compact('unidades'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PlanoConta->id = $id;
		if (!$this->PlanoConta->exists()) {
			throw new NotFoundException(__('Invalid plano conta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PlanoConta->delete()) {
			$this->Session->setFlash(__('The plano conta has been deleted.'));
		} else {
			$this->Session->setFlash(__('The plano conta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
