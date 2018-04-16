<?php

App::uses('AppController', 'Controller');

/**
 * Perdas Controller
 *
 * @property Perda $Perda
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PerdasController extends AppController {

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
        $this->Perda->recursive = 0;
        $conditions[] = "Perda.unidade_id <> 2";
        $perdas = $this->Perda->find('all', array('conditions' => $conditions, 'limit' => '300'));
        $this->set('perdas', $perdas);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Perda->exists($id)) {
            throw new NotFoundException(__('Invalid perda'));
        }
        $options = array('conditions' => array('Perda.' . $this->Perda->primaryKey => $id));
        $this->set('perda', $this->Perda->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->permissao();

        if ($this->request->is('post')) {
            $this->Perda->create();

            $estoque = $this->Perda->Produto->Estoque->find('first', array(
                'conditions' => array(
                    'Estoque.produto_id' => $this->request->data['Perda']['produto_id'],
                    'Estoque.unidade_id' => $this->request->data['Perda']['unidade_id']
                ),
                'fields' => array(
                    'id', 'quantidade'
                )
            ));

            $this->Perda->Produto->Estoque->id = $estoque['Estoque']['id'];
            $this->Perda->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] - $this->request->data['Perda']['quantidade']);

            if ($this->Perda->save($this->request->data)) {
                $this->Session->setFlash(__('The perda has been saved.'));
                return $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('The perda could not be saved. Please, try again.'));
            }
        }
        $produtos = $this->Perda->Produto->find('list');
        $pedidos = $this->Perda->Pedido->find('list');
        $usuarios = $this->Perda->Usuario->find('list');
        $unidades = $this->Perda->Unidade->find('list');
        $this->set(compact('produtos', 'pedidos', 'usuarios', 'unidades'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Perda->exists($id)) {
            throw new NotFoundException(__('Invalid perda'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Perda->save($this->request->data)) {
                $this->Session->setFlash(__('The perda has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The perda could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Perda.' . $this->Perda->primaryKey => $id));
            $this->request->data = $this->Perda->find('first', $options);
        }
        $produtos = $this->Perda->Produto->find('list');
        $pedidos = $this->Perda->Pedido->find('list');
        $usuarios = $this->Perda->Usuario->find('list');
        $unidades = $this->Perda->Unidade->find('list');
        $this->set(compact('produtos', 'pedidos', 'usuarios', 'unidades'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Perda->id = $id;
        if (!$this->Perda->exists()) {
            throw new NotFoundException(__('Invalid perda'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Perda->delete()) {
            $this->Session->setFlash(__('The perda has been deleted.'));
        } else {
            $this->Session->setFlash(__('The perda could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function relatorio() {
        $produtos = $this->Perda->Produto->find('list');
        $this->set(compact('produtos'));
    }

    public function gerarPerda() {
        $this->viewClass = 'Json';

        $this->Session->write('Perda.relatorio', $this->request->data['Perda']);

        if ($this->request->data['Perda']['produto_id'] != '') {
            $conditions[] = "Perda.produto_id = " . $this->request->data['Perda']['produto_id'];
        }

        if ($this->request->data['Perda']['unidade_id'] != '') {
            $conditions[] = "Perda.unidade_id = " . $this->request->data['Perda']['unidade_id'];
        }

        if ($this->request->data['Perda']['dataInicial'] != '' AND $this->request->data['Perda']['dataFinal'] != '') {
            $this->request->data['Perda']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataInicial'])));
            $this->request->data['Perda']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataFinal'])));
            $conditions[] = "cast(Perda.created as date) BETWEEN '{$this->request->data['Perda']['dataInicial']}' AND '{$this->request->data['Perda']['dataFinal']}'";
        }

        $perda = $this->Perda->find('all', array(
            'conditions' => $conditions,
            'fields' => array('quantidade', 'motivo', 'created', 'produto_id', 'pedido_id', 'unidade_id', 'usuario_id'),
            'contain' => array(
                'Unidade' => array('fields' => array('nome')),
                'Usuario' => array('fields' => array('nome')),
                'Produto' => array('fields' => array('nome')),
            )
        ));
        
        $pedidos = $this->Perda->find('all', array(
            'conditions' => $conditions,
            'fields' => array('sum(quantidade) as tq', 'usuario_id'),
            'group' => 'usuario_id',
            'contain' => array(
                'Usuario' => array('fields' => array('nome')),
            ),
        ));
        
        $perdas[0] = $perda;
        $perdas[1] = $pedidos;

        $this->set('data', $perdas);
        $this->set('_serialize', 'data');
    }

    public function rimprimir() {
        $this->layout = 'imprimir';

        $this->request->data['Perda'] = $this->Session->read('Perda.relatorio');
        
        if ($this->request->data['Perda']['produto_id'] != '') {
            $conditions[] = "Perda.produto_id = " . $this->request->data['Perda']['produto_id'];
            $produtos = $this->Perda->Produto->find('first', array(
                'conditions' => array('Produto.id' => $this->request->data['Perda']['produto_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $produto = $produtos['Produto']['nome'];
        }else{
            $produto = 'Todos';
        }

        if ($this->request->data['Perda']['unidade_id'] != '') {
            $conditions[] = "Perda.unidade_id = " . $this->request->data['Perda']['unidade_id'];
            $unidades = $this->Perda->Unidade->find('first', array(
                'conditions' => array('Unidade.id' => $this->request->data['Perda']['unidade_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $unidade = $unidades['Unidade']['nome'];
        }else{
            $unidade = 'Todas';
        }

        if ($this->request->data['Perda']['dataInicial'] != '' AND $this->request->data['Perda']['dataFinal'] != '') {
            $this->request->data['Perda']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataInicial'])));
            $this->request->data['Perda']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataFinal'])));
            $conditions[] = "cast(Perda.created as date) BETWEEN '{$this->request->data['Perda']['dataInicial']}' AND '{$this->request->data['Perda']['dataFinal']}'";
        }

        $perdas = $this->Perda->find('all', array(
            'conditions' => $conditions,
            'fields' => array('quantidade', 'motivo', 'created', 'produto_id', 'pedido_id', 'unidade_id'),
            'contain' => array(
                'Unidade' => array('fields' => array('nome')),
                'Produto' => array('fields' => array('nome')),
            )
        ));

        $titulo = 'Relatorio de Perda de Material';
        $this->set(compact('perdas', 'titulo', 'unidade', 'produto'));
    }
    
    public function excelPerdas() {
        $this->layout = 'export_xls';

        $this->request->data['Perda'] = $this->Session->read('Perda.relatorio');
        
        if ($this->request->data['Perda']['produto_id'] != '') {
            $conditions[] = "Perda.produto_id = " . $this->request->data['Perda']['produto_id'];
            $produtos = $this->Perda->Produto->find('first', array(
                'conditions' => array('Produto.id' => $this->request->data['Perda']['produto_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $produto = $produtos['Produto']['nome'];
        }else{
            $produto = 'Todos';
        }

        if ($this->request->data['Perda']['unidade_id'] != '') {
            $conditions[] = "Perda.unidade_id = " . $this->request->data['Perda']['unidade_id'];
            $unidades = $this->Perda->Unidade->find('first', array(
                'conditions' => array('Unidade.id' => $this->request->data['Perda']['unidade_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $unidade = $unidades['Unidade']['nome'];
        }else{
            $unidade = 'Todas';
        }

        if ($this->request->data['Perda']['dataInicial'] != '' AND $this->request->data['Perda']['dataFinal'] != '') {
            $this->request->data['Perda']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataInicial'])));
            $this->request->data['Perda']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataFinal'])));
            $conditions[] = "cast(Perda.created as date) BETWEEN '{$this->request->data['Perda']['dataInicial']}' AND '{$this->request->data['Perda']['dataFinal']}'";
        }

        $perdas = $this->Perda->find('all', array(
            'conditions' => $conditions,
            'fields' => array('quantidade', 'motivo', 'created', 'produto_id', 'pedido_id', 'unidade_id'),
            'contain' => array(
                'Unidade' => array('fields' => array('nome')),
                'Produto' => array('fields' => array('nome')),
            )
        ));

        $titulo = 'Relatorio de Perda de Material';
        $this->set(compact('perdas', 'titulo', 'unidade', 'produto'));
    }
    
    public function vgrafico(){
        $this->layout = 'grafico';
        $this->request->data['Perda'] = $this->Session->read('Perda.relatorio');

        if ($this->request->data['Perda']['produto_id'] != '') {
            $conditions[] = "Perda.produto_id = " . $this->request->data['Perda']['produto_id'];
        }

        if ($this->request->data['Perda']['unidade_id'] != '') {
            $conditions[] = "Perda.unidade_id = '" . $this->request->data['Perda']['unidade_id'] . "'";
            $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['Perda']['unidade_id']), 'recursive' => -1));
            $unidade = $unidade['Unidade']['nome'];
        }else{
            $unidade = 'Todas';
        }

        if ($this->request->data['Perda']['dataInicial'] != '' AND $this->request->data['Perda']['dataFinal'] != '') {
            $this->request->data['Perda']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataInicial'])));
            $this->request->data['Perda']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Perda']['dataFinal'])));
            $conditions[] = "cast(Perda.created as date) BETWEEN '{$this->request->data['Perda']['dataInicial']}' AND '{$this->request->data['Perda']['dataFinal']}'";
        }

        $perda = $this->Perda->find('all', array(
            'conditions' => $conditions,
            'fields' => array('sum(quantidade) as tq', 'usuario_id'),
            'group' => 'usuario_id',
            'contain' => array(
                'Usuario' => array('fields' => array('nome')),
            ),
        ));
        $grafico[] = ['Ususario', 'Quantidade'];
        foreach ($perda as $perdas){
            $perdas['Usuario']['nome'] = $perdas['Usuario']['id'] == 1 ? 'Outros' : $perdas['Usuario']['nome'];
            $grafico[] = [$perdas['Usuario']['nome'], floatval($perdas[0]['tq'])];
        }

        $this->set('grafico', $grafico);
        $this->set('_serialize', 'grafico');
        $titulo = 'Grafico de Perdas de Material';
        $this->set(compact('titulo', 'grafico', 'unidade'));
    }

}
