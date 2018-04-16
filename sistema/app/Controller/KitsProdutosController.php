<?php
App::uses('AppController', 'Controller');
/**
 * KitsProdutos Controller
 *
 * @property KitsProduto $KitsProduto
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class KitsProdutosController extends AppController {

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
		$this->KitsProduto->recursive = 0;
		$this->set('kitsProdutos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->KitsProduto->exists($id)) {
			throw new NotFoundException(__('Invalid kits produto'));
		}
		$options = array('conditions' => array('KitsProduto.' . $this->KitsProduto->primaryKey => $id));
		$this->set('kitsProduto', $this->KitsProduto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->KitsProduto->create();
			if ($this->KitsProduto->save($this->request->data)) {
				$this->Session->setFlash(__('The kits produto has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The kits produto could not be saved. Please, try again.'));
			}
		}
		$kits = $this->KitsProduto->Kit->find('list');
		$produtos = $this->KitsProduto->Produto->find('list');
		$this->set(compact('kits', 'produtos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->KitsProduto->exists($id)) {
			throw new NotFoundException(__('Invalid kits produto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->KitsProduto->save($this->request->data)) {
				$this->Session->setFlash(__('The kits produto has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The kits produto could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('KitsProduto.' . $this->KitsProduto->primaryKey => $id));
			$this->request->data = $this->KitsProduto->find('first', $options);
		}
		$kits = $this->KitsProduto->Kit->find('list');
		$produtos = $this->KitsProduto->Produto->find('list');
		$this->set(compact('kits', 'produtos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->KitsProduto->id = $id;
		if (!$this->KitsProduto->exists()) {
			throw new NotFoundException(__('Invalid kits produto'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->KitsProduto->delete()) {
			$this->Session->setFlash(__('The kits produto has been deleted.'));
		} else {
			$this->Session->setFlash(__('The kits produto could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
