<?php

App::uses('AppController', 'Controller');

/**
 * UnidadesLancamentos Controller
 *
 * @property UnidadesLancamento $UnidadesLancamento
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UnidadesLancamentosController extends AppController {

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
        $this->UnidadesLancamento->recursive = 0;
        $this->set('unidadesLancamentos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->UnidadesLancamento->exists($id)) {
            throw new NotFoundException(__('Invalid unidades lancamento'));
        }
        $options = array('conditions' => array('UnidadesLancamento.' . $this->UnidadesLancamento->primaryKey => $id));
        $this->set('unidadesLancamento', $this->UnidadesLancamento->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['UnidadesLancamento']['tipo'] = implode(',', $this->request->data['UnidadesLancamento']['tipo']);
            $this->UnidadesLancamento->create();
            if ($this->UnidadesLancamento->save($this->request->data)) {
                $this->Session->setFlash(__('The unidades lancamento has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unidades lancamento could not be saved. Please, try again.'));
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
        if (!$this->UnidadesLancamento->exists($id)) {
            throw new NotFoundException(__('Invalid unidades lancamento'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['UnidadesLancamento']['tipo'] = implode(',', $this->request->data['UnidadesLancamento']['tipo']);
            if ($this->UnidadesLancamento->save($this->request->data)) {
                $this->Session->setFlash(__('The unidades lancamento has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The unidades lancamento could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UnidadesLancamento.' . $this->UnidadesLancamento->primaryKey => $id));
            $this->request->data = $this->UnidadesLancamento->find('first', $options);
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
        $this->UnidadesLancamento->id = $id;
        if (!$this->UnidadesLancamento->exists()) {
            throw new NotFoundException(__('Invalid unidades lancamento'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->UnidadesLancamento->delete()) {
            $this->Session->setFlash(__('The unidades lancamento has been deleted.'));
        } else {
            $this->Session->setFlash(__('The unidades lancamento could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
