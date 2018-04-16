<?php

App::uses('AppController', 'Controller');

/**
 * KitsPedidos Controller
 *
 * @property KitsPedido $KitsPedido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OrdemComprasController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('OrdemCompra', 'OcProduto');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $ordemCompras = $this->OrdemCompra->find('all');
        $this->set('ordemCompras', $ordemCompras);
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
        $produtos = $this->OcProduto->find('list', array('order' => 'id ASC', 'fields' => array('id','descricao')));
        foreach ($produtos as $key => $produto) {
            $produtos[$key] = $key . '   - ' . $produto;
        }

        $this->set(compact('empresas', 'produtos'));
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
