<?php
App::uses('AppController', 'Controller');
/**
 * FormasPagamentos Controller
 *
 * @property FormasPagamento $FormasPagamento
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FormasPagamentosController extends AppController {

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
		$this->FormasPagamento->recursive = 0;
		$this->set('formasPagamentos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FormasPagamento->exists($id)) {
			throw new NotFoundException(__('Invalid formas pagamento'));
		}
		$options = array('conditions' => array('FormasPagamento.' . $this->FormasPagamento->primaryKey => $id));
		$this->set('formasPagamento', $this->FormasPagamento->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FormasPagamento->create();
			if ($this->FormasPagamento->save($this->request->data)) {
				$this->Session->setFlash(__('The formas pagamento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The formas pagamento could not be saved. Please, try again.'));
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
		if (!$this->FormasPagamento->exists($id)) {
			throw new NotFoundException(__('Invalid formas pagamento'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FormasPagamento->save($this->request->data)) {
				$this->Session->setFlash(__('The formas pagamento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The formas pagamento could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FormasPagamento.' . $this->FormasPagamento->primaryKey => $id));
			$this->request->data = $this->FormasPagamento->find('first', $options);
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
		$this->FormasPagamento->id = $id;
		if (!$this->FormasPagamento->exists()) {
			throw new NotFoundException(__('Invalid formas pagamento'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FormasPagamento->delete()) {
			$this->Session->setFlash(__('The formas pagamento has been deleted.'));
		} else {
			$this->Session->setFlash(__('The formas pagamento could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
