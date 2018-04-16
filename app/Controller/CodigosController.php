<?php

App::uses('AppController', 'Controller');

/**
 * Codigos Controller
 *
 * @property Codigo $Codigo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CodigosController extends AppController {

    public $uses = array('Codigo', 'Produto');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        if ($this->request->is('post')) {
            $this->request->data['codigo'] = str_replace('*', '', $this->request->data['codigo']);
            debug($this->request->data['codigo'][1]);
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Codigo->exists($id)) {
            throw new NotFoundException(__('Invalid codigo'));
        }
        $options = array('conditions' => array('Codigo.' . $this->Codigo->primaryKey => $id));
        $this->set('codigo', $this->Codigo->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Codigo->create();
            if ($this->Codigo->save($this->request->data)) {
                $this->Session->setFlash(__('The codigo has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The codigo could not be saved. Please, try again.'));
            }
        }
        $usuarios = $this->Codigo->Usuario->find('list');
        $unidades = $this->Codigo->Unidade->find('list');
        $kitsPedidos = $this->Codigo->KitsPedido->find('list');
        $this->set(compact('usuarios', 'unidades', 'kitsPedidos'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Codigo->exists($id)) {
            throw new NotFoundException(__('Invalid codigo'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Codigo->save($this->request->data)) {
                $this->Session->setFlash(__('The codigo has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The codigo could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Codigo.' . $this->Codigo->primaryKey => $id));
            $this->request->data = $this->Codigo->find('first', $options);
        }
        $usuarios = $this->Codigo->Usuario->find('list');
        $unidades = $this->Codigo->Unidade->find('list');
        $kitsPedidos = $this->Codigo->KitsPedido->find('list');
        $this->set(compact('usuarios', 'unidades', 'kitsPedidos'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Codigo->id = $id;
        if (!$this->Codigo->exists()) {
            throw new NotFoundException(__('Invalid codigo'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Codigo->delete()) {
            $this->Session->setFlash(__('The codigo has been deleted.'));
        } else {
            $this->Session->setFlash(__('The codigo could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function codigo() {
        $this->viewClass = 'Json';

        if ($this->request->data['CodigoC']['codigo'] != '') {
            $this->request->data['CodigoC']['codigo'] = str_replace('*', '', $this->request->data['CodigoC']['codigo']);

            $codigo = substr($this->request->data['CodigoC']['codigo'], 3, 6);
            $CID = $this->Produto->find('first', array('conditions' => array('Produto.codigo' => $codigo), 'fields' => 'id', 'recursive' => -1));
            if ($CID != false) {
                $data[0] = $CID['Produto']['id'];
                $data[1] = $this->gabaritoCodigo($this->request->data['CodigoC']['codigo'], 2);
                $data[2] = $this->request->data['CodigoC']['codigo'];
            } else {
                $data[0] = false;
                $data[1] = 'O Produto ainda não foi cadastrado!';
            }
        } else {
            $this->request->data['CodigoC']['codigo_I'] = str_replace('*', '', $this->request->data['CodigoC']['codigo_I']);

            $codigo = substr($this->request->data['CodigoC']['codigo_I'], 3, 6);
            $CID = $this->Produto->find('first', array('conditions' => array('Produto.codigo' => $codigo), 'fields' => 'id', 'recursive' => -1));
            $produto = $this->gabaritoCodigo($this->request->data['CodigoC']['codigo_I'], 2);

            if ($this->request->data['CodigoC']['codigo_F'] != '') {
                $cf = substr($this->request->data['CodigoC']['codigo_F'], 16, 19);
            } else {
                $cf = 50;
            }
            $cd = substr($this->request->data['CodigoC']['codigo_I'], 16, 19);

            $i = 1;
            while ($cd + $i <= $cf+1) {

                $data[] = array(
                    0 => $CID['Produto']['id'],
                    1 => $produto,
                    2 => substr($this->request->data['CodigoC']['codigo_I'], 0, 15) . str_pad($cd + $i - 1, 7, "0", STR_PAD_LEFT)
                );
                $i++;
            }
        }

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function cadastrar() {
        $this->viewClass = 'Json';

        foreach ($this->request->data['Codigos']['id'] as $keys => $ids) {
            $this->request->data['Produtos'][$ids][] = $ids;
        }
        foreach ($this->request->data['Produtos'] as $ids => $quantidade) {
            $estoque = $this->Produto->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $ids, 'Estoque.unidade_id' => $this->request->data['Codigo']['unidade_id']), 'fields' => array('id', 'quantidade')));
            $this->Produto->Estoque->id = $estoque['Estoque']['id'];
            $this->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] + count($quantidade));

            $this->request->data['Log'][] = array(
                'tipo' => 0,
                'produto_id' => $ids,
                'quantidade' => count($quantidade),
                'unidade_id' => $this->request->data['Codigo']['unidade_id'],
                'transferencia' => 0,
                'usuario_id' => $this->Session->read('Auth.User.id'),
            );
        }

        unset($this->request->data['Codigos']['id']);

        foreach ($this->request->data['Codigos'] as $key => $codigo) {
            $this->request->data['Codigo'][$key]['codigo'] = $codigo['codigo'];
            $this->request->data['Codigo'][$key]['unidade_id'] = $this->request->data['Codigo']['unidade_id'];
            $this->request->data['Codigo'][$key]['usuario_id'] = $this->request->data['Codigo']['usuario_id'];
        }

        unset($this->request->data['Codigo']['unidade_id']);
        unset($this->request->data['Codigo']['usuario_id']);

        $this->Codigo->create();
        $this->Codigo->saveAll($this->request->data['Codigo']);
        $this->Produto->LogEstoque->create();
        $this->Produto->LogEstoque->saveAll($this->request->data['Log']);

        $this->set('data', $this->request->data);
        $this->set('_serialize', 'data');
    }

    public function relatorio() {
        $produtos = $this->Codigo->KitsPedido->Kit->Produto->find('list', array('fields' => array('codigo', 'nome')));
        $this->set('produtos', $produtos);
    }

    public function gerarRelatorio() {
        $this->viewClass = 'Json';

        $this->request->data['Codigos']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Codigos']['dataInicial'])));
        $this->request->data['Codigos']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Codigos']['dataFinal'])));

        $this->Session->write('Codigos.Gerados', $this->request->data['Codigos']);

        $conditions[] = "cast(Codigo.created as date) BETWEEN '{$this->request->data['Codigos']['dataInicial']}' AND '{$this->request->data['Codigos']['dataFinal']}'";
        if ($this->request->data['Codigos']['unidade_id'] != '') {
            $conditions[] = 'Codigo.unidade_id =' . $this->request->data['Codigos']['unidade_id'];
        }
        if ($this->request->data['Codigos']['situacao'] != '') {
            $conditions[] = 'Codigo.situacao =' . $this->request->data['Codigos']['situacao'];
        }
        if ($this->request->data['Codigos']['produto_id'] != '') {
            $conditions[] = 'Codigo.codigo LIKE' . '%' . $this->request->data['Codigos']['produto_id'] . '%';
        }

        $codigos = $this->Codigo->find('all', array(
            'conditions' => $conditions,
            'fields' => array('codigo', 'situacao'),
            'contain' => array(
                'KitsPedido' => array(
                    'fields' => array('placa')
                )
            )
        ));

        $this->set('data', $codigos);
        $this->set('_serialize', 'data');
    }

}
