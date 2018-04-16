<?php
App::uses('AppController', 'Controller');
/**
 * TipoPagamentos Controller
 *
 * @property TipoPagamento $TipoPagamento
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TipoPagamentosController extends AppController {

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
		$this->TipoPagamento->recursive = 0;
		$this->set('tipoPagamentos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TipoPagamento->exists($id)) {
			throw new NotFoundException(__('Invalid tipo pagamento'));
		}
		$options = array('conditions' => array('TipoPagamento.' . $this->TipoPagamento->primaryKey => $id));
		$this->set('tipoPagamento', $this->TipoPagamento->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TipoPagamento->create();
			if ($this->TipoPagamento->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo pagamento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo pagamento could not be saved. Please, try again.'));
			}
		}
		$unidades = $this->TipoPagamento->Unidade->find('list');
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
		if (!$this->TipoPagamento->exists($id)) {
			throw new NotFoundException(__('Invalid tipo pagamento'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TipoPagamento->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo pagamento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo pagamento could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TipoPagamento.' . $this->TipoPagamento->primaryKey => $id));
			$this->request->data = $this->TipoPagamento->find('first', $options);
		}
		$unidades = $this->TipoPagamento->Unidade->find('list');
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
		$this->TipoPagamento->id = $id;
		if (!$this->TipoPagamento->exists()) {
			throw new NotFoundException(__('Invalid tipo pagamento'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TipoPagamento->delete()) {
			$this->Session->setFlash(__('The tipo pagamento has been deleted.'));
		} else {
			$this->Session->setFlash(__('The tipo pagamento could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
