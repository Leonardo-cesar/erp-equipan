<?php

App::uses('AppController', 'Controller');

/**
 * Pedidoscancelados Controller
 *
 * @property Pedidoscancelado $Pedidoscancelado
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PedidoscanceladosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Pedidoscancelado', 'Estoque');

    /**
     * index method
     *
     * @return void
     */

    public function index($id = null) {
        $this->set(compact('id'));
        if ($this->request->data) {
            $this->request->data['Pedidoscancelado']['pedido_id'] = $id;

            $this->Pedidoscancelado->create();
            $this->Pedidoscancelado->save($this->request->data);

            $this->Pedidoscancelado->Pedido->id = $id;
            $this->Pedidoscancelado->Pedido->saveField('situacao', 2);

            $pedido = $this->Pedidoscancelado->Pedido->find('first', array(
                'conditions' => array('Pedido.id' => $id),
                'contain' => array(
                    'KitsPedido' => array('Codigo', 'Kit'),
                ),
            ));

            foreach ($pedido['KitsPedido'] as $kitpedido) {
                foreach ($kitpedido['Codigo'] as $codico) {
                    $cd = $this->Pedidoscancelado->Pedido->KitsPedido->Codigo->find('first', array(
                        'conditions' => array('Codigo.codigo' => $codico['codigo']),
                        'recursive' => -1,
                        'fields' => 'id'
                    ));
                    $this->Pedidoscancelado->Pedido->KitsPedido->Codigo->id = $cd['Codigo']['id'];
                    $this->Pedidoscancelado->Pedido->KitsPedido->Codigo->saveField('situacao', 2);
                }
            }
            $this->Session->setFlash(__('Pedido cancelado com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'pesquisar');
            $this->redirect('/Pedidos/pesquisar');
        }
    }

}
