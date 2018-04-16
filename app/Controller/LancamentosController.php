<?php

App::uses('AppController', 'Controller');

/**
 * Lancamentos Controller
 *
 * @property Lancamento $Lancamento
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LancamentosController extends AppController {

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

        $this->paginate = array('conditions' => array('or' => array(
                    "Lancamentos.id == 1",
        )));

        $this->Lancamento->recursive = 0;
        $this->set('lancamentos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Lancamento->exists($id)) {
            throw new NotFoundException(__('Invalid lancamento'));
        }
        $options = array('conditions' => array('Lancamento.' . $this->Lancamento->primaryKey => $id));
        $this->request->data = $this->Lancamento->find('first', $options);
        $this->request->data['Lancamento']['valor'] = number_format($this->request->data['Lancamento']['valor'], 2, ',', '.');
        $this->request->data['Lancamento']['valor_p'] = number_format($this->request->data['Lancamento']['valor_p'], 2, ',', '.');
        $this->request->data['Lancamento']['data'] = date('d/m/Y', strtotime($this->request->data['Lancamento']['data']));
        $tipoPagamentos = $this->Lancamento->TipoPagamento->find('list', array('order' => 'nome ASC'));
        $planoContas = $this->Lancamento->PlanoConta->find('list', array('order' => 'nome ASC'));
        $unidadeGeradoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%1%"), 'order' => 'nome ASC'));
        $unidadePagadoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%2%"), 'order' => 'nome ASC'));
        $unidadeRecebedoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%3%"), 'order' => 'nome ASC'));
        $this->set(compact('tipoPagamentos', 'planoContas', 'unidades', 'usuarios', 'unidadeGeradoras', 'unidadePagadoras', 'unidadeRecebedoras', 'id'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $permissao['permissao']['setor'] = 2;
        $this->permissao($permissao);

        if ($this->request->is('post')) {

            if ($this->request->data['Lancamento']['valor']) {
                $this->request->data['Lancamento']['valor'] = str_replace('.', '', $this->request->data['Lancamento']['valor']);
                $this->request->data['Lancamento']['valor'] = str_replace(',', '.', $this->request->data['Lancamento']['valor']);
            }

            if ($this->request->data['Lancamento']['valor_p']) {
                $this->request->data['Lancamento']['valor_p'] = str_replace('.', '', $this->request->data['Lancamento']['valor_p']);
                $this->request->data['Lancamento']['valor_p'] = str_replace(',', '.', $this->request->data['Lancamento']['valor_p']);
            }

            $this->request->data['Lancamento']['data'] = $this->request->data['Lancamento']['data'];
            $this->request->data['Lancamento']['data'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['data'])));

            $this->Lancamento->create();
            if ($this->Lancamento->save($this->request->data)) {
                $this->Session->setFlash(__('The lancamento has been saved.'));
                return $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('The lancamento could not be saved. Please, try again.'));
            }
        }
        $id = $this->Lancamento->find('first', array('order' => 'id DESC', 'fields' => 'id'));
        $tipoPagamentos = $this->Lancamento->TipoPagamento->find('list', array('order' => 'nome ASC'));
        $planoContas = $this->Lancamento->PlanoConta->find('list', array('order' => 'nome ASC'));
        $unidadeGeradoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%1%"), 'order' => 'nome ASC'));
        $unidadePagadoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%2%"), 'order' => 'nome ASC'));
        $unidadeRecebedoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%3%"), 'order' => 'nome ASC'));
        $this->set(compact('tipoPagamentos', 'planoContas', 'unidades', 'usuarios', 'unidadeGeradoras', 'unidadePagadoras', 'unidadeRecebedoras', 'id'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Lancamento->exists($id)) {
            throw new NotFoundException(__('Invalid lancamento'));
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->request->data['Lancamento']['valor']) {
                $this->request->data['Lancamento']['valor'] = str_replace('.', '', $this->request->data['Lancamento']['valor']);
                $this->request->data['Lancamento']['valor'] = str_replace(',', '.', $this->request->data['Lancamento']['valor']);
            }

            if ($this->request->data['Lancamento']['valor_p']) {
                $this->request->data['Lancamento']['valor_p'] = str_replace('.', '', $this->request->data['Lancamento']['valor_p']);
                $this->request->data['Lancamento']['valor_p'] = str_replace(',', '.', $this->request->data['Lancamento']['valor_p']);
            }

            $this->request->data['Lancamento']['data'] = $this->request->data['Lancamento']['data'];
            $this->request->data['Lancamento']['data'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['data'])));

            if ($this->Lancamento->save($this->request->data)) {
                $this->Session->setFlash(__('Lançamento Alterado com sucesso'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'lancamentoE');
                return $this->redirect('/lancamentos/edit/' . $id);
            } else {
                $this->Session->setFlash(__('The lancamento could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Lancamento.' . $this->Lancamento->primaryKey => $id));
            $this->request->data = $this->Lancamento->find('first', $options);
        }
        $this->request->data = $this->Lancamento->find('first', $options);
        $this->request->data['Lancamento']['valor'] = number_format($this->request->data['Lancamento']['valor'], 2, ',', '.');
        $this->request->data['Lancamento']['valor_p'] = number_format($this->request->data['Lancamento']['valor_p'], 2, ',', '.');
        $this->request->data['Lancamento']['data'] = date('d/m/Y', strtotime($this->request->data['Lancamento']['data']));
        $tipoPagamentos = $this->Lancamento->TipoPagamento->find('list', array('order' => 'nome ASC'));
        $planoContas = $this->Lancamento->PlanoConta->find('list', array('order' => 'nome ASC'));
        $unidadeGeradoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%1%"), 'order' => 'nome ASC'));
        $unidadePagadoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%2%"), 'order' => 'nome ASC'));
        $unidadeRecebedoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%3%"), 'order' => 'nome ASC'));
        $this->set(compact('tipoPagamentos', 'planoContas', 'unidades', 'usuarios', 'unidadeGeradoras', 'unidadePagadoras', 'unidadeRecebedoras', 'id'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Lancamento->id = $id;
        if (!$this->Lancamento->exists()) {
            throw new NotFoundException(__('Invalid lancamento'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Lancamento->delete($id)) {
                $this->Session->setFlash(__('Lançamento deletado com sucesso'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'lancamentoB');
            } else {
                $this->Session->setFlash(__('The lancamento could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'busca'));
        }
        $this->set(compact('id'));
    }

    public function busca() {
        $tipoPagamentos = $this->Lancamento->TipoPagamento->find('list', array('order' => 'nome ASC'));
        $planoContas = $this->Lancamento->PlanoConta->find('list', array('order' => 'nome ASC'));
        $unidadeGeradoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%1%"), 'order' => 'nome ASC'));
        $this->set(compact('tipoPagamentos', 'planoContas', 'unidades', 'unidadeGeradoras'));
    }

    public function buscar() {
        $this->viewClass = 'Json';

        if ($this->request->data['Lancamento']['id'] != '') {
            $conditions[] = "Lancamento.id = '" . $this->request->data['Lancamento']['id'] . "'";
        }
        if ($this->request->data['Lancamento']['operacao'] != '') {
            $conditions[] = "Lancamento.operacao = '" . $this->request->data['Lancamento']['operacao'] . "'";
        }
        if ($this->request->data['Lancamento']['plano_conta_id'] != '') {
            $conditions[] = "Lancamento.plano_conta_id = '" . $this->request->data['Lancamento']['plano_conta_id'] . "'";
        }
        if ($this->request->data['Lancamento']['tipo_pagamento_id'] != '') {
            $conditions[] = "Lancamento.tipo_pagamento_id = '" . $this->request->data['Lancamento']['tipo_pagamento_id'] . "'";
        }
        if ($this->request->data['Lancamento']['unidade_geradora'] != '') {
            $conditions[] = "Lancamento.unidade_geradora = '" . $this->request->data['Lancamento']['unidade_geradora'] . "'";
        }
        if ($this->request->data['Lancamento']['valor'] != '') {
            $this->request->data['Lancamento']['valor'] = str_replace('.', '', $this->request->data['Lancamento']['valor']);
            $this->request->data['Lancamento']['valor'] = str_replace(',', '.', $this->request->data['Lancamento']['valor']);
            $conditions[] = "Lancamento.valor = '" . $this->request->data['Lancamento']['valor'] . "'";
        }
        if ($this->request->data['Lancamento']['dataInicial'] != '' AND $this->request->data['Lancamento']['dataFinal'] != '') {
            $this->request->data['Lancamento']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['dataInicial'])));
            $this->request->data['Lancamento']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['dataFinal'])));
            $conditions[] = "Lancamento.data BETWEEN '{$this->request->data['Lancamento']['dataInicial']}' AND '{$this->request->data['Lancamento']['dataFinal']}'";
        }

        $this->paginate = array('conditions' => $conditions,
            'fields' => array('id', 'valor', 'operacao', 'historico', 'data', 'plano_conta_id', 'unidade_geradora', 'tipo_pagamento_id', 'UnidadesLancamento.*'),
            'contain' => array(
                'PlanoConta' => array('fields' => array('nome')),
                'TipoPagamento' => array('fields' => array('nome')),
            ),
            'joins' => array(
                array(
                    'table' => 'unidades_lancamentos',
                    'alias' => 'UnidadesLancamento',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Lancamento.unidade_geradora' => 'UnidadesLancamento.id'
                    )
                ),
            )
        );
        $this->Lancamento->recursive = 0;

        $this->set('data', $this->Paginator->paginate());
        $this->set('_serialize', 'data');
    }

    public function detalhado() {
        $tipoPagamentos = $this->Lancamento->TipoPagamento->find('list', array('order' => 'nome ASC'));
        $planoContas = $this->Lancamento->PlanoConta->find('list', array('order' => 'nome ASC'));
        $unidadeGeradoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%1%"), 'order' => 'nome ASC'));
        $this->set(compact('tipoPagamentos', 'planoContas', 'unidades', 'unidadeGeradoras'));
    }

    public function gerarDetalhado() {
        $this->viewClass = 'Json';

        $this->Session->write('Lancamentos.Detalhado', $this->request->data['Lancamento']);

        if ($this->request->data['Lancamento']['operacao'] != '') {
            $conditions[] = "Lancamento.operacao = '" . $this->request->data['Lancamento']['operacao'] . "'";
        }
        if ($this->request->data['Lancamento']['plano_conta_id'] != '') {
            $conditions[] = "Lancamento.plano_conta_id = '" . $this->request->data['Lancamento']['plano_conta_id'] . "'";
        }
        if ($this->request->data['Lancamento']['unidade_geradora'] != '') {
            $conditions[] = "Lancamento.unidade_geradora = '" . $this->request->data['Lancamento']['unidade_geradora'] . "'";
        }
        if ($this->request->data['Lancamento']['dataInicial'] != '' AND $this->request->data['Lancamento']['dataFinal'] != '') {
            $this->request->data['Lancamento']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['dataInicial'])));
            $this->request->data['Lancamento']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['dataFinal'])));
            $conditions[] = "Lancamento.data BETWEEN '{$this->request->data['Lancamento']['dataInicial']}' AND '{$this->request->data['Lancamento']['dataFinal']}'";
        }

        $lancamentos['Lan'] = $this->Lancamento->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'valor', 'operacao', 'data', 'plano_conta_id', 'unidade_geradora', 'tipo_pagamento_id', 'historico'),
            'contain' => array(
                'PlanoConta' => array('fields' => array('nome')),
                'TipoPagamento' => array('fields' => array('nome')),
            ),
        ));

        $lancamentos['Uni'] = $this->Lancamento->UnidadesLancamento->find('list');
        $lancamentos['Op'] = $this->request->data['Lancamento']['operacao'];

        $this->Lancamento->recursive = 0;

        $this->set('data', $lancamentos);
        $this->set('_serialize', 'data');
    }

    public function dimprimir() {
        $this->layout = 'imprimir';

        if ($this->Session->read('Lancamentos.Detalhado.operacao') != '') {
            $conditions[] = "Lancamento.operacao = '" . $this->Session->read('Lancamentos.Detalhado.operacao') . "'";
        }
        if ($this->Session->read('Lancamentos.Detalhado.plano_conta_id') != '') {
            $conditions[] = "Lancamento.plano_conta_id = '" . $this->Session->read('Lancamentos.Detalhado.plano_conta_id') . "'";
        }
        if ($this->Session->read('Lancamentos.Detalhado.unidade_geradora') != '') {
            $conditions[] = "Lancamento.unidade_geradora = '" . $this->Session->read('Lancamentos.Detalhado.unidade_geradora') . "'";
        }
        if ($this->Session->read('Lancamentos.Detalhado.dataInicial') != '' AND $this->Session->read('Lancamentos.Detalhado.dataFinal') != '') {
            $this->request->data['Lancamento']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Detalhado.dataInicial'))));
            $this->request->data['Lancamento']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Detalhado.dataFinal'))));
            $conditions[] = "Lancamento.data BETWEEN '{$this->request->data['Lancamento']['dataInicial']}' AND '{$this->request->data['Lancamento']['dataFinal']}'";
        }

        $lancamentos['Lan'] = $this->Lancamento->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'valor', 'operacao', 'data', 'plano_conta_id', 'unidade_geradora', 'tipo_pagamento_id', 'historico'),
            'contain' => array(
                'PlanoConta' => array('fields' => array('nome')),
                'TipoPagamento' => array('fields' => array('nome')),
            ),
        ));

        $lancamentos['Uni'] = $this->Lancamento->UnidadesLancamento->find('list');
        $op = ['', 'Saída', 'Entrada', 'Transferência'];
        $lancamentos['Op'] = $op[$this->Session->read('Lancamentos.Detalhado.operacao')];

        $this->Lancamento->recursive = 0;

        $titulo = 'Relatorio de Lançamentos Detalhado';
        $this->set(compact('lancamentos', 'titulo'));
    }
    
    public function excelDetalhado() {
        $this->layout = 'export_xls';

        if ($this->Session->read('Lancamentos.Detalhado.operacao') != '') {
            $conditions[] = "Lancamento.operacao = '" . $this->Session->read('Lancamentos.Detalhado.operacao') . "'";
        }
        if ($this->Session->read('Lancamentos.Detalhado.plano_conta_id') != '') {
            $conditions[] = "Lancamento.plano_conta_id = '" . $this->Session->read('Lancamentos.Detalhado.plano_conta_id') . "'";
        }
        if ($this->Session->read('Lancamentos.Detalhado.unidade_geradora') != '') {
            $conditions[] = "Lancamento.unidade_geradora = '" . $this->Session->read('Lancamentos.Detalhado.unidade_geradora') . "'";
        }
        if ($this->Session->read('Lancamentos.Detalhado.dataInicial') != '' AND $this->Session->read('Lancamentos.Detalhado.dataFinal') != '') {
            $this->request->data['Lancamento']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Detalhado.dataInicial'))));
            $this->request->data['Lancamento']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Detalhado.dataFinal'))));
            $conditions[] = "Lancamento.data BETWEEN '{$this->request->data['Lancamento']['dataInicial']}' AND '{$this->request->data['Lancamento']['dataFinal']}'";
        }

        $lancamentos['Lan'] = $this->Lancamento->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'valor', 'operacao', 'data', 'plano_conta_id', 'unidade_geradora', 'tipo_pagamento_id', 'historico'),
            'contain' => array(
                'PlanoConta' => array('fields' => array('nome')),
                'TipoPagamento' => array('fields' => array('nome')),
            ),
        ));

        $lancamentos['Uni'] = $this->Lancamento->UnidadesLancamento->find('list');
        $op = ['', 'Saída', 'Entrada', 'Transferência'];
        $lancamentos['Op'] = $op[$this->Session->read('Lancamentos.Detalhado.operacao')];

        $this->Lancamento->recursive = 0;

        $this->set(compact('lancamentos'));
    }
    
    public function consolidado() {
        $tipoPagamentos = $this->Lancamento->TipoPagamento->find('list', array('order' => 'nome ASC'));
        $planoContas = $this->Lancamento->PlanoConta->find('list', array('order' => 'nome ASC'));
        $unidadeGeradoras = $this->Lancamento->UnidadesLancamento->find('list', array('conditions' => array('UnidadesLancamento.tipo LIKE' => "%1%"), 'order' => 'nome ASC'));
        $this->set(compact('tipoPagamentos', 'planoContas', 'unidades', 'unidadeGeradoras'));
    }
    
    public function gerarConsolidado() {
        $this->viewClass = 'Json';

        $this->Session->write('Lancamentos.Consolidado', $this->request->data['Lancamento']);

        if ($this->request->data['Lancamento']['operacao'] != '') {
            $conditions[] = "Lancamento.operacao = '" . $this->request->data['Lancamento']['operacao'] . "'";
        }
        if ($this->request->data['Lancamento']['plano_conta_id'] != '') {
            $conditions[] = "Lancamento.plano_conta_id = '" . $this->request->data['Lancamento']['plano_conta_id'] . "'";
        }
        if ($this->request->data['Lancamento']['unidade_geradora'] != '') {
            $conditions[] = "Lancamento.unidade_geradora = '" . $this->request->data['Lancamento']['unidade_geradora'] . "'";
        }
        if ($this->request->data['Lancamento']['dataInicial'] != '' AND $this->request->data['Lancamento']['dataFinal'] != '') {
            $this->request->data['Lancamento']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['dataInicial'])));
            $this->request->data['Lancamento']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Lancamento']['dataFinal'])));
            $conditions[] = "Lancamento.data BETWEEN '{$this->request->data['Lancamento']['dataInicial']}' AND '{$this->request->data['Lancamento']['dataFinal']}'";
        }

        $lancamentos['Lan'] = $this->Lancamento->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'format(sum(Lancamento.valor),2,"de_DE") as vTotal', 'valor', 'operacao', 'data', 'plano_conta_id', 'unidade_geradora'),
            'group' => 'Lancamento.plano_conta_id',
            'contain' => array(
                'PlanoConta' => array('fields' => array('nome')),
                'TipoPagamento' => array('fields' => array('nome')),
            ),
        ));

        $lancamentos['Uni'] = $this->Lancamento->UnidadesLancamento->find('list');
        $lancamentos['Op'] = $this->request->data['Lancamento']['operacao'];

        $this->Lancamento->recursive = 0;

        $this->set('data', $lancamentos);
        $this->set('_serialize', 'data');
    }
    
    public function cimprimir() {
        $this->layout = 'imprimir';

        if ($this->Session->read('Lancamentos.Consolidado.operacao') != '') {
            $conditions[] = "Lancamento.operacao = '" . $this->Session->read('Lancamentos.Consolidado.operacao') . "'";
        }
        if ($this->Session->read('Lancamentos.Consolidado.plano_conta_id') != '') {
            $conditions[] = "Lancamento.plano_conta_id = '" . $this->Session->read('Lancamentos.Consolidado.plano_conta_id') . "'";
        }
        if ($this->Session->read('Lancamentos.Consolidado.unidade_geradora') != '') {
            $conditions[] = "Lancamento.unidade_geradora = '" . $this->Session->read('Lancamentos.Consolidado.unidade_geradora') . "'";
        }
        if ($this->Session->read('Lancamentos.Consolidado.dataInicial') != '' AND $this->Session->read('Lancamentos.Consolidado.dataFinal') != '') {
            $this->request->data['Lancamento']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Consolidado.dataInicial'))));
            $this->request->data['Lancamento']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Consolidado.dataFinal'))));
            $conditions[] = "Lancamento.data BETWEEN '{$this->request->data['Lancamento']['dataInicial']}' AND '{$this->request->data['Lancamento']['dataFinal']}'";
        }

        $lancamentos['Lan'] = $this->Lancamento->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'format(sum(Lancamento.valor),2,"de_DE") as vTotal', 'valor', 'operacao', 'data', 'plano_conta_id', 'unidade_geradora'),
            'group' => 'Lancamento.plano_conta_id',
            'contain' => array(
                'PlanoConta' => array('fields' => array('nome')),
                'TipoPagamento' => array('fields' => array('nome')),
            ),
        ));

        $lancamentos['Uni'] = $this->Lancamento->UnidadesLancamento->find('list');
        $op = ['', 'Saída', 'Entrada', 'Transferência'];
        $lancamentos['Op'] = $op[$this->Session->read('Lancamentos.Consolidado.operacao')];

        $this->Lancamento->recursive = 0;

        $titulo = 'Relatorio de Lançamentos Consolidado';
        $this->set(compact('lancamentos', 'titulo'));
    }
    
    public function excelConsolidado() {
        $this->layout = 'export_xls';

        if ($this->Session->read('Lancamentos.Consolidado.operacao') != '') {
            $conditions[] = "Lancamento.operacao = '" . $this->Session->read('Lancamentos.Consolidado.operacao') . "'";
        }
        if ($this->Session->read('Lancamentos.Consolidado.plano_conta_id') != '') {
            $conditions[] = "Lancamento.plano_conta_id = '" . $this->Session->read('Lancamentos.Consolidado.plano_conta_id') . "'";
        }
        if ($this->Session->read('Lancamentos.Consolidado.unidade_geradora') != '') {
            $conditions[] = "Lancamento.unidade_geradora = '" . $this->Session->read('Lancamentos.Consolidado.unidade_geradora') . "'";
        }
        if ($this->Session->read('Lancamentos.Consolidado.dataInicial') != '' AND $this->Session->read('Lancamentos.Consolidado.dataFinal') != '') {
            $this->request->data['Lancamento']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Consolidado.dataInicial'))));
            $this->request->data['Lancamento']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Lancamentos.Consolidado.dataFinal'))));
            $conditions[] = "Lancamento.data BETWEEN '{$this->request->data['Lancamento']['dataInicial']}' AND '{$this->request->data['Lancamento']['dataFinal']}'";
        }

        $lancamentos['Lan'] = $this->Lancamento->find('all', array('conditions' => $conditions,
            'fields' => array('id', 'format(sum(Lancamento.valor),2,"de_DE") as vTotal', 'valor', 'operacao', 'data', 'plano_conta_id', 'unidade_geradora'),
            'group' => 'Lancamento.plano_conta_id',
            'contain' => array(
                'PlanoConta' => array('fields' => array('nome')),
                'TipoPagamento' => array('fields' => array('nome')),
            ),
        ));

        $lancamentos['Uni'] = $this->Lancamento->UnidadesLancamento->find('list');
        $op = ['', 'Saída', 'Entrada', 'Transferência'];
        $lancamentos['Op'] = $op[$this->Session->read('Lancamentos.Consolidado.operacao')];

        $this->Lancamento->recursive = 0;

        $this->set(compact('lancamentos'));
    }

}
