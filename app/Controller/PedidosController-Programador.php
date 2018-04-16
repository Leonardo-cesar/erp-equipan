<?php

App::uses('AppController', 'Controller');

/**
 * Pedidos Controller
 *
 * @property Pedido $Pedido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PedidosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Pedido', 'Estoque', 'LogEstoque', 'Kit', 'KitsPedido');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Pedido->recursive = 0;
        $this->set('pedidos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Pedido->exists($id)) {
            throw new NotFoundException(__('Invalid pedido'));
        }
        $options = array('conditions' => array('Pedido.' . $this->Pedido->primaryKey => $id));
        $this->set('pedido', $this->Pedido->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        $this->request->data['Pedido']['unidade_id'] = $this->Session->read('Pedido.unidade_id');

        $a = $this->validaAdm();
        foreach ($a as $key => $b) {
            $c[] = $key;
        }

        $clientes = $this->Pedido->Cliente->find('list', array('conditions' => array("Cliente.unidade_id IN (" . implode(',', $c) . ")")));

        $kits_a = $this->Kit->find('list', array('order' => 'id ASC'));
        foreach ($kits_a as $key => $kit) {
            $kits[$key] = $key . '   - ' . $kit;
        }

        $this->set(compact('clientes', 'unidades', 'kits'));
    }

    public function confirmar() {

        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        $this->Session->write('Pedido.unidade_id', $this->request->data['Pedido']['unidade_id']);

        if (isset($this->request->data['Produto']) == false) {
            $this->Session->setFlash(__('Não foi adicionado produto ao pedido, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'add'));
        }

        if ($this->request->data['Pedido']['unidade_id'] == '') {
            $this->Session->setFlash(__('Não foi selecionada a unidade, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'add'));
        }

        if ($this->request->data['Pedido']['cliente_id'] == '') {
            $this->Session->setFlash(__('O cliente não foi selecionado, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'add'));
        }

        if ($this->request->is('post')) {
            $this->request->data['Pedido']['desconto'] = str_replace('.', '', $this->request->data['Pedido']['desconto']);
            $this->request->data['Pedido']['desconto'] = str_replace(',', '.', $this->request->data['Pedido']['desconto']);
        }
    }

    public function cadastrar() {
        if ($this->request->is('post')) {

            $this->request->data['Pedido']['situacao'] = 0;
            $this->request->data['Pedido']['usuario_id'] = $this->Session->read('Auth.User.id');
            if ($this->request->data['Pedido']['pendente'] == '') {
            	$this->request->data['Pedido']['pendente'] = 0;
            }
            $this->Pedido->create();
            if ($this->Pedido->save($this->request->data)) {

                foreach ($this->request->data['Produto']['id'] as $key => $produtos) {
                    $vp = str_replace('.', '', $this->request->data['Produto']['valor'][$key]);
                    $vp = str_replace(',', '.', $vp);

                    $this->request->data['Produtos'][$key]['pedido_id'] = $this->Pedido->getLastInsertID();
                    $this->request->data['Produtos'][$key]['kit_id'] = $this->request->data['Produto']['id'][$key];
                    $this->request->data['Produtos'][$key]['placa'] = $this->request->data['Produto']['placa'][$key];
                    $this->request->data['Produtos'][$key]['tarjeta'] = $this->request->data['Produto']['tarjeta'][$key];
                    $this->request->data['Produtos'][$key]['valor'] = $vp;
                    $this->request->data['Produtos'][$key]['entregue'] = 0;
                    $this->request->data['Produtos'][$key]['paga'] = 0;
                    $this->request->data['Produtos'][$key]['usuario_id'] = $this->Session->read('Auth.User.id');
                    $this->request->data['Produtos'][$key]['parcial'] = 0;
                    $this->request->data['Produtos'][$key]['producao'] = 0;

                    $kit = $this->Kit->find('first', array(
                        'conditions' => array('Kit.id' => $this->request->data['Produto']['id'][$key]),
                        'contain' => array(
                            'Produto' => array('fields' => array('id')),
                        ),
                        'fields' => array('id')
                    ));

                    if ($this->request->data['Pedido']['pendente'] == 0) {
                        foreach ($kit['Produto'] as $produtos) {
                            $estoque = $this->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $produtos['id'], 'Estoque.unidade_id' => $this->request->data['Pedido']['unidade_id']), 'fields' => array('id', 'quantidade')));
                            $this->Estoque->id = $estoque['Estoque']['id'];
                            $this->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] - 1);

                            $this->request->data['Log'][] = array(
                                'tipo' => 1,
                                'produto_id' => $produtos['id'],
                                'quantidade' => 1,
                                'unidade_id' => $this->request->data['Pedido']['unidade_id'],
                                'transferencia' => 0,
                                'observacao' => $this->request->data['Pedido']['observacao'],
                                'pedido_id' => $this->Pedido->getLastInsertID(),
                                'usuario_id' => $this->Session->read('Auth.User.id'),
                            );
                        }
                    }
                }

                if ($this->request->data['Pedido']['pendente'] == 0) {
                    $this->LogEstoque->saveAll($this->request->data['Log']);
                }
                $this->Pedido->KitsPedido->saveAll($this->request->data['Produtos']);

                $id = $this->Pedido->getLastInsertId();
                $this->set(compact('id'));
            } else {
                $this->Session->setFlash(__('The pedido could not be saved. Please, try again.'));
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
        if (!$this->Pedido->exists($id)) {
            throw new NotFoundException(__('Invalid pedido'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Pedido->save($this->request->data)) {
                $this->Session->setFlash(__('The pedido has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pedido could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Pedido.' . $this->Pedido->primaryKey => $id));
            $this->request->data = $this->Pedido->find('first', $options);
        }
        $usuarioDescontos = $this->Pedido->UsuarioDesconto->find('list');
        $usuarios = $this->Pedido->Usuario->find('list');
        $clientes = $this->Pedido->Cliente->find('list');
        $unidades = $this->Pedido->Unidade->find('list');
        $kits = $this->Kit->find('list');
        $this->set(compact('usuarioDescontos', 'usuarios', 'clientes', 'unidades', 'kits'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Pedido->id = $id;
        if (!$this->Pedido->exists()) {
            throw new NotFoundException(__('Invalid pedido'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Pedido->delete()) {
            $this->Session->setFlash(__('The pedido has been deleted.'));
        } else {
            $this->Session->setFlash(__('The pedido could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function valor() {
        $this->viewClass = 'Json';


        $data['Valor'] = $this->Kit->Preco->find('first', array(
            'conditions' => array(
                'Preco.unidade_id' => $this->request->query['unidade'],
                'Preco.kit_id' => $this->request->query['produto'],
                'Preco.categoria_id' => $this->request->query['categoria'],
            ),
            'fields' => 'valor')
        );

        $produtos = $this->Kit->find('first', array(
            'conditions' => array(
                'Kit.id' => $this->request->query['produto'],
            ),
            'contain' => array(
                'Produto' => array('fields' => array('id')),
            ),
            'fields' => 'nome')
        );

        foreach ($produtos['Produto'] as $produto) {
            $data['Estoque'][] = $this->Kit->Produto->Estoque->find('first', array(
                'conditions' => array('Estoque.produto_id' => $produto['id'], 'Estoque.unidade_id' => $this->request->query['unidade']),
                'contain' => array(
                    'Produto' => array('fields' => array('nome')),
                ),
                'fields' => 'quantidade'
            ));
        }

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function liberar() {
        $this->viewClass = 'Json';

        if (isset($this->request->data['Liberar']['usuario']) != '') {
            $this->request->data['Liberar']['usuario'] = $this->request->data['Liberar']['usuario'];
        }
        if (isset($this->request->data['Liberar']['senha']) != '') {
            $this->request->data['Liberar']['senha'] = $this->request->data['Liberar']['senha'];
        }

        $this->request->data['Liberar']['senha'] = AuthComponent::password($this->request->data['Liberar']['senha']);
        $this->Pedido->Usuario->recursive = -1;
        $adm = $this->Pedido->Usuario->find('first', array('conditions' => array('usuario' => $this->request->data['Liberar']['usuario'], 'senha' => $this->request->data['Liberar']['senha'], 'nivel_id != 3'), 'fields' => array('id', 'nome')));

        $this->set('data', $adm);
        $this->set('_serialize', 'data');
    }

    public function pesquisar() {
        
    }

    public function pesquisarPedido() {

        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        $this->viewClass = 'Json';

        if ($this->request->query['pedido']) {
            $data = $this->Pedido->find('first', array(
                'conditions' => array('Pedido.id' => $this->request->query['pedido']),
                'contain' => array(
                    'Unidade' => array(
                        'fields' => 'nome'
                    ),
                    'Usuario' => array(
                        'fields' => 'nome'
                    ),
                    'Entrega' => array(
                        'fields' => array('created', 'usuario_id', 'unidade_id', 'observacao'),
                        'Usuario' => array(
                            'fields' => 'nome'
                        ),
                        'Unidade' => array(
                            'fields' => 'nome'
                        )
                    ),
                    'Caixa' => array(
                        'fields' => array('created', 'usuario_id', 'unidade_id', 'observacao'),
                        'Usuario' => array(
                            'fields' => 'nome'
                        ),
                        'Unidade' => array(
                            'fields' => 'nome'
                        )
                    ),
                    'KitsPedido' => array(
                        'Kit' => array(
                            'fields' => array('nome', 'tipo')
                        ),
                        'Codigo' =>
                        array('fields' => array('codigo')
                        )
                    ),
                    'Cliente' => array(
                        'fields' => array('Nome'),
                        'Categoria' => array(
                            'fields' => 'nome'
                        )
                    ),
                    'PedidosExcluido' => array(
                        'fields' => array('created', 'observacao')
                    ),
                    'PedidosCancelado' => array(
                        'fields' => array('created', 'observacao')
                    )
                ),
            ));
            $data['count'] = 1;
        } else {
            $data = $this->Pedido->KitsPedido->find('all', array(
                'conditions' => array('KitsPedido.placa' => $this->request->query['placa']),
                'contain' => array(
                    'Pedido' => array(
                        'fields' => array('id', 'cliente_id', 'created', 'observacao', 'unidade_id', 'usuario_id', 'tipo', 'situacao'),
                        'Cliente' => array(
                            'fields' => array('Nome'),
                            'Categoria' => array(
                                'fields' => 'nome'
                            )
                        ),
                        'Usuario' => array(
                            'fields' => 'nome'
                        ),
                        'Unidade' => array(
                            'fields' => 'nome'
                        ),
                        'PedidosExcluido' => array(
                            'fields' => array('created', 'observacao')
                        )
                    ),
                    'Codigo' =>
                    array('fields' => array('codigo')
                    ),
                    'Kit' => array(
                        'fields' => array('nome', 'tipo')
                    ),
                    'Caixa' => array(
                        'fields' => array('created', 'usuario_id', 'unidade_id', 'observacao'),
                        'Usuario' => array(
                            'fields' => 'nome'
                        ),
                        'Unidade' => array(
                            'fields' => 'nome'
                        )
                    ),
                    'Entrega' => array(
                        'fields' => array('created', 'usuario_id', 'unidade_id', 'observacao'),
                        'Usuario' => array(
                            'fields' => 'nome'
                        ),
                        'Unidade' => array(
                            'fields' => 'nome'
                        )
                    ),
                ),
            ));
            $count = count($data);
            if ($count <= 1) {
                $data = $data[0];
            }
            $data['count'] = $count;
        }

        if ($data['count'] <= 1) {
            $data['Caixa'] != NULL ? $data['Caixa'] = $data['Caixa'][0] : $data['Caixa'] = false;
            $data['Entrega'] != NULL ? $data['Entrega'] = $data['Entrega'][0] : $data['Entrega'] = false;
        }

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function imprimir($pedido = NULL) {
        $this->layout = 'imprimir';

        if ($pedido) {
            $data = $this->Pedido->find('first', array(
                'conditions' => array('Pedido.id' => $pedido),
                'contain' => array(
                    'Unidade' => array(
                        'fields' => 'nome'
                    ),
                    'Cliente' => array(
                        'fields' => 'Nome'
                    ),
                    'Representante' => array(
                        'fields' => 'Nome'
                    ),
                    'Usuario' => array(
                        'fields' => 'nome'
                    ),
                    'KitsPedido' => array(
                        'Kit' => array(
                            'fields' => 'nome'
                        )
                    ),
                ),
            ));
        }
        $vTotal = 0;
        foreach ($data['KitsPedido'] as $key => $KitsPedido) {
            $vTotal = $vTotal + $KitsPedido['valor'];
        }
        $vTotal = $vTotal - $data['Pedido']['desconto'];
        $titulo = 'Pedidos';
        $this->set(compact('pedido', 'data', 'vTotal', 'titulo'));
    }

    public function concluir($pedido = NULL) {
        $this->layout = 'ajax';

        if ($pedido) {
            $data = $this->Pedido->find('first', array(
                'conditions' => array('Pedido.id' => $pedido),
                'contain' => array(
                    'Unidade' => array(
                        'fields' => 'nome'
                    ),
                    'Cliente' => array(
                        'fields' => 'Nome'
                    ),
                    'Representante' => array(
                        'fields' => 'Nome'
                    ),
                    'Usuario' => array(
                        'fields' => 'nome'
                    ),
                    'KitsPedido' => array(
                        'Kit' => array(
                            'fields' => 'nome'
                        )
                    ),
                ),
            ));
        }

        foreach ($data['KitsPedido'] as $kit) {
            $kit = $this->Kit->find('first', array(
                'conditions' => array('Kit.id' => $kit['kit_id']),
                'contain' => array(
                    'Produto' => array('fields' => array('id')),
                ),
                'fields' => array('id')
            ));
            foreach ($kit['Produto'] as $produtos) {
                $estoque = $this->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $produtos['id'], 'Estoque.unidade_id' => $data['Pedido']['unidade_id']), 'fields' => array('id', 'quantidade')));
                $this->Estoque->id = $estoque['Estoque']['id'];
                $this->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] - 1);

                $this->request->data['Log'][] = array(
                    'tipo' => 1,
                    'produto_id' => $produtos['id'],
                    'quantidade' => 1,
                    'unidade_id' => $data['Pedido']['unidade_id'],
                    'transferencia' => 0,
                    'observacao' => $data['Pedido']['observacao'],
                    'pedido_id' => $data['Pedido']['id'],
                    'usuario_id' => $data['Pedido']['usuario_id'],
                );
            }
        }
        $this->LogEstoque->saveAll($this->request->data['Log']);
        
        $this->Pedido->id = $data['Pedido']['id'];
        $this->Pedido->saveField('pendente', 0);
        
        $this->set(compact('pedido'));
    }

    Public function gerados() {
        $clientes = $this->Pedido->Cliente->find('list', array('order' => 'nome ASC'));
        $categorias = $this->Pedido->Cliente->Categoria->find('list', array('order' => 'nome ASC'));

        $this->set(compact('clientes', 'categorias'));
    }

    Public function gerarGerados() {
        $this->viewClass = 'Json';

        $this->request->data['Pedidos']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataInicial'])));
        $this->request->data['Pedidos']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataFinal'])));

        $this->Session->write('Pedidos.Gerados', $this->request->data['Pedidos']);

        $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['Pedidos']['dataInicial']}' AND '{$this->request->data['Pedidos']['dataFinal']}'";
        if ($this->request->data['Pedidos']['unidade_id'] != '') {
            $conditions[] = 'Pedido.unidade_id =' . $this->request->data['Pedidos']['unidade_id'];
        }
        if ($this->request->data['Pedidos']['cliente_id'] != '') {
            $conditions[] = 'Pedido.cliente_id =' . $this->request->data['Pedidos']['cliente_id'];
        }
        if ($this->request->data['Pedidos']['categoria_id'] != '') {
            $conditions[] = 'Cliente.categoria_id =' . $this->request->data['Pedidos']['categoria_id'];
        }

        $conditions[] = "Pedido.situacao = 0";

        $pedidos = $this->Pedido->find('all', array(
            'conditions' => $conditions,
            'Order' => 'Pedido.id ASC',
            'fields' => array('Pedido.id', 'Pedido.created', 'Pedido.desconto', 'Pedido.tipo'),
            'contain' => array(
                'Cliente' => array(
                    'fields' => array('nome', 'categoria_id'),
                    'Categoria' => array(
                        'fields' => 'nome'
                    )
                ),
                'KitsPedido' => array(
                    'fields' => array('valor', 'placa'),
                    'Kit' => array(
                        'fields' => 'nome'
                    ))
            )
        ));

        $this->set('data', $pedidos);
        $this->set('_serialize', 'data');
    }

    public function gimprimir() {

        $this->layout = 'imprimir';

        $this->request->data['Pedidos'] = $this->Session->read('Pedidos.Gerados');
        $cliente = NULL;

        $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['Pedidos']['dataInicial']}' AND '{$this->request->data['Pedidos']['dataFinal']}'";
        if ($this->request->data['Pedidos']['unidade_id'] != '') {
            $conditions[] = 'Pedido.unidade_id =' . $this->request->data['Pedidos']['unidade_id'];
        }
        if ($this->request->data['Pedidos']['cliente_id'] != '') {
            $conditions[] = 'Pedido.cliente_id =' . $this->request->data['Pedidos']['cliente_id'];
            $cliente = $this->Pedido->Cliente->find('first', array('conditions' => array('Cliente.id' => $this->request->data['Pedidos']['cliente_id'])));
        }
        if ($this->request->data['Pedidos']['categoria_id'] != '') {
            $conditions[] = 'Cliente.categoria_id =' . $this->request->data['Pedidos']['categoria_id'];
        }

        $conditions[] = "Pedido.situacao = 0";

        $pedidos = $this->Pedido->find('all', array(
            'conditions' => $conditions,
            'Order' => 'Pedido.id ASC',
            'fields' => array('Pedido.id', 'Pedido.created', 'Pedido.desconto', 'Pedido.tipo'),
            'contain' => array(
                'Cliente' => array(
                    'fields' => array('nome', 'categoria_id'),
                    'Categoria' => array(
                        'fields' => 'nome'
                    )
                ),
                'KitsPedido' => array(
                    'fields' => array('valor', 'placa'),
                    'Kit' => array(
                        'fields' => 'nome'
                    ))
            )
        ));

        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['Pedidos']['unidade_id']), 'recursive' => -1));
        $titulo = 'Relatorio de Pedidos Gerados';
        $this->set(compact('pedidos', 'unidade', 'cliente', 'titulo'));
    }

    public function geradosExcel() {
        $this->layout = 'export_xls';

        $this->request->data['Pedidos'] = $this->Session->read('Pedidos.Gerados');
        $cliente = NULL;

        $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['Pedidos']['dataInicial']}' AND '{$this->request->data['Pedidos']['dataFinal']}'";
        if ($this->request->data['Pedidos']['unidade_id'] != '') {
            $conditions[] = 'Pedido.unidade_id =' . $this->request->data['Pedidos']['unidade_id'];
        }
        if ($this->request->data['Pedidos']['cliente_id'] != '') {
            $conditions[] = 'Pedido.cliente_id =' . $this->request->data['Pedidos']['cliente_id'];
            $cliente = $this->Pedido->Cliente->find('first', array('conditions' => array('Cliente.id' => $this->request->data['Pedidos']['cliente_id'])));
        }
        if ($this->request->data['Pedidos']['categoria_id'] != '') {
            $conditions[] = 'Cliente.categoria_id =' . $this->request->data['Pedidos']['categoria_id'];
        }

        $conditions[] = "Pedido.situacao = 0";

        $pedidos = $this->Pedido->find('all', array(
            'conditions' => $conditions,
            'Order' => 'Pedido.id ASC',
            'fields' => array('Pedido.id', 'Pedido.created', 'Pedido.desconto', 'Pedido.tipo'),
            'contain' => array(
                'Cliente' => array(
                    'fields' => array('nome', 'categoria_id'),
                    'Categoria' => array(
                        'fields' => 'nome'
                    )
                ),
                'KitsPedido' => array(
                    'fields' => array('valor', 'placa'),
                    'Kit' => array(
                        'fields' => 'nome'
                    ))
            )
        ));

        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['Pedidos']['unidade_id']), 'recursive' => -1));
        $this->set(compact('pedidos', 'unidade', 'cliente'));
    }

    public function replace() {
        $a = $this->validaAdm();
        if (count($a) == 1 || $this->Session->read('Auth.User.nivel_id') != 1) {
            $clientes = $this->Pedido->Cliente->find('list', array('conditions' => array('Cliente.unidade_id' => key($a))));
            $this->set(compact('clientes'));
        }
    }

    public function gerarReplace() {
        $this->viewClass = 'Json';

        $this->Session->write('PedidosReplace.Replace', $this->request->data['PedidosReplace']);

        $conditions = array();

        if ($this->request->data['PedidosReplace']['dataInicial'] != '' AND $this->request->data['PedidosReplace']['dataFinal'] != '') {
            $this->request->data['PedidosReplace']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosReplace']['dataInicial'])));
            $this->request->data['PedidosReplace']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosReplace']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['PedidosReplace']['dataInicial']}' AND '{$this->request->data['PedidosReplace']['dataFinal']}'";
        }
        if ($this->request->data['PedidosReplace']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['PedidosReplace']['unidade_id'] . "'";
        }
        if ($this->request->data['PedidosReplace']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['PedidosReplace']['cliente_id'] . "'";
        }
        if ($this->request->data['PedidosReplace']['situacao'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['PedidosReplace']['situacao'] . "'";
        }
        if ($this->request->data['PedidosReplace']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['PedidosReplace']['tipo'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";

        $data = $this->Pedido->KitsPedido->find('all', array(
            'conditions' => $conditions,
            'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.id', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'KitsPedido.parcial', 'KitsPedido.valor_parcial', 'Kit.nome', 'Pedido.tipo'),
            'contain' => array(
                'Pedido' => array(
                    'fields' => array('id', 'cliente_id', 'tipo'),
                ),
                'Kit' => array(
                    'fields' => 'nome'
                )
            )
        ));

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function imprimirReplace() {
        $this->layout = 'imprimir';

        $this->request->data['PedidosReplace'] = $this->Session->read('PedidosReplace.Replace');

        $conditions = array();

        if ($this->request->data['PedidosReplace']['dataInicial'] != '' AND $this->request->data['PedidosReplace']['dataFinal'] != '') {
            $this->request->data['PedidosReplace']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosReplace']['dataInicial'])));
            $this->request->data['PedidosReplace']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosReplace']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['PedidosReplace']['dataInicial']}' AND '{$this->request->data['PedidosReplace']['dataFinal']}'";
        }
        if ($this->request->data['PedidosReplace']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['PedidosReplace']['unidade_id'] . "'";
        }
        if ($this->request->data['PedidosReplace']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['PedidosReplace']['cliente_id'] . "'";
        }
        if ($this->request->data['PedidosReplace']['situacao'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['PedidosReplace']['situacao'] . "'";
        }
        if ($this->request->data['PedidosReplace']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['PedidosReplace']['tipo'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";

        $data = $this->Pedido->KitsPedido->find('all', array(
            'conditions' => $conditions,
            'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.id', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'KitsPedido.parcial', 'KitsPedido.valor_parcial', 'Kit.nome', 'Pedido.tipo'),
            'contain' => array(
                'Pedido' => array(
                    'fields' => array('id', 'cliente_id', 'tipo'),
                ),
                'Kit' => array(
                    'fields' => 'nome'
                )
            )
        ));

        $cliente = $this->Pedido->Cliente->find('first', array('conditions' => array('id' => $this->request->data['PedidosReplace']['cliente_id']), 'recursive' => -1, 'fields' => 'nome'));

        $titulo = 'Pedidos a Receber';
        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['PedidosReplace']['unidade_id']), 'recursive' => -1));
        $this->set(compact('data', 'unidade', 'cliente', 'titulo'));
    }

    public function receber() {
        $a = $this->validaAdm();
        if (count($a) == 1 || $this->Session->read('Auth.User.nivel_id') != 1) {
            $clientes = $this->Pedido->Cliente->find('list', array('conditions' => array('Cliente.unidade_id' => key($a))));
            $this->set(compact('clientes'));
        }
    }

    public function gerarReceber() {
        $this->viewClass = 'Json';

        $this->Session->write('PedidosAReceber.Receber', $this->request->data['PedidosAReceber']);

        $conditions = array();

        if ($this->request->data['PedidosAReceber']['dataInicial'] != '' AND $this->request->data['PedidosAReceber']['dataFinal'] != '') {
            $this->request->data['PedidosAReceber']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosAReceber']['dataInicial'])));
            $this->request->data['PedidosAReceber']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosAReceber']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['PedidosAReceber']['dataInicial']}' AND '{$this->request->data['PedidosAReceber']['dataFinal']}'";
        }
        if ($this->request->data['PedidosAReceber']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['PedidosAReceber']['unidade_id'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['PedidosAReceber']['cliente_id'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['situacao'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['PedidosAReceber']['situacao'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['PedidosAReceber']['tipo'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";


        if ($this->request->data['PedidosAReceber']['cliente_id'] == '') {
            $data = $this->Pedido->KitsPedido->find('all', array(
                'conditions' => $conditions,
                'fields' => array('sum(KitsPedido.valor) as vTotal', 'sum(KitsPedido.valor_parcial) as pTotal', 'KitsPedido.valor', 'Pedido.cliente_id'),
                'group' => 'Pedido.cliente_id',
                'contain' => array(
                    'Pedido' => array(
                        'fields' => array('id', 'cliente_id'),
                        'Cliente' => array(
                            'fields' => 'nome'
                        ))
                )
            ));
        } else {
            $data = $this->Pedido->KitsPedido->find('all', array(
                'conditions' => $conditions,
                'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'KitsPedido.parcial', 'KitsPedido.valor_parcial', 'Kit.nome', 'Pedido.tipo'),
                'contain' => array(
                    'Pedido' => array(
                        'fields' => array('id', 'cliente_id', 'tipo'),
                    ),
                    'Kit' => array(
                        'fields' => 'nome'
                    )
                )
            ));
        }

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function rimprimir() {
        $this->layout = 'imprimir';

        $this->request->data['PedidosAReceber'] = $this->Session->read('PedidosAReceber.Receber');

        $conditions = array();

        if ($this->request->data['PedidosAReceber']['dataInicial'] != '' AND $this->request->data['PedidosAReceber']['dataFinal'] != '') {
            $this->request->data['PedidosAReceber']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosAReceber']['dataInicial'])));
            $this->request->data['PedidosAReceber']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosAReceber']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['PedidosAReceber']['dataInicial']}' AND '{$this->request->data['PedidosAReceber']['dataFinal']}'";
        }
        if ($this->request->data['PedidosAReceber']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['PedidosAReceber']['unidade_id'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['PedidosAReceber']['cliente_id'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['situacao'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['PedidosAReceber']['situacao'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['PedidosAReceber']['tipo'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";

        if ($this->request->data['PedidosAReceber']['cliente_id'] == '') {
            $data = $this->Pedido->KitsPedido->find('all', array(
                'conditions' => $conditions,
                'fields' => array('format(sum(KitsPedido.valor),2,"de_DE") as vTotal', 'KitsPedido.valor', 'Pedido.cliente_id'),
                'group' => 'Pedido.cliente_id',
                'contain' => array(
                    'Pedido' => array(
                        'fields' => array('id', 'cliente_id'),
                        'Cliente' => array(
                            'fields' => 'nome'
                        ))
                )
            ));
        } else {
            $data = $this->Pedido->KitsPedido->find('all', array(
                'conditions' => $conditions,
                'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'Kit.nome', 'Pedido.tipo'),
                'contain' => array(
                    'Pedido' => array(
                        'fields' => array('id', 'cliente_id', 'tipo'),
                    ),
                    'Kit' => array(
                        'fields' => 'nome'
                    )
                )
            ));
            $cliente = $this->Pedido->Cliente->find('first', array('conditions' => array('id' => $this->request->data['PedidosAReceber']['cliente_id']), 'recursive' => -1, 'fields' => 'nome'));
        }

        $titulo = 'Pedidos a Receber';
        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['PedidosAReceber']['unidade_id']), 'recursive' => -1));
        $this->set(compact('data', 'unidade', 'cliente', 'titulo'));
    }

    public function excelReceber() {
        $this->layout = 'export_xls';

        $this->request->data['PedidosAReceber'] = $this->Session->read('PedidosAReceber.Receber');

        $conditions = array();

        if ($this->request->data['PedidosAReceber']['dataInicial'] != '' AND $this->request->data['PedidosAReceber']['dataFinal'] != '') {
            $this->request->data['PedidosAReceber']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosAReceber']['dataInicial'])));
            $this->request->data['PedidosAReceber']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['PedidosAReceber']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['PedidosAReceber']['dataInicial']}' AND '{$this->request->data['PedidosAReceber']['dataFinal']}'";
        }
        if ($this->request->data['PedidosAReceber']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['PedidosAReceber']['unidade_id'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['PedidosAReceber']['cliente_id'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['situacao'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['PedidosAReceber']['situacao'] . "'";
        }
        if ($this->request->data['PedidosAReceber']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['PedidosAReceber']['tipo'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";

        if ($this->request->data['PedidosAReceber']['cliente_id'] == '') {
            $data = $this->Pedido->KitsPedido->find('all', array(
                'conditions' => $conditions,
                'fields' => array('format(sum(KitsPedido.valor),2,"de_DE") as vTotal', 'KitsPedido.valor', 'Pedido.cliente_id'),
                'group' => 'Pedido.cliente_id',
                'contain' => array(
                    'Pedido' => array(
                        'fields' => array('id', 'cliente_id'),
                        'Cliente' => array(
                            'fields' => 'nome'
                        ))
                )
            ));
        } else {
            $data = $this->Pedido->KitsPedido->find('all', array(
                'conditions' => $conditions,
                'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'Kit.nome', 'Pedido.tipo'),
                'contain' => array(
                    'Pedido' => array(
                        'fields' => array('id', 'cliente_id', 'tipo'),
                    ),
                    'Kit' => array(
                        'fields' => 'nome'
                    )
                )
            ));
            $cliente = $this->Pedido->Cliente->find('first', array('conditions' => array('id' => $this->request->data['PedidosAReceber']['cliente_id']), 'recursive' => -1, 'fields' => 'nome'));
        }

        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['PedidosAReceber']['unidade_id']), 'recursive' => -1));
        $this->set(compact('data', 'unidade', 'cliente', 'titulo'));
    }

    public function resumo() {
        $a = $this->validaAdm();
        if (count($a) == 1 || $this->Session->read('Auth.User.nivel_id') != 1) {
            $clientes = $this->Pedido->Cliente->find('list', array('conditions' => array('Cliente.unidade_id' => key($a))));
            $this->set(compact('clientes'));
        }
    }

    public function gerarResumo() {
        $this->viewClass = 'Json';

        $this->Session->write('PedidosAReceber.Resumo', $this->request->data['Resumo']);

        $conditions = array();

        if ($this->request->data['Resumo']['dataInicial'] != '' AND $this->request->data['Resumo']['dataFinal'] != '') {
            $this->request->data['Resumo']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Resumo']['dataInicial'])));
            $this->request->data['Resumo']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Resumo']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['Resumo']['dataInicial']}' AND '{$this->request->data['Resumo']['dataFinal']}'";
        }
        if ($this->request->data['Resumo']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['Resumo']['unidade_id'] . "'";
        }
        if ($this->request->data['Resumo']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['Resumo']['cliente_id'] . "'";
        }
        if ($this->request->data['Resumo']['caixa'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['Resumo']['caixa'] . "'";
        }
        if ($this->request->data['Resumo']['entrega'] != '') {
            $conditions[] = "KitsPedido.entregue = '" . $this->request->data['Resumo']['entrega'] . "'";
        }
        if ($this->request->data['Resumo']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['Resumo']['tipo'] . "'";
        }
        if ($this->request->data['Resumo']['pendente'] != '3') {
            $conditions[] = "Pedido.pendente = '" . $this->request->data['Resumo']['pendente'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";

        $data = $this->Pedido->KitsPedido->find('all', array(
            'conditions' => $conditions,
            'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'KitsPedido.entregue', 'KitsPedido.parcial', 'KitsPedido.valor_parcial', 'Kit.nome', 'Pedido.tipo', 'Pedido.pendente'),
            'contain' => array(
                'Pedido' => array(
                    'fields' => array('id', 'cliente_id', 'desconto'),
                ),
                'Kit' => array(
                    'fields' => 'nome'
                )
            )
        ));

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function imprimirresumo() {
        $this->layout = 'imprimir';

        $this->request->data['Resumo'] = $this->Session->read('PedidosAReceber.Resumo');

        $conditions = array();

        if ($this->request->data['Resumo']['dataInicial'] != '' AND $this->request->data['Resumo']['dataFinal'] != '') {
            $this->request->data['Resumo']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Resumo']['dataInicial'])));
            $this->request->data['Resumo']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Resumo']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['Resumo']['dataInicial']}' AND '{$this->request->data['Resumo']['dataFinal']}'";
        }
        if ($this->request->data['Resumo']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['Resumo']['unidade_id'] . "'";
        }
        if ($this->request->data['Resumo']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['Resumo']['cliente_id'] . "'";
        }
        if ($this->request->data['Resumo']['caixa'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['Resumo']['caixa'] . "'";
        }
        if ($this->request->data['Resumo']['entrega'] != '') {
            $conditions[] = "KitsPedido.entregue = '" . $this->request->data['Resumo']['entrega'] . "'";
        }
        if ($this->request->data['Resumo']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['Resumo']['tipo'] . "'";
        }
        if ($this->request->data['Resumo']['pendente'] != '3') {
            $conditions[] = "Pedido.pendente = '" . $this->request->data['Resumo']['pendente'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";

        $data = $this->Pedido->KitsPedido->find('all', array(
            'conditions' => $conditions,
            'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'KitsPedido.entregue', 'KitsPedido.parcial', 'KitsPedido.valor_parcial', 'Kit.nome', 'Pedido.tipo', 'Pedido.pendente'),
            'contain' => array(
                'Pedido' => array(
                    'fields' => array('id', 'cliente_id', 'desconto'),
                ),
                'Kit' => array(
                    'fields' => 'nome'
                )
            )
        ));

        $titulo = 'Relatorio de Resumo de Pedidos';
        if ($this->request->data['Resumo']['cliente_id'] == '') {
            $cliente = 'Todos';
        } else {
            $cl = $this->Pedido->Cliente->find('first', array('conditions' => array('Cliente.id' => $this->request->data['Resumo']['cliente_id']), 'recursive' => -1));
            $cliente = $cl['Cliente']['nome'];
        }
        if ($this->request->data['Resumo']['entrega'] == '') {
            $entrega = 'Todos';
        } else {
            $entrega = $this->request->data['Resumo']['entrega'] == 0 ? 'Em Aberto' : 'Entregues';
        }
        if ($this->request->data['Resumo']['caixa'] == '') {
            $caixa = 'Todos';
        } else {
            $caixa = $this->request->data['Resumo']['caixa'] == 0 ? 'Em Aberto' : 'Paogs';
        }
        if ($this->request->data['Resumo']['tipo'] == '') {
            $tipo = 'Todos';
        } else {
            $tipo = $this->request->data['Resumo']['tipo'] == 0 ? 'À Vista' : 'A Receber';
        }
        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['Resumo']['unidade_id']), 'recursive' => -1));
        $this->set(compact('data', 'tipo', 'unidade', 'cliente', 'titulo', 'caixa', 'entrega'));
    }

    public function excelResumo() {
        $this->layout = 'export_xls';

        $this->request->data['Resumo'] = $this->Session->read('PedidosAReceber.Resumo');

        $conditions = array();

        if ($this->request->data['Resumo']['dataInicial'] != '' AND $this->request->data['Resumo']['dataFinal'] != '') {
            $this->request->data['Resumo']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Resumo']['dataInicial'])));
            $this->request->data['Resumo']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Resumo']['dataFinal'])));
            $conditions[] = "cast(Pedido.created as date) BETWEEN '{$this->request->data['Resumo']['dataInicial']}' AND '{$this->request->data['Resumo']['dataFinal']}'";
        }
        if ($this->request->data['Resumo']['unidade_id'] != '') {
            $conditions[] = "Pedido.unidade_id = '" . $this->request->data['Resumo']['unidade_id'] . "'";
        }
        if ($this->request->data['Resumo']['cliente_id'] != '') {
            $conditions[] = "Pedido.cliente_id = '" . $this->request->data['Resumo']['cliente_id'] . "'";
        }
        if ($this->request->data['Resumo']['caixa'] != '') {
            $conditions[] = "KitsPedido.paga = '" . $this->request->data['Resumo']['caixa'] . "'";
        }
        if ($this->request->data['Resumo']['entrega'] != '') {
            $conditions[] = "KitsPedido.entregue = '" . $this->request->data['Resumo']['entrega'] . "'";
        }
        if ($this->request->data['Resumo']['tipo'] != '') {
            $conditions[] = "Pedido.tipo = '" . $this->request->data['Resumo']['tipo'] . "'";
        }

        $conditions[] = "Pedido.situacao = 0";

        $data = $this->Pedido->KitsPedido->find('all', array(
            'conditions' => $conditions,
            'fields' => array('KitsPedido.valor', 'KitsPedido.placa', 'KitsPedido.valor', 'KitsPedido.created', 'KitsPedido.paga', 'KitsPedido.entregue', 'KitsPedido.parcial', 'KitsPedido.valor_parcial', 'Kit.nome', 'Pedido.tipo'),
            'contain' => array(
                'Pedido' => array(
                    'fields' => array('id', 'cliente_id', 'desconto'),
                ),
                'Kit' => array(
                    'fields' => 'nome'
                )
            )
        ));

        if ($this->request->data['Resumo']['cliente_id'] == '') {
            $cliente = 'Todos';
        } else {
            $cl = $this->Pedido->Cliente->find('first', array('conditions' => array('Cliente.id' => $this->request->data['Resumo']['cliente_id']), 'recursive' => -1));
            $cliente = $cl['Cliente']['nome'];
        }
        if ($this->request->data['Resumo']['entrega'] == '') {
            $entrega = 'Todos';
        } else {
            $entrega = $this->request->data['Resumo']['entrega'] == 0 ? 'Em Aberto' : 'Entregues';
        }
        if ($this->request->data['Resumo']['caixa'] == '') {
            $caixa = 'Todos';
        } else {
            $caixa = $this->request->data['Resumo']['caixa'] == 0 ? 'Em Aberto' : 'Paogs';
        }
        if ($this->request->data['Resumo']['tipo'] == '') {
            $tipo = 'Todos';
        } else {
            $tipo = $this->request->data['Resumo']['tipo'] == 0 ? 'À Vista' : 'A Receber';
        }
        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['Resumo']['unidade_id']), 'recursive' => -1));
        $this->set(compact('data', 'tipo', 'unidade', 'cliente', 'caixa', 'entrega'));
    }

    public function vendas() {
        
    }

    public function gerarVendas() {
        $this->viewClass = 'Json';

        $this->Session->write('Pedidos.Rank', $this->request->data['Pedidos']);

//        if ($this->request->data['Pedidos']['tipo'] != '') {
//            $conditions[] = "Pedido.tipo = '" . $this->request->data['Pedidos']['tipo'] . "'";
//        }
        if ($this->request->data['Pedidos']['unidade_id'] != '') {
            $conditions[] = "Caixa.unidade_id = '" . $this->request->data['Pedidos']['unidade_id'] . "'";
        }
        if ($this->request->data['Pedidos']['dataInicial'] != '' AND $this->request->data['Pedidos']['dataFinal'] != '') {
            $this->request->data['Pedidos']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataInicial'])));
            $this->request->data['Pedidos']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataFinal'])));
            $conditions[] = "cast(Caixa.created as date) BETWEEN '{$this->request->data['Pedidos']['dataInicial']}' AND '{$this->request->data['Pedidos']['dataFinal']}'";
        }

        $pedidos = $this->Pedido->Caixa->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'valor', 'desconto', 'usuario_id'),
            'contain' => array(
                'Pedido' => array('fields' => array('usuario_id'),
                    'Usuario' => array(
                        'fields' => 'nome'
                    )
                ),
                'KitsPedido' => array('fields' => array('usuario_id'),
                    'Usuario' => array(
                        'fields' => 'nome'
                    )
                ),
            ),
        ));

        $data = array();
        foreach ($pedidos as $pedido) {
            if ($pedido['KitsPedido']['usuario_id'] != NULL) {
                $data[$pedido['KitsPedido']['usuario_id']]['valor'] = array_key_exists($pedido['KitsPedido']['usuario_id'], $data) == false ? 0 : $data[$pedido['KitsPedido']['usuario_id']]['valor'];
                $data[$pedido['KitsPedido']['usuario_id']]['usuario'] = $pedido['KitsPedido']['Usuario']['nome'];
                $data[$pedido['KitsPedido']['usuario_id']]['valor'] = $data[$pedido['KitsPedido']['usuario_id']]['valor'] + ($pedido['Caixa']['valor'] - $pedido['Caixa']['desconto']);
            }
            if ($pedido['Pedido']['usuario_id'] != NULL) {
                $data[$pedido['Pedido']['usuario_id']]['valor'] = array_key_exists($pedido['Pedido']['usuario_id'], $data) == false ? 0 : $data[$pedido['Pedido']['usuario_id']]['valor'];
                $data[$pedido['Pedido']['usuario_id']]['usuario'] = $pedido['Pedido']['Usuario']['nome'];
                $data[$pedido['Pedido']['usuario_id']]['valor'] = $data[$pedido['Pedido']['usuario_id']]['valor'] + ($pedido['Caixa']['valor'] - $pedido['Caixa']['desconto']);
            }
        }

        $this->Pedido->recursive = 0;

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function vimprimir() {
        $this->layout = 'imprimir';

        $this->request->data['Pedidos'] = $this->Session->read('Pedidos.Rank');

        if ($this->request->data['Pedidos']['unidade_id'] != '') {
            $conditions[] = "Caixa.unidade_id = '" . $this->request->data['Pedidos']['unidade_id'] . "'";
            $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['Pedidos']['unidade_id']), 'recursive' => -1));
            $unidade = $unidade['Unidade']['nome'];
        }
        if ($this->request->data['Pedidos']['dataInicial'] != '' AND $this->request->data['Pedidos']['dataFinal'] != '') {
            $this->request->data['Pedidos']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataInicial'])));
            $this->request->data['Pedidos']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataFinal'])));
            $conditions[] = "cast(Caixa.created as date) BETWEEN '{$this->request->data['Pedidos']['dataInicial']}' AND '{$this->request->data['Pedidos']['dataFinal']}'";
        }

        $pedidos = $this->Pedido->Caixa->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'valor', 'desconto', 'usuario_id'),
            'contain' => array(
                'Pedido' => array('fields' => array('usuario_id'),
                    'Usuario' => array(
                        'fields' => 'nome'
                    )
                ),
                'KitsPedido' => array('fields' => array('usuario_id'),
                    'Usuario' => array(
                        'fields' => 'nome'
                    )
                ),
            ),
        ));

        $data = array();
        foreach ($pedidos as $pedido) {
            if ($pedido['KitsPedido']['usuario_id'] != NULL) {
                $data[$pedido['KitsPedido']['usuario_id']]['valor'] = array_key_exists($pedido['KitsPedido']['usuario_id'], $data) == false ? 0 : $data[$pedido['KitsPedido']['usuario_id']]['valor'];
                $data[$pedido['KitsPedido']['usuario_id']]['usuario'] = $pedido['KitsPedido']['Usuario']['nome'];
                $data[$pedido['KitsPedido']['usuario_id']]['valor'] = $data[$pedido['KitsPedido']['usuario_id']]['valor'] + ($pedido['Caixa']['valor'] - $pedido['Caixa']['desconto']);
            }
            if ($pedido['Pedido']['usuario_id'] != NULL) {
                $data[$pedido['Pedido']['usuario_id']]['valor'] = array_key_exists($pedido['Pedido']['usuario_id'], $data) == false ? 0 : $data[$pedido['Pedido']['usuario_id']]['valor'];
                $data[$pedido['Pedido']['usuario_id']]['usuario'] = $pedido['Pedido']['Usuario']['nome'];
                $data[$pedido['Pedido']['usuario_id']]['valor'] = $data[$pedido['Pedido']['usuario_id']]['valor'] + ($pedido['Caixa']['valor'] - $pedido['Caixa']['desconto']);
            }
        }

        $this->Pedido->recursive = 0;

        $titulo = 'Relatorio de Resumo de Pedidos';
        $this->set(compact('titulo', 'data', 'tipo', 'unidade'));
    }

    public function vgrafico() {
        $this->layout = 'grafico';

        $this->request->data['Pedidos'] = $this->Session->read('Pedidos.Rank');
        if ($this->request->data['Pedidos']['unidade_id'] != '') {
            $conditions[] = "Caixa.unidade_id = '" . $this->request->data['Pedidos']['unidade_id'] . "'";
            $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->request->data['Pedidos']['unidade_id']), 'recursive' => -1));
            $unidade = $unidade['Unidade']['nome'];
        }
        if ($this->request->data['Pedidos']['dataInicial'] != '' AND $this->request->data['Pedidos']['dataFinal'] != '') {
            $this->request->data['Pedidos']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataInicial'])));
            $this->request->data['Pedidos']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedidos']['dataFinal'])));
            $conditions[] = "cast(Caixa.created as date) BETWEEN '{$this->request->data['Pedidos']['dataInicial']}' AND '{$this->request->data['Pedidos']['dataFinal']}'";
        }

        $pedidos = $this->Pedido->Caixa->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'valor', 'desconto', 'usuario_id'),
            'contain' => array(
                'Pedido' => array('fields' => array('usuario_id'),
                    'Usuario' => array(
                        'fields' => 'nome'
                    )
                ),
                'KitsPedido' => array('fields' => array('usuario_id'),
                    'Usuario' => array(
                        'fields' => 'nome'
                    )
                ),
            ),
        ));

        $data = array();
        foreach ($pedidos as $pedido) {
            if ($pedido['KitsPedido']['usuario_id'] != NULL) {
                $data[$pedido['KitsPedido']['usuario_id']]['valor'] = array_key_exists($pedido['KitsPedido']['usuario_id'], $data) == false ? 0 : $data[$pedido['KitsPedido']['usuario_id']]['valor'];
                $data[$pedido['KitsPedido']['usuario_id']]['usuario'] = $pedido['KitsPedido']['Usuario']['nome'];
                $data[$pedido['KitsPedido']['usuario_id']]['valor'] = $data[$pedido['KitsPedido']['usuario_id']]['valor'] + ($pedido['Caixa']['valor'] - $pedido['Caixa']['desconto']);
            }
            if ($pedido['Pedido']['usuario_id'] != NULL) {
                $data[$pedido['Pedido']['usuario_id']]['valor'] = array_key_exists($pedido['Pedido']['usuario_id'], $data) == false ? 0 : $data[$pedido['Pedido']['usuario_id']]['valor'];
                $data[$pedido['Pedido']['usuario_id']]['usuario'] = $pedido['Pedido']['Usuario']['nome'];
                $data[$pedido['Pedido']['usuario_id']]['valor'] = $data[$pedido['Pedido']['usuario_id']]['valor'] + ($pedido['Caixa']['valor'] - $pedido['Caixa']['desconto']);
            }
        }

        $this->Pedido->recursive = 0;

        $grafico[] = ['Usuário', 'Valor'];
        foreach ($data as $pedido) {
            $grafico[] = [$pedido['usuario'], floatval($pedido['valor'])];
        }


        $this->set('grafico', $grafico);
        $this->set('_serialize', 'grafico');
        $titulo = 'Grafico de Resumo de Pedidos';
        $this->set(compact('titulo', 'grafico', 'tipo', 'unidade'));
    }

    public function localiza() {

        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        $this->request->data['Pedido']['unidade_id'] = $this->Session->read('Pedido.unidade_id');

        $a = $this->validaAdm();
        foreach ($a as $key => $b) {
            $c[] = $key;
        }

        $clientes = $this->Pedido->Cliente->find('list', array('conditions' => array("Cliente.unidade_id=10")));

        $kits_a = $this->Kit->find('list', array('order' => 'id ASC'));
        foreach ($kits_a as $key => $kit) {
            $kits[$key] = $key . '   - ' . $kit;
        }

        $this->set(compact('clientes', 'unidades', 'kits'));
    }

    public function confirmarLocaliza() {

        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        $this->Session->write('Pedido.unidade_id', $this->request->data['Pedido']['unidade_id']);

        if (isset($this->request->data['Pedido']['kit']) == false) {
            $this->Session->setFlash(__('Não foi adicionado produto ao pedido, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'localiza'));
        } else {
            $kit = $this->Kit->find('first', array(
                'conditions' => array(
                    'Kit.id' => $this->request->data['Pedido']['kit'],
                ),
                'recursive' => -1,
                'fields' => 'nome')
            );
        }

        if ($this->request->data['Pedido']['unidade_id'] == '') {
            $this->Session->setFlash(__('Não foi selecionada a unidade, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'localiza'));
        }

        if ($this->request->data['Pedido']['cliente_id'] == '') {
            $this->Session->setFlash(__('O cliente não foi selecionado, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'pedido');
            return $this->redirect(array('action' => 'localiza'));
        }
        $this->set(compact('kit'));
    }

    public function cadastrarLocaliza() {
        set_time_limit(36000);
        if ($this->request->is('post')) {

            $this->request->data['Pedido']['situacao'] = 0;
            $this->request->data['Pedido']['usuario_id'] = $this->Session->read('Auth.User.id');
            $data = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Pedido']['created']))) . ' ' . date('H:i:s');
            $this->request->data['Pedido']['created'] = $data;
            $this->Pedido->create();
            if ($this->Pedido->save($this->request->data)) {

                foreach ($this->request->data['Produto']['id'] as $key => $produtos) {
                    $vp = str_replace('.', '', $this->request->data['Produto']['valor'][$key]);
                    $vp = str_replace(',', '.', $vp);

                    $this->request->data['Produtos'][$key]['pedido_id'] = $this->Pedido->getLastInsertID();
                    $this->request->data['Produtos'][$key]['kit_id'] = $this->request->data['Produto']['id'][$key];
                    $this->request->data['Produtos'][$key]['placa'] = $this->request->data['Produto']['placa'][$key];
                    $this->request->data['Produtos'][$key]['tarjeta'] = $this->request->data['Produto']['tarjeta'][$key];
                    $this->request->data['Produtos'][$key]['valor'] = $vp;
                    $this->request->data['Produtos'][$key]['entregue'] = 0;
                    $this->request->data['Produtos'][$key]['paga'] = 0;
                    $this->request->data['Produtos'][$key]['usuario_id'] = $this->Session->read('Auth.User.id');
                    $this->request->data['Produtos'][$key]['parcial'] = 0;
                    $this->request->data['Produtos'][$key]['producao'] = 0;
                    $this->request->data['Produtos'][$key]['created'] = $data;

                    $kit = $this->Kit->find('first', array(
                        'conditions' => array('Kit.id' => $this->request->data['Produto']['id'][$key]),
                        'contain' => array(
                            'Produto' => array('fields' => array('id')),
                        ),
                        'fields' => array('id')
                    ));

                    foreach ($kit['Produto'] as $produtos) {
                        $estoque = $this->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $produtos['id'], 'Estoque.unidade_id' => $this->request->data['Pedido']['unidade_id']), 'fields' => array('id', 'quantidade')));
                        $this->Estoque->id = $estoque['Estoque']['id'];
                        $this->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] - 1);

                        $this->request->data['Log'][] = array(
                            'tipo' => 1,
                            'produto_id' => $produtos['id'],
                            'quantidade' => 1,
                            'unidade_id' => $this->request->data['Pedido']['unidade_id'],
                            'transferencia' => 0,
                            'observacao' => $this->request->data['Pedido']['observacao'],
                            'pedido_id' => $this->Pedido->getLastInsertID(),
                            'usuario_id' => $this->Session->read('Auth.User.id'),
                            'created' => $data,
                        );
                    }
                }

                $this->LogEstoque->saveAll($this->request->data['Log']);
                $this->Pedido->KitsPedido->saveAll($this->request->data['Produtos']);

                $id = $this->Pedido->getLastInsertId();
                $this->set(compact('id'));
            } else {
                $this->Session->setFlash(__('The pedido could not be saved. Please, try again.'));
            }
        }
    }

}
