<?php

App::uses('AppController', 'Controller');

/**
 * LogEstoques Controller
 *
 * @property LogEstoque $LogEstoque
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LogEstoquesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $permissao['permissao']['setor'] = 4;
        $this->permissao($permissao);

        if ($this->request->is('post')) {
            if ($this->request->data['LogEstoque']['kit_id'] == '') {
                $estoque = $this->LogEstoque->Produto->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $this->request->data['LogEstoque']['produto_id'], 'Estoque.unidade_id' => $this->request->data['LogEstoque']['unidade_id']), 'fields' => array('id', 'quantidade')));
                if ($this->request->data['LogEstoque']['transferencia'] == 1) {
                    $this->LogEstoque->Produto->Estoque->id = $estoque['Estoque']['id'];
                    $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] + $this->request->data['LogEstoque']['quantidade']);

                    $this->request->data['Log'][] = array(
                        'tipo' => 0,
                        'produto_id' => $this->request->data['LogEstoque']['produto_id'],
                        'quantidade' => $this->request->data['LogEstoque']['quantidade'],
                        'unidade_id' => $this->request->data['LogEstoque']['unidade_id'],
                        'transferencia' => $this->request->data['LogEstoque']['transferencia'],
                        'observacoes' => $this->request->data['LogEstoque']['observacoes'],
                        'usuario_id' => $this->Session->read('Auth.User.id'),
                        'unidade_origen_destino' => $this->request->data['LogEstoque']['unidade_origen_destino'],
                    );
                    $estoque2 = $this->LogEstoque->Produto->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $this->request->data['LogEstoque']['produto_id'], 'Estoque.unidade_id' => $this->request->data['LogEstoque']['unidade_origen_destino']), 'fields' => array('id', 'quantidade')));
                    $this->LogEstoque->Produto->Estoque->id = $estoque2['Estoque']['id'];
                    $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque2['Estoque']['quantidade'] - $this->request->data['LogEstoque']['quantidade']);

                    $this->request->data['Log'][] = array(
                        'tipo' => 1,
                        'produto_id' => $this->request->data['LogEstoque']['produto_id'],
                        'quantidade' => $this->request->data['LogEstoque']['quantidade'],
                        'unidade_id' => $this->request->data['LogEstoque']['unidade_origen_destino'],
                        'transferencia' => $this->request->data['LogEstoque']['transferencia'],
                        'observacoes' => $this->request->data['LogEstoque']['observacoes'],
                        'usuario_id' => $this->Session->read('Auth.User.id'),
                        'unidade_origen_destino' => $this->request->data['LogEstoque']['unidade_id'],
                    );
                } else {
                    $this->LogEstoque->Produto->Estoque->id = $estoque['Estoque']['id'];
                    if ($this->request->data['LogEstoque']['tipo'] == 0) {
                        $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] + $this->request->data['LogEstoque']['quantidade']);
                    } else {
                        $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] - $this->request->data['LogEstoque']['quantidade']);
                    }
                    $this->request->data['Log'][] = array(
                        'tipo' => $this->request->data['LogEstoque']['tipo'],
                        'produto_id' => $this->request->data['LogEstoque']['produto_id'],
                        'quantidade' => $this->request->data['LogEstoque']['quantidade'],
                        'unidade_id' => $this->request->data['LogEstoque']['unidade_id'],
                        'transferencia' => $this->request->data['LogEstoque']['transferencia'],
                        'observacoes' => $this->request->data['LogEstoque']['observacoes'],
                        'usuario_id' => $this->Session->read('Auth.User.id'),
                    );
                }

                $this->LogEstoque->create();
                $this->LogEstoque->saveAll($this->request->data['Log']);
                $this->Session->setFlash(__('O produto foi ajustado com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'ajuste');
                return $this->redirect(array('action' => 'add'));
            } else {

                $kit = $this->LogEstoque->Produto->Kit->find('first', array(
                    'conditions' => array('Kit.id' => $this->request->data['LogEstoque']['kit_id']),
                    'contain' => array(
                        'Produto' => array('fields' => array('id')),
                    ),
                    'fields' => array('id')
                ));

                if ($this->request->data['LogEstoque']['transferencia'] == 1) {
                    foreach ($kit['Produto'] as $produtos) {
                        $estoque = $this->LogEstoque->Produto->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $produtos['id'], 'Estoque.unidade_id' => $this->request->data['LogEstoque']['unidade_id']), 'fields' => array('id', 'quantidade')));
                        $this->LogEstoque->Produto->Estoque->id = $estoque['Estoque']['id'];
                        $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] + $this->request->data['LogEstoque']['quantidade']);

                        $this->request->data['Log'][] = array(
                            'tipo' => 0,
                            'produto_id' => $produtos['id'],
                            'quantidade' => $this->request->data['LogEstoque']['quantidade'],
                            'unidade_id' => $this->request->data['LogEstoque']['unidade_id'],
                            'transferencia' => $this->request->data['LogEstoque']['transferencia'],
                            'observacoes' => $this->request->data['LogEstoque']['observacoes'],
                            'usuario_id' => $this->Session->read('Auth.User.id'),
                            'unidade_origen_destino' => $this->request->data['LogEstoque']['unidade_origen_destino'],
                        );

                        $estoque2 = $this->LogEstoque->Produto->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $produtos['id'], 'Estoque.unidade_id' => $this->request->data['LogEstoque']['unidade_origen_destino']), 'fields' => array('id', 'quantidade')));
                        $this->LogEstoque->Produto->Estoque->id = $estoque2['Estoque']['id'];
                        $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque2['Estoque']['quantidade'] - $this->request->data['LogEstoque']['quantidade']);

                        $this->request->data['Log'][] = array(
                            'tipo' => 1,
                            'produto_id' => $produtos['id'],
                            'quantidade' => $this->request->data['LogEstoque']['quantidade'],
                            'unidade_id' => $this->request->data['LogEstoque']['unidade_origen_destino'],
                            'transferencia' => $this->request->data['LogEstoque']['transferencia'],
                            'observacoes' => $this->request->data['LogEstoque']['observacoes'],
                            'usuario_id' => $this->Session->read('Auth.User.id'),
                            'unidade_origen_destino' => $this->request->data['LogEstoque']['unidade_id'],
                        );
                    }
                } else {
                    foreach ($kit['Produto'] as $produtos) {
                        $estoque = $this->LogEstoque->Produto->Estoque->find('first', array('conditions' => array('Estoque.produto_id' => $produtos['id'], 'Estoque.unidade_id' => $this->request->data['LogEstoque']['unidade_id']), 'fields' => array('id', 'quantidade')));
                        $this->LogEstoque->Produto->Estoque->id = $estoque['Estoque']['id'];
                        if ($this->request->data['LogEstoque']['tipo'] == 0) {
                            $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] + $this->request->data['LogEstoque']['quantidade']);
                        } else {
                            $this->LogEstoque->Produto->Estoque->saveField('quantidade', $estoque['Estoque']['quantidade'] - $this->request->data['LogEstoque']['quantidade']);
                        }

                        $this->request->data['Log'][] = array(
                            'tipo' => $this->request->data['LogEstoque']['tipo'],
                            'produto_id' => $produtos['id'],
                            'quantidade' => $this->request->data['LogEstoque']['quantidade'],
                            'unidade_id' => $this->request->data['LogEstoque']['unidade_id'],
                            'transferencia' => $this->request->data['LogEstoque']['transferencia'],
                            'observacoes' => $this->request->data['LogEstoque']['observacoes'],
                            'usuario_id' => $this->Session->read('Auth.User.id'),
                        );
                    }
                }

                $this->LogEstoque->create();
                $this->LogEstoque->saveAll($this->request->data['Log']);
                $this->Session->setFlash(__('O Kit foi ajustado com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'ajuste');
                return $this->redirect(array('action' => 'add'));
            }
        }

        $produtos = $this->LogEstoque->Produto->find('list');
        $kits = $this->LogEstoque->Produto->Kit->find('list');
        $unidades = $this->LogEstoque->Unidade->find('list');
        $this->set(compact('produtos', 'usuarios', 'unidades', 'kits'));
    }

    public function produtos() {
        
    }

    public function gerarProdutos() {
        $this->viewClass = 'Json';

        $this->Session->write('LogEstoque.Produtos', $this->request->data['LogEstoque']);

        $this->request->data['LogEstoque']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataInicial'])));
        $this->request->data['LogEstoque']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataFinal'])));
        $cliente = NULL;
        if ($this->request->data['LogEstoque']['cliente_id'] != '') {
            $cliente = 'Pedido.cliente_id = ' . $this->request->data['LogEstoque']['cliente_id'];
        }

        $log = $this->LogEstoque->find('all', array(
            'conditions' => array(
                "pedido_id != ''",
                "cast(LogEstoque.created as date) BETWEEN '{$this->request->data['LogEstoque']['dataInicial']}' AND '{$this->request->data['LogEstoque']['dataFinal']}'",
                "LogEstoque.tipo" => 1,
                "LogEstoque.unidade_id" => $this->request->data['LogEstoque']['unidade_id'],
                $cliente
            ),
            'joins' => array(
                array(
                    'table' => 'pedidos',
                    'alias' => 'Pedido',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Pedido.id = LogEstoque.pedido_id',
                    )
                )
            ),
            'group' => 'LogEstoque.produto_id',
            'fields' => array('sum(LogEstoque.quantidade) AS pTotal', 'id', 'produto_id', 'quantidade', 'pedido_id', 'Pedido.cliente_id', 'Pedido.id'),
            'contain' => array(
                'Produto' => array('fields' => array('nome')),
            )
        ));

        $this->set('data', $log);
        $this->set('_serialize', 'data');
    }

    public function pimprimir() {
        $this->layout = 'imprimir';

        $this->request->data['LogEstoque']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('LogEstoque.Produtos.dataInicial'))));
        $this->request->data['LogEstoque']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('LogEstoque.Produtos.dataFinal'))));
        $cliente = NULL;
        if ($this->Session->read('LogEstoque.Produtos.cliente_id') != '') {
            $cliente = 'Pedido.cliente_id = ' . $this->Session->read('LogEstoque.Produtos.cliente_id');
        }
        $log = $this->LogEstoque->find('all', array(
            'conditions' => array(
                "pedido_id != ''",
                "cast(LogEstoque.created as date) BETWEEN '{$this->request->data['LogEstoque']['dataInicial']}' AND '{$this->request->data['LogEstoque']['dataFinal']}'",
                "LogEstoque.tipo" => 1,
                "LogEstoque.unidade_id" => $this->Session->read('LogEstoque.Produtos.unidade_id'),
                $cliente
            ),
            'joins' => array(
                array(
                    'table' => 'pedidos',
                    'alias' => 'Pedido',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Pedido.id = LogEstoque.pedido_id',
                    )
                )
            ),
            'group' => 'LogEstoque.produto_id',
            'fields' => array('sum(LogEstoque.quantidade) AS pTotal', 'id', 'produto_id', 'quantidade'),
            'contain' => array(
                'Produto' => array('fields' => array('nome')),
            )
        ));

        $unidade = $this->LogEstoque->Unidade->find('first', array(
            'conditions' => array('Unidade.id' => $this->Session->read('LogEstoque.Produtos.unidade_id')),
            'recursive' => -1,
            'fields' => array('nome')
        ));

        $titulo = 'Relatorio de Produtos';
        $this->set(compact('log', 'unidade', 'titulo'));
    }

    public function excelProdutos() {
        $this->layout = 'export_xls';

        $this->request->data['LogEstoque']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('LogEstoque.Produtos.dataInicial'))));
        $this->request->data['LogEstoque']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('LogEstoque.Produtos.dataFinal'))));
        $cliente = NULL;
        if ($this->Session->read('LogEstoque.Produtos.cliente_id') != '') {
            $cliente = 'Pedido.cliente_id = ' . $this->Session->read('LogEstoque.Produtos.cliente_id');
        }
        $log = $this->LogEstoque->find('all', array(
            'conditions' => array(
                "pedido_id != ''",
                "cast(LogEstoque.created as date) BETWEEN '{$this->request->data['LogEstoque']['dataInicial']}' AND '{$this->request->data['LogEstoque']['dataFinal']}'",
                "LogEstoque.tipo" => 1,
                "LogEstoque.unidade_id" => $this->Session->read('LogEstoque.Produtos.unidade_id'),
                'Pedido.cliente_id' => $this->Session->read('LogEstoque.Produtos.cliente_id')
            ),
            'joins' => array(
                array(
                    'table' => 'pedidos',
                    'alias' => 'Pedido',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Pedido.id = LogEstoque.pedido_id',
                    )
                )
            ),
            'group' => 'LogEstoque.produto_id',
            'fields' => array('sum(LogEstoque.quantidade) AS pTotal', 'id', 'produto_id', 'quantidade'),
            'contain' => array(
                'Produto' => array('fields' => array('nome')),
            )
        ));

        $unidade = $this->LogEstoque->Unidade->find('first', array(
            'conditions' => array('Unidade.id' => $this->Session->read('LogEstoque.Produtos.unidade_id')),
            'recursive' => -1,
            'fields' => array('nome')
        ));

        $this->set(compact('log', 'unidade', 'titulo'));
    }

    public function movimento() {
        $produtos = $this->LogEstoque->Produto->find('list');
        $this->set(compact('produtos'));
    }

    public function gerarMovimento() {
        $this->viewClass = 'Json';

        $this->Session->write('LogEstoque.Movimento', $this->request->data['LogEstoque']);

        if ($this->request->data['LogEstoque']['produto_id'] != '') {
            $conditions[] = "LogEstoque.produto_id = " . $this->request->data['LogEstoque']['produto_id'];
        }

        if ($this->request->data['LogEstoque']['unidade_id'] != '') {
            $conditions[] = "LogEstoque.unidade_id = " . $this->request->data['LogEstoque']['unidade_id'];
        }

        if ($this->request->data['LogEstoque']['tipo'] != '' AND $this->request->data['LogEstoque']['tipo'] != 2) {
            $conditions[] = "LogEstoque.tipo = " . $this->request->data['LogEstoque']['tipo'];
        } else if ($this->request->data['LogEstoque']['tipo'] == 2) {
            $conditions[] = "LogEstoque.transferencia = 1";
        }

        if ($this->request->data['LogEstoque']['dataInicial'] != '' AND $this->request->data['LogEstoque']['dataFinal'] != '') {
            $this->request->data['LogEstoque']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataInicial'])));
            $this->request->data['LogEstoque']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataFinal'])));
            $conditions[] = "cast(LogEstoque.created as date) BETWEEN '{$this->request->data['LogEstoque']['dataInicial']}' AND '{$this->request->data['LogEstoque']['dataFinal']}'";
        }

        $log = $this->LogEstoque->find('all', array(
            'conditions' => $conditions,
            'fields' => array('quantidade', 'tipo', 'transferencia', 'unidade_origen_destino'),
            'contain' => array(
                'UnidadeOrigenDestino' => array('fields' => array('nome')),
                'Produto' => array('fields' => array('nome')),
            )
        ));

        $this->set('data', $log);
        $this->set('_serialize', 'data');
    }

    public function mimprimir() {
        $this->layout = 'imprimir';

        $this->request->data['LogEstoque'] = $this->Session->read('LogEstoque.Movimento');

        if ($this->request->data['LogEstoque']['produto_id'] != '') {
            $conditions[] = "LogEstoque.produto_id = " . $this->request->data['LogEstoque']['produto_id'];
            $produtos = $this->LogEstoque->Produto->find('first', array(
                'conditions' => array('Produto.id' => $this->request->data['LogEstoque']['produto_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $produto = $produtos['Produto']['nome'];
        } else {
            $produto = 'Todos';
        }

        if ($this->request->data['LogEstoque']['unidade_id'] != '') {
            $conditions[] = "LogEstoque.unidade_id = " . $this->request->data['LogEstoque']['unidade_id'];
            $unidades = $this->LogEstoque->Unidade->find('first', array(
                'conditions' => array('Unidade.id' => $this->request->data['LogEstoque']['unidade_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $unidade = $unidades['Unidade']['nome'];
        } else {
            $unidade = 'Todas';
        }

        if ($this->request->data['LogEstoque']['tipo'] != '' AND $this->request->data['LogEstoque']['tipo'] != 2) {
            $conditions[] = "LogEstoque.tipo = " . $this->request->data['LogEstoque']['tipo'];
            $tipo = $this->request->data['LogEstoque']['tipo'] == 0 ? 'Adição' : 'Baixa';
        } else if ($this->request->data['LogEstoque']['tipo'] == 2) {
            $conditions[] = "LogEstoque.transferencia = 1";
            $tipo = 'Transferência';
        } else {
            $tipo = 'Todas';
        }

        if ($this->request->data['LogEstoque']['dataInicial'] != '' AND $this->request->data['LogEstoque']['dataFinal'] != '') {
            $this->request->data['LogEstoque']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataInicial'])));
            $this->request->data['LogEstoque']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataFinal'])));
            $conditions[] = "cast(LogEstoque.created as date) BETWEEN '{$this->request->data['LogEstoque']['dataInicial']}' AND '{$this->request->data['LogEstoque']['dataFinal']}'";
        }

        $log = $this->LogEstoque->find('all', array(
            'conditions' => $conditions,
            'fields' => array('quantidade', 'tipo', 'transferencia', 'unidade_origen_destino'),
            'contain' => array(
                'UnidadeOrigenDestino' => array('fields' => array('nome')),
                'Produto' => array('fields' => array('nome')),
            )
        ));


        $titulo = 'Relatorio de Movimento de Estoque';
        $this->set(compact('log', 'unidade', 'titulo', 'produto', 'tipo'));
    }

    public function excelMovimento() {
        $this->layout = 'export_xls';

        $this->request->data['LogEstoque'] = $this->Session->read('LogEstoque.Movimento');

        if ($this->request->data['LogEstoque']['produto_id'] != '') {
            $conditions[] = "LogEstoque.produto_id = " . $this->request->data['LogEstoque']['produto_id'];
            $produtos = $this->LogEstoque->Produto->find('first', array(
                'conditions' => array('Produto.id' => $this->request->data['LogEstoque']['produto_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $produto = $produtos['Produto']['nome'];
        } else {
            $produto = 'Todos';
        }

        if ($this->request->data['LogEstoque']['unidade_id'] != '') {
            $conditions[] = "LogEstoque.unidade_id = " . $this->request->data['LogEstoque']['unidade_id'];
            $unidades = $this->LogEstoque->Unidade->find('first', array(
                'conditions' => array('Unidade.id' => $this->request->data['LogEstoque']['unidade_id']),
                'recursive' => -1,
                'fields' => array('nome')
            ));
            $unidade = $unidades['Unidade']['nome'];
        } else {
            $unidade = 'Todas';
        }

        if ($this->request->data['LogEstoque']['tipo'] != '' AND $this->request->data['LogEstoque']['tipo'] != 2) {
            $conditions[] = "LogEstoque.tipo = " . $this->request->data['LogEstoque']['tipo'];
            $tipo = $this->request->data['LogEstoque']['tipo'] == 0 ? 'Adição' : 'Baixa';
        } else if ($this->request->data['LogEstoque']['tipo'] == 2) {
            $conditions[] = "LogEstoque.transferencia = 1";
            $tipo = 'Transferência';
        } else {
            $tipo = 'Todas';
        }

        if ($this->request->data['LogEstoque']['dataInicial'] != '' AND $this->request->data['LogEstoque']['dataFinal'] != '') {
            $this->request->data['LogEstoque']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataInicial'])));
            $this->request->data['LogEstoque']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['LogEstoque']['dataFinal'])));
            $conditions[] = "cast(LogEstoque.created as date) BETWEEN '{$this->request->data['LogEstoque']['dataInicial']}' AND '{$this->request->data['LogEstoque']['dataFinal']}'";
        }

        $log = $this->LogEstoque->find('all', array(
            'conditions' => $conditions,
            'fields' => array('quantidade', 'tipo', 'transferencia', 'unidade_origen_destino'),
            'contain' => array(
                'UnidadeOrigenDestino' => array('fields' => array('nome')),
                'Produto' => array('fields' => array('nome')),
            )
        ));


        $titulo = 'Relatorio de Movimento de Estoque';
        $this->set(compact('log', 'unidade', 'titulo', 'produto', 'tipo'));
    }

}
