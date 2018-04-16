<?php

App::uses('AppController', 'Controller');

/**
 * Pedidos Controller
 *
 * @property Producao $Producao
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProducaoController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->layout = 'clean';
        $this->Session->delete('verifica');
    }

    public function table() {
        $this->layout = 'ajax';
        $producao = $this->Producao->KitsPedido->find('all', array(
            'conditions' => array('producao' => 0),
            'fields' => array('id', 'placa', 'tarjeta'),
            'contain' => array(
                'Kit' => array(
                    'fields' => 'nome'
                ),
            )
        ));

        $data = $this->Producao->KitsPedido->find('first', array('conditions' => array('KitsPedido.producao' => 0), 'order' => 'KitsPedido.id DESC', 'fields' => array('KitsPedido.id', 'KitsPedido.created'), 'recursive' => -1));
        if ($data != array()) {
            if ($this->Session->read('verifica') == null) {
                $this->Session->write('verifica', $data['KitsPedido']['created']);
                $atualiza = TRUE;
            } else {
                if ($this->Session->read('verifica') == $data['KitsPedido']['created']) {
                    $atualiza = FALSE;
                } else {
                    $this->Session->write('verifica', $data['KitsPedido']['created']);
                    $atualiza = TRUE;
                }
            }

            $data['Producao'] = $producao;
            $data['Atualiza'] = $atualiza;
            $data['Count'] = count($producao);
        } else {
            $data['Producao'] = FALSE;
            $data['Atualiza'] = FALSE;
            $data['Count'] = 0;
        }
        $this->set('data', $data);
    }

    public function concluir() {
        $this->viewClass = 'Json';

        $this->request->data['Producao']['kits_pedido_id'] = $this->request->query['id'];
        $this->request->data['Producao']['usuario_id'] = $this->Session->read('Auth.User.id');
        $this->Producao->save($this->request->data['Producao']);
        $this->Producao->KitsPedido->id = $this->request->query['id'];
        $this->Producao->KitsPedido->saveField('producao', '1');

        $this->set('data', TRUE);
        $this->set('_serialize', 'data');
    }

    public function cancelar() {
        $this->viewClass = 'Json';

        $this->request->data['Producao']['kits_pedido_id'] = $this->request->query['id'];
        $this->request->data['Producao']['usuario_id'] = $this->Session->read('Auth.User.id');
        $this->Producao->save($this->request->data['Producao']);
        $this->Producao->KitsPedido->id = $this->request->query['id'];
        $this->Producao->KitsPedido->saveField('producao', '2');

        $this->set('data', TRUE);
        $this->set('_serialize', 'data');
    }

}
