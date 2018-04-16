<?php

App::uses('AppController', 'Controller');

/**
 * Estoques Controller
 *
 * @property Estoque $Estoque
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EstoquesController extends AppController {

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

        $permissao['permissao']['setor'] = 4;
        $this->permissao($permissao);

        if ($this->request->is('post')) {

            $this->Session->write('Estoque.visualizar', $this->request->data);
            $estoques = $this->Estoque->find('all', array(
                'contain' => array(
                    'Produto' => array('fields' => array('nome', 'minimo', 'valor')),
                ),
                'conditions' => array('Estoque.unidade_id' => $this->request->data['Estoque']['unidade_id'], 'quantidade > 0'),
                'limit' => '',
                'fields' => array('id', 'quantidade', 'produto_id')
            ));

            $this->set('estoques', $estoques);
        }
    }

    public function imprimir() {

        $this->layout = 'imprimir';

        $estoques = $this->Estoque->find('all', array(
            'contain' => array(
                'Produto' => array('fields' => array('nome', 'minimo', 'valor')),
            ),
            'conditions' => array('Estoque.unidade_id' => $this->Session->read('Estoque.visualizar.Estoque.unidade_id')),
            'limit' => '',
            'fields' => array('id', 'quantidade', 'produto_id')
        ));

        $this->set('estoques', $estoques);

        $unidade = $this->Estoque->Unidade->find('first', array(
            'conditions' => array('Unidade.id' => $this->Session->read('Estoque.visualizar.Estoque.unidade_id')),
            'recursive' => -1,
            'fields' => 'nome'
        ));
        $titulo = 'Relatório de Estoque';
        $this->set(compact('unidade', 'titulo', 'estoques'));
    }

    public function controle() {
        
    }

    public function gerarControle() {

//        $x = $this->find('first', array(
//            'contain' => array(
//                'User' => array(
//                    'SelectionsTeam' => array('conditions' => $conditionTeamSelection,
//                        'Team' => array(
//                            'fields' => array('name', 'city', 'id'),
//                            'TeamsStat' => $condition,
//                        ),
//                        'PointsHistory' => array('fields' => array('SUM(points) total_points'))
//                    ),
//                ),
//                'conditions' => array('id' => $id)
//            )
//        ));

        $this->viewClass = 'Json';

        $estoques = $this->Estoque->find('all', array(
            'contain' => array(
                'Produto' => array('fields' => array('nome')),
            ),
            'conditions' => array('Estoque.unidade_id' => $this->request->query['data']['Estoque']['unidade_id']),
            'limit' => '',
            'fields' => array('id', 'quantidade', 'produto_id')
        ));

        $baixas = $this->Estoque->Produto->find('all', array(
            'contain' => array(
                'LogEstoque' => array(
                    'conditions' => array('LogEstoque.unidade_id' => $this->request->query['data']['Estoque']['unidade_id'], 'tipo' => 0),
//                    'fields' => array('sum(quantidade) Bqua'),
                ),
                'LogEstoque' => array(
                    'conditions' => array('LogEstoque.unidade_id' => $this->request->query['data']['Estoque']['unidade_id'], 'tipo' => 1),
//                    'fields' => array('sum(quantidade) Bqua'),
                ),
            ),
            'fields' => array('id', 'nome')
        ));

//        $baixas = $this->Estoque->Produto->LogEstoque->find('all', array(
//            'conditions' => array('LogEstoque.unidade_id' => $this->request->query['data']['Estoque']['unidade_id'], 'tipo' => 1),
//            'fields' => array('id', 'sum(LogEstoque.quantidade) as Bqua'),
//            'group' => 'LogEstoque.produto_id',
//            'recursive' => -1
//        ));

        $this->set('data', $baixas);
        $this->set('_serialize', 'data');
    }

}
