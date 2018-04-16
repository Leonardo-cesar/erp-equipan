<?php

App::uses('AppController', 'Controller');

/**
 * Setores Controller
 *
 * @property Setore $Setore
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SetoresController extends AppController {

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
        $this->Setore->recursive = 0;
        $this->set('setores', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Setore->exists($id)) {
            throw new NotFoundException(__('Invalid setore'));
        }
        $options = array('conditions' => array('Setore.' . $this->Setore->primaryKey => $id));
        $this->set('setore', $this->Setore->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Setore->create();
            if ($this->Setore->save($this->request->data)) {
                $this->Session->setFlash(__('The setore has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The setore could not be saved. Please, try again.'));
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
        if (!$this->Setore->exists($id)) {
            throw new NotFoundException(__('Invalid setore'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Setore->save($this->request->data)) {
                $this->Session->setFlash(__('The setore has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The setore could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Setore.' . $this->Setore->primaryKey => $id));
            $this->request->data = $this->Setore->find('first', $options);
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
        $this->Setore->id = $id;
        if (!$this->Setore->exists()) {
            throw new NotFoundException(__('Invalid setore'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Setore->delete()) {
            $this->Session->setFlash(__('The setore has been deleted.'));
        } else {
            $this->Session->setFlash(__('The setore could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
