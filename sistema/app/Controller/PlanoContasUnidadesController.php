<?php

App::uses('AppController', 'Controller');

/**
 * PlanoContasUnidades Controller
 *
 * @property PlanoContasUnidade $PlanoContasUnidade
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PlanoContasUnidadesController extends AppController {

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
        $this->PlanoContasUnidade->recursive = 0;
        $this->set('planoContasUnidades', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->PlanoContasUnidade->exists($id)) {
            throw new NotFoundException(__('Invalid plano contas unidade'));
        }
        $options = array('conditions' => array('PlanoContasUnidade.' . $this->PlanoContasUnidade->primaryKey => $id));
        $this->set('planoContasUnidade', $this->PlanoContasUnidade->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PlanoContasUnidade->create();
            if ($this->PlanoContasUnidade->save($this->request->data)) {
                $this->Session->setFlash(__('The plano contas unidade has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The plano contas unidade could not be saved. Please, try again.'));
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
        if (!$this->PlanoContasUnidade->exists($id)) {
            throw new NotFoundException(__('Invalid plano contas unidade'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PlanoContasUnidade->save($this->request->data)) {
                $this->Session->setFlash(__('The plano contas unidade has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The plano contas unidade could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('PlanoContasUnidade.' . $this->PlanoContasUnidade->primaryKey => $id));
            $this->request->data = $this->PlanoContasUnidade->find('first', $options);
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
        $this->PlanoContasUnidade->id = $id;
        if (!$this->PlanoContasUnidade->exists()) {
            throw new NotFoundException(__('Invalid plano contas unidade'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->PlanoContasUnidade->delete()) {
            $this->Session->setFlash(__('The plano contas unidade has been deleted.'));
        } else {
            $this->Session->setFlash(__('The plano contas unidade could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
