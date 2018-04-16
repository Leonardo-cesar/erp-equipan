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
        $produtos = $this->OcProduto->find('list', array('order' => 'id ASC', 'fields' => array('id', 'descricao')));
        foreach ($produtos as $key => $produto) {
            $produtos[$key] = $key . '   - ' . $produto;
        }

        $this->set(compact('empresas', 'produtos'));
    }

    public function confirmar() {

        if (isset($this->request->data['OrdemCompra']) == false) {
            $this->Session->setFlash(__('Não foi adicionado produto a Ordem, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'add'));
        }

        if ($this->request->data['OrdemCompra']['fornecedore_id'] == '') {
            $this->Session->setFlash(__('O cliente não foi selecionado, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'add'));
        }
    }

    public function cadastrar() {
        if ($this->request->is('post')) {

            $this->request->data['OrdemCompra']['taxas'] = str_replace('.', '', $this->request->data['OrdemCompra']['taxas']);
            $this->request->data['OrdemCompra']['taxas'] = str_replace(',', '.', $this->request->data['OrdemCompra']['taxas']);

            $this->request->data['OrdemCompra']['frete'] = str_replace('.', '', $this->request->data['OrdemCompra']['frete']);
            $this->request->data['OrdemCompra']['frete'] = str_replace(',', '.', $this->request->data['OrdemCompra']['frete']);

            $this->request->data['OrdemCompra']['quantidade'] = 0;
            $this->request->data['OrdemCompra']['especificacoes'] = 0;
            $this->request->data['OrdemCompra']['qualidade'] = 0;
            $this->request->data['OrdemCompra']['embalagem'] = 0;
            $this->request->data['OrdemCompra']['prazo'] = 0;
            $this->request->data['OrdemCompra']['causa_atrasos'] = 0;
            $this->request->data['OrdemCompra']['usuario_id'] = $this->Session->read('Auth.User.id');
            $this->OrdemCompra->create();
            if ($this->OrdemCompra->save($this->request->data)) {

                foreach ($this->request->data['OrdemCompras']['id'] as $key => $produtos) {
                    $vp = str_replace('.', '', $this->request->data['OrdemCompras']['valor'][$key]);
                    $vp = str_replace(',', '.', $vp);

                    $this->request->data['Ordem'][$key]['ordem_compra_id'] = $this->OrdemCompra->getLastInsertID();
                    $this->request->data['Ordem'][$key]['oc_produto_id'] = $this->request->data['OrdemCompras']['id'][$key];
                    $this->request->data['Ordem'][$key]['quantidade'] = $this->request->data['OrdemCompras']['quantidade'][$key];
                    $this->request->data['Ordem'][$key]['valor'] = $vp;
                }

                $this->OrdemCompra->OcProdutosOrdemCompra->saveAll($this->request->data['Ordem']);

                $id = $this->OrdemCompra->getLastInsertId();
                $this->set(compact('id'));
            } else {
                $this->Session->setFlash(__('The pedido could not be saved. Please, try again.'));
            }
        }
    }

    public function imprimir($OrdemCompra = NULL) {
        $this->layout = 'imprimir';

        if ($OrdemCompra) {
            $data = $this->OrdemCompra->find('first', array(
                'conditions' => array('OrdemCompra.id' => $OrdemCompra),
                'contain' => array(
                    'Unidade' => array(
                        'fields' => 'nome'
                    ),
                    'Fornecedore',
                    'Usuario' => array(
                        'fields' => 'nome'
                    ),
                    'OcProdutosOrdemCompra' => array(
                        'OcProduto' => array(
                            'fields' => array('descricao', 'unidade')
                        )
                    ),
                ),
            ));
        }
        $titulo = 'Ordem de Compras';
        $this->set(compact('data', 'titulo'));
    }
    
    public function avaliar($OrdemCompra = NULL) {
        
        if ($this->request->is(array('post', 'put'))) {
            
            $this->request->data['OrdemCompra']['data_entrega'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['OrdemCompra']['data_entrega']))) . ' ' . date('H:i:s');
            $this->request->data['OrdemCompra']['data_entrega'] = $this->request->data['OrdemCompra']['data_entrega'];
            
            $this->request->data['OrdemCompra']['data_inspecao'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['OrdemCompra']['data_inspecao']))) . ' ' . date('H:i:s');
            $this->request->data['OrdemCompra']['data_inspecao'] = $this->request->data['OrdemCompra']['data_inspecao'];
            
            if ($this->OrdemCompra->save($this->request->data)) {
                $this->Session->setFlash(__('A Ordem de Compra foi avaliada com sucesso.'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'OrdemCompra');
                return $this->redirect(array('action' => 'index'));
            }
        }

        if ($OrdemCompra) {
            $data = $this->OrdemCompra->find('first', array(
                'conditions' => array('OrdemCompra.id' => $OrdemCompra),
                'contain' => array(
                    'Unidade' => array(
                        'fields' => 'nome'
                    ),
                    'Fornecedore',
                    'Usuario' => array(
                        'fields' => 'nome'
                    ),
                    'OcProdutosOrdemCompra' => array(
                        'OcProduto' => array(
                            'fields' => array('descricao', 'unidade')
                        )
                    ),
                ),
            ));
        }
        $titulo = 'Ordem de Compras';
        $this->set(compact('data', 'titulo'));
    }
    
    public function visualizar($OrdemCompra = NULL) {
        $q = array('Correta','Errada');
        $b = array('0' => 'Ruim', '1' => 'Regular', '2' => 'Bom', '3' => 'Otimo');
        if ($OrdemCompra) {
            $data = $this->OrdemCompra->find('first', array(
                'conditions' => array('OrdemCompra.id' => $OrdemCompra),
                'contain' => array(
                    'Unidade' => array(
                        'fields' => 'nome'
                    ),
                    'Fornecedore',
                    'Usuario' => array(
                        'fields' => 'nome'
                    ),
                    'OcProdutosOrdemCompra' => array(
                        'OcProduto' => array(
                            'fields' => array('descricao', 'unidade')
                        )
                    ),
                ),
            ));
        }
        $titulo = 'Ordem de Compras';
        $this->set(compact('data', 'titulo', 'q', 'b'));
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
