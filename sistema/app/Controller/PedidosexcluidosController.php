<?php

App::uses('AppController', 'Controller');

/**
 * Pedidosexcluidos Controller
 *
 * @property Pedidosexcluido $Pedidosexcluido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PedidosexcluidosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Pedidosexcluido', 'Estoque');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Pedidosexcluido->recursive = 0;
        $this->set('pedidosexcluidos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Pedidosexcluido->exists($id)) {
            throw new NotFoundException(__('Invalid pedidosexcluido'));
        }
        $options = array('conditions' => array('Pedidosexcluido.' . $this->Pedidosexcluido->primaryKey => $id));
        $this->set('pedidosexcluido', $this->Pedidosexcluido->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Pedidosexcluido->create();
            if ($this->Pedidosexcluido->save($this->request->data)) {
                $this->Session->setFlash(__('The pedidosexcluido has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pedidosexcluido could not be saved. Please, try again.'));
            }
        }
        $pedidos = $this->Pedidosexcluido->Pedido->find('list');
        $this->set(compact('pedidos'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Pedidosexcluido->exists($id)) {
            throw new NotFoundException(__('Invalid pedidosexcluido'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Pedidosexcluido->save($this->request->data)) {
                $this->Session->setFlash(__('The pedidosexcluido has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pedidosexcluido could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Pedidosexcluido.' . $this->Pedidosexcluido->primaryKey => $id));
            $this->request->data = $this->Pedidosexcluido->find('first', $options);
        }
        $pedidos = $this->Pedidosexcluido->Pedido->find('list');
        $this->set(compact('pedidos'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Pedidosexcluido->id = $id;
        if (!$this->Pedidosexcluido->exists()) {
            throw new NotFoundException(__('Invalid pedidosexcluido'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Pedidosexcluido->delete()) {
            $this->Session->setFlash(__('The pedidosexcluido has been deleted.'));
        } else {
            $this->Session->setFlash(__('The pedidosexcluido could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function excluir($id = null) {
        $this->set(compact('id'));
        if ($this->request->data) {
            $this->request->data['Pedidosexcluido']['pedido_id'] = $id;

            $this->Pedidosexcluido->create();
            $this->Pedidosexcluido->save($this->request->data);

            $this->Pedidosexcluido->Pedido->id = $id;
            $this->Pedidosexcluido->Pedido->saveField('situacao', 1);

            $pedido = $this->Pedidosexcluido->Pedido->find('first', array(
                'conditions' => array('Pedido.id' => $id),
                'contain' => array(
                    'KitsPedido' => array('Codigo', 'Kit'),
                ),
            ));

            foreach ($pedido['KitsPedido'] as $kitpedido) {
                $kit = $this->Pedidosexcluido->Pedido->KitsPedido->Kit->find('first', array(
                    'conditions' => array('Kit.id' => $kitpedido['Kit']['id']),
                    'contain' => array(
                        'Produto' => array('id'),
                    ),
                ));
                foreach ($kit['Produto'] as $produto) {
                    $estoque = $this->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $produto['id'], 'Estoque.unidade_id' => $pedido['Pedido']['unidade_id']), 'recursive' => -1, 'fields' => array('id', 'quantidade')));
                    $this->Estoque->id = $estoque['Estoque']['id'];
                    $this->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] + 1);
                }
                foreach ($kitpedido['Codigo'] as $codico) {
                    $cd = $this->Pedidosexcluido->Pedido->KitsPedido->Codigo->find('first', array(
                        'conditions' => array('Codigo.codigo' => $codico['codigo']),
                        'recursive' => -1,
                        'fields' => 'id'
                    ));
                    $this->Pedidosexcluido->Pedido->KitsPedido->Codigo->id = $cd['Codigo']['id'];
                    $this->Pedidosexcluido->Pedido->KitsPedido->Codigo->saveField('situacao', 0);
                }
                //$this->Pedidosexcluido->Pedido->KitsPedido->CodigosKitsPedido->deleteAll(array('CodigosKitsPedido.kits_pedido_id' => $kitpedido['id']), false);
            }

            
            $this->Pedidosexcluido->Pedido->KitsPedido->Kit->Produto->LogEstoque->deleteAll(array('LogEstoque.pedido_id' => $id), false);
            $this->Pedidosexcluido->Pedido->Caixa->deleteAll(array('Caixa.pedido_id' => $id), false);
            $this->Pedidosexcluido->Pedido->Entrega->deleteAll(array('Entrega.pedido_id' => $id), false);
            $this->Session->setFlash(__('Pedido excluido com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'pesquisar');
            $this->redirect('/Pedidos/pesquisar');
        }
    }
 
}
