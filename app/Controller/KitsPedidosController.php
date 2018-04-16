<?php

App::uses('AppController', 'Controller');

/**
 * KitsPedidos Controller
 *
 * @property KitsPedido $KitsPedido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class KitsPedidosController extends AppController {

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
        $this->KitsPedido->recursive = 0;
        $this->set('kitsPedidos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->KitsPedido->exists($id)) {
            throw new NotFoundException(__('Invalid kits pedido'));
        }
        $options = array('conditions' => array('KitsPedido.' . $this->KitsPedido->primaryKey => $id));
        $this->set('kitsPedido', $this->KitsPedido->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->KitsPedido->create();
            if ($this->KitsPedido->save($this->request->data)) {
                $this->Session->setFlash(__('The kits pedido has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The kits pedido could not be saved. Please, try again.'));
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
        if (!$this->KitsPedido->exists($id)) {
            throw new NotFoundException(__('Invalid kits pedido'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->KitsPedido->save($this->request->data)) {
                $this->Session->setFlash(__('The kits pedido has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The kits pedido could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('KitsPedido.' . $this->KitsPedido->primaryKey => $id));
            $this->request->data = $this->KitsPedido->find('first', $options);
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
        $this->KitsPedido->id = $id;
        if (!$this->KitsPedido->exists()) {
            throw new NotFoundException(__('Invalid kits pedido'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->KitsPedido->delete()) {
            $this->Session->setFlash(__('The kits pedido has been deleted.'));
        } else {
            $this->Session->setFlash(__('The kits pedido could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function verifica($placa = NULL) {
        $this->viewClass = 'Json';

        $verifica = $this->KitsPedido->find('first', array(
            'conditions' => array('placa' => $placa),
            'fields' => array('created', 'placa'),
            'contain' => array(
                'Pedido' => array(
                    'fields' => array('id'),
                    'Unidade' => array(
                        'fields' => array('nome', 'id')
                    )
                ),
                'Kit' => array(
                    'fields' => 'nome'
                ),
            )
        ));

        if ($verifica != array()) {
            $verifica['composicao'] = 'feita';
        } else {
            $verifica['composicao'] = 'nao';
        }

        $this->set('data', $verifica);
        $this->set('_serialize', 'data');
    }

    public function produtos() {
        
    }

    public function gerarProdutos() {
        $this->viewClass = 'Json';

        $this->Session->write('KitsPedidos.Produtos', $this->request->data['KitsPedidos']);

        $this->request->data['KitsPedidos']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['KitsPedidos']['dataInicial'])));
        $this->request->data['KitsPedidos']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['KitsPedidos']['dataFinal'])));

        $produtos = $this->KitsPedido->find('all', array(
            'conditions' => array(
                "cast(KitsPedido.created as date) BETWEEN '{$this->request->data['KitsPedidos']['dataInicial']}' AND '{$this->request->data['KitsPedidos']['dataFinal']}'",
            ),
            'fields' => array('id', 'kit_id'),
            'contain' => array(
                'Kit' => array('fields' => array('composicao')),
                'Pedido' => array('fields' => array('unidade_id', 'situacao')),
            )
        ));

        $pro[0]['produto']['nome'] = 'Aluminio - Par';
        $pro[0]['produto']['qtd'] = 0;
        $pro[2]['produto']['nome'] = 'Alumínio - Diant./Tras.';
        $pro[2]['produto']['qtd'] = 0;
        $pro[3]['produto']['nome'] = 'Tarjeta - Par';
        $pro[3]['produto']['qtd'] = 0;
        $pro[4]['produto']['nome'] = 'Tarjeta - Diant./Tras.';
        $pro[4]['produto']['qtd'] = 0;
        $pro[5]['produto']['nome'] = 'Moto Aluminio';
        $pro[5]['produto']['qtd'] = 0;
        $pro[6]['produto']['nome'] = 'Tarjeta Moto';
        $pro[6]['produto']['qtd'] = 0;
        $pro[7]['produto']['nome'] = 'Moto Aço Inox';
        $pro[7]['produto']['qtd'] = 0;
        $pro[8]['produto']['nome'] = 'Aço - Par';
        $pro[8]['produto']['qtd'] = 0;
        $pro[9]['produto']['nome'] = 'Aço - Uni';
        $pro[9]['produto']['qtd'] = 0;

        foreach ($produtos as $produto) {
            if ($produto['Pedido']['unidade_id'] == $this->request->data['KitsPedidos']['unidade_id'] AND $produto['Pedido']['situacao'] == 0) {
                if ($produto['Kit']['composicao'] == 1) {
                    $pro[0]['produto']['qtd'] = $pro[0]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 2) {
                    $pro[2]['produto']['qtd'] = $pro[2]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 3) {
                    $pro[3]['produto']['qtd'] = $pro[3]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 4) {
                    $pro[4]['produto']['qtd'] = $pro[4]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 5) {
                    $pro[5]['produto']['qtd'] = $pro[5]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 6) {
                    $pro[6]['produto']['qtd'] = $pro[6]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 7) {
                    $pro[7]['produto']['qtd'] = $pro[7]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 8) {
                    $pro[8]['produto']['qtd'] = $pro[8]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 9) {
                    $pro[9]['produto']['qtd'] = $pro[9]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 10) {
                    $pro[0]['produto']['qtd'] = $pro[0]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 11) {
                    $pro[2]['produto']['qtd'] = $pro[2]['produto']['qtd'] + 1;
                } else if ($produto['Kit']['composicao'] == 12) {
                    $pro[5]['produto']['qtd'] = $pro[5]['produto']['qtd'] + 1;
                }
            }
        }

        if ($pro[2]['produto']['qtd'] > 1) {
            $pro[0]['produto']['qtd'] = $pro[0]['produto']['qtd'] + floor(($pro[2]['produto']['qtd'] / 2));
            $pro[2]['produto']['qtd'] = 1;
        }
        if ($pro[4]['produto']['qtd'] > 1) {
            $pro[3]['produto']['qtd'] = $pro[3]['produto']['qtd'] + floor(($pro[4]['produto']['qtd'] / 2));
            $pro[4]['produto']['qtd'] = 1;
        }
        if ($pro[9]['produto']['qtd'] > 1) {
            $pro[8]['produto']['qtd'] = $pro[8]['produto']['qtd'] + floor(($pro[9]['produto']['qtd'] / 2));
            $pro[9]['produto']['qtd'] = 1;
        }

        $this->set('data', $pro);
        $this->set('_serialize', 'data');
    }

}
