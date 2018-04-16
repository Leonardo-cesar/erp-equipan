<?php

App::uses('AppController', 'Controller');

/**
 * Categorias Controller
 *
 * @property Categoria $Categoria
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriasController extends AppController {

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
        $this->Categoria->recursive = 0;
        $this->set('categorias', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Categoria->exists($id)) {
            throw new NotFoundException(__('Invalid categoria'));
        }
        $options = array('conditions' => array('Categoria.' . $this->Categoria->primaryKey => $id));
        $this->set('categoria', $this->Categoria->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Categoria->create();
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash(__('A categoria foi salva com sucesso.'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'categorias');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Categoria não pode ser salva, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'categorias');
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
        if (!$this->Categoria->exists($id)) {
            throw new NotFoundException(__('Categoria inválida'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash(__('A categoria foi editada com sucesso.'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'categorias');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Categoria não pode ser salva, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'categorias');
            }
        } else {
            $options = array('conditions' => array('Categoria.' . $this->Categoria->primaryKey => $id));
            $this->request->data = $this->Categoria->find('first', $options);
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
        $this->Categoria->id = $id;
        if (!$this->Categoria->exists()) {
            throw new NotFoundException(__('Invalid categoria'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Categoria->delete()) {
            $this->Session->setFlash(__('A categoria foi editada com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'categorias');
        } else {
            $this->Session->setFlash(__('Categoria não pode ser salva, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'categorias');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
