<?php

App::uses('AppController', 'Controller');

/**
 * Niveis Controller
 *
 * @property Nivei $Nivei
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NiveisController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $paginate;

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Nivei->recursive = 0;
        $this->set('niveis', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Nivei->exists($id)) {
            throw new NotFoundException(__('Invalid nivel'));
        }
        $options = array('conditions' => array('Nivei.' . $this->Nivei->primaryKey => $id));
        $this->set('nivei', $this->Nivei->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Nivei->create();
            if ($this->Nivei->save($this->request->data)) {
                $this->Session->setFlash(__('The nivei has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The nivei could not be saved. Please, try again.'));
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
        if (!$this->Nivei->exists($id)) {
            throw new NotFoundException(__('Invalid nivei'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Nivei->save($this->request->data)) {
                $this->Session->setFlash(__('The nivei has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The nivei could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Nivei.' . $this->Nivei->primaryKey => $id));
            $this->request->data = $this->Nivei->find('first', $options);
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
        $this->Nivei->id = $id;
        if (!$this->Nivei->exists()) {
            throw new NotFoundException(__('Invalid nivei'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Nivei->delete()) {
            $this->Session->setFlash(__('The nivei has been deleted.'));
        } else {
            $this->Session->setFlash(__('The nivei could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
