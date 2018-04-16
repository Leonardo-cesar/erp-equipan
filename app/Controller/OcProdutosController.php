<?php

App::uses('AppController', 'Controller');

/**
 * KitsPedidos Controller
 *
 * @property KitsPedido $KitsPedido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OcProdutosController extends AppController {

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
        $OcProduto = $this->OcProduto->find('all');
        $this->set('OcProduto', $OcProduto);
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
            $this->OcProduto->create();
            if ($this->OcProduto->save($this->request->data)) {
                $this->Session->setFlash(__('O Produto foi salvo com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'OcProduto');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O Produto não pode ser salvo, por favor tente novamente'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'OcProduto');
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
