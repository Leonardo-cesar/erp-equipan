<?php
App::uses('AppController', 'Controller');
/**
 * TipoPagamentosUnidades Controller
 *
 * @property TipoPagamentosUnidade $TipoPagamentosUnidade
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TipoPagamentosUnidadesController extends AppController {

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
		$this->TipoPagamentosUnidade->recursive = 0;
		$this->set('tipoPagamentosUnidades', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TipoPagamentosUnidade->exists($id)) {
			throw new NotFoundException(__('Invalid tipo pagamentos unidade'));
		}
		$options = array('conditions' => array('TipoPagamentosUnidade.' . $this->TipoPagamentosUnidade->primaryKey => $id));
		$this->set('tipoPagamentosUnidade', $this->TipoPagamentosUnidade->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TipoPagamentosUnidade->create();
			if ($this->TipoPagamentosUnidade->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo pagamentos unidade has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo pagamentos unidade could not be saved. Please, try again.'));
			}
		}
		$tipoPagamentos = $this->TipoPagamentosUnidade->TipoPagamento->find('list');
		$unidades = $this->TipoPagamentosUnidade->Unidade->find('list');
		$this->set(compact('tipoPagamentos', 'unidades'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TipoPagamentosUnidade->exists($id)) {
			throw new NotFoundException(__('Invalid tipo pagamentos unidade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TipoPagamentosUnidade->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo pagamentos unidade has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo pagamentos unidade could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TipoPagamentosUnidade.' . $this->TipoPagamentosUnidade->primaryKey => $id));
			$this->request->data = $this->TipoPagamentosUnidade->find('first', $options);
		}
		$tipoPagamentos = $this->TipoPagamentosUnidade->TipoPagamento->find('list');
		$unidades = $this->TipoPagamentosUnidade->Unidade->find('list');
		$this->set(compact('tipoPagamentos', 'unidades'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TipoPagamentosUnidade->id = $id;
		if (!$this->TipoPagamentosUnidade->exists()) {
			throw new NotFoundException(__('Invalid tipo pagamentos unidade'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TipoPagamentosUnidade->delete()) {
			$this->Session->setFlash(__('The tipo pagamentos unidade has been deleted.'));
		} else {
			$this->Session->setFlash(__('The tipo pagamentos unidade could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
