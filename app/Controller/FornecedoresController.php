<?php

App::uses('AppController', 'Controller');

/**
 * KitsPedidos Controller
 *
 * @property KitsPedido $KitsPedido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FornecedoresController extends AppController {

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
        $fornecedores = $this->Fornecedore->find('all');
        $this->set('fornecedores', $fornecedores);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Fornecedore->create();
            if ($this->Fornecedore->save($this->request->data)) {
                $this->Session->setFlash(__('O Fornecedor foi salvo com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'Fornecedor');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O Fornecedor não pode ser salvo, por favor tente novamente'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'Fornecedor');
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
        
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        
    }

}
