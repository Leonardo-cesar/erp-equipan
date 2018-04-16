<?php

App::uses('AppController', 'Controller');

/**
 * Caixas Controller
 *
 * @property Caixa $Caixa
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CaixasController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Caixa', 'KitsPedido', 'Cliente');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $permissao['permissao']['setor'] = 3;
        $this->permissao($permissao);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Caixa->exists($id)) {
            throw new NotFoundException(__('Invalid caixa'));
        }
        $options = array('conditions' => array('Caixa.' . $this->Caixa->primaryKey => $id));
        $this->set('caixa', $this->Caixa->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $permissao['permissao']['setor'] = 3;
        $this->permissao($permissao);

        $this->viewClass = 'Json';

        if ($this->request->data['Caixa']['dinheiro']) {
            $this->request->data['Caixa']['dinheiro'] = str_replace('.', '', $this->request->data['Caixa']['dinheiro']);
            $this->request->data['Caixa']['dinheiro'] = str_replace(',', '.', $this->request->data['Caixa']['dinheiro']);
        }

        if ($this->request->data['Caixa']['cartaoCredito']) {
            $this->request->data['Caixa']['cartaoCredito'] = str_replace('.', '', $this->request->data['Caixa']['cartaoCredito']);
            $this->request->data['Caixa']['cartaoCredito'] = str_replace(',', '.', $this->request->data['Caixa']['cartaoCredito']);
        }

        if ($this->request->data['Caixa']['cartaoDebito']) {
            $this->request->data['Caixa']['cartaoDebito'] = str_replace('.', '', $this->request->data['Caixa']['cartaoDebito']);
            $this->request->data['Caixa']['cartaoDebito'] = str_replace(',', '.', $this->request->data['Caixa']['cartaoDebito']);
        }

        if ($this->request->data['Caixa']['deposito']) {
            $this->request->data['Caixa']['deposito'] = str_replace('.', '', $this->request->data['Caixa']['deposito']);
            $this->request->data['Caixa']['deposito'] = str_replace(',', '.', $this->request->data['Caixa']['deposito']);
        }

        if ($this->request->data['Caixa']['cheque']) {
            $this->request->data['Caixa']['cheque'] = str_replace('.', '', $this->request->data['Caixa']['cheque']);
            $this->request->data['Caixa']['cheque'] = str_replace(',', '.', $this->request->data['Caixa']['cheque']);
        }

        if ($this->request->data['Caixa']['valor']) {
            $this->request->data['Caixa']['valor'] = str_replace('.', '', $this->request->data['Caixa']['valor']);
            $this->request->data['Caixa']['valor'] = str_replace(',', '.', $this->request->data['Caixa']['valor']);
        }


        if ($this->request->data['Caixa']['parcial'] != 1) {
            if ($this->request->data['Caixa']['desconto']) {
                $this->request->data['Caixa']['desconto'] = str_replace('.', '', $this->request->data['Caixa']['desconto']);
                $this->request->data['Caixa']['desconto'] = str_replace(',', '.', $this->request->data['Caixa']['desconto']);
            }
        }

        $total = $this->request->data['Caixa']['dinheiro'] + $this->request->data['Caixa']['cartaoCredito'] + $this->request->data['Caixa']['cartaoDebito'] + $this->request->data['Caixa']['deposito'] + $this->request->data['Caixa']['cheque'];
        if ($this->request->data['Caixa']['parcial'] == 1) {
            $this->request->data['Caixa']['valor'] = $total;
            $KitsPedido = $this->KitsPedido->find('first', array(
                'conditions' => array('KitsPedido.id' => $this->request->data['Caixa']['kits_pedido_id']),
                'fields' => array('id')
            ));

            $this->KitsPedido->id = $KitsPedido['KitsPedido']['id'];
            $this->KitsPedido->saveField('parcial', 1);
            $this->KitsPedido->saveField('valor_parcial', $total);

            $this->Caixa->create();
            $this->Caixa->save($this->request->data);

            $this->set('data', $this->request->data);
            $this->set('_serialize', 'data');
        } elseif ($total == round(($this->request->data['Caixa']['valor'] - $this->request->data['Caixa']['desconto']),2)) {
            if ($this->request->data['Caixa']['kits_pedido_id'] == '') {
                $pedidos = $this->Caixa->Pedido->KitsPedido->find('all', array(
                    'recursive' => -1,
                    'conditions' => array('KitsPedido.pedido_id' => $this->request->data['Caixa']['pedido_id']),
                    'fields' => array('id')
                ));

                foreach ($pedidos as $pedido) {
                    $this->Caixa->Pedido->KitsPedido->id = $pedido;
                    $this->Caixa->Pedido->KitsPedido->saveField('paga', 1);
                }
            } else {
                $placa = $this->Caixa->Pedido->KitsPedido->find('first', array(
                    'recursive' => -1,
                    'conditions' => array('KitsPedido.id' => $this->request->data['Caixa']['kits_pedido_id']),
                    'fields' => array('id')
                ));

                $this->Caixa->Pedido->KitsPedido->id = $placa;
                $this->Caixa->Pedido->KitsPedido->saveField('paga', 1);
            }

            $this->Caixa->create();
            $this->Caixa->save($this->request->data);
            $this->set('data', $this->request->data);
            $this->set('_serialize', 'data');
        } else {
            $this->set('data', 'erro');
            $this->set('_serialize', 'data');
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
        if (!$this->Caixa->exists($id)) {
            throw new NotFoundException(__('Invalid caixa'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Caixa->save($this->request->data)) {
                $this->Session->setFlash(__('The caixa has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The caixa could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Caixa.' . $this->Caixa->primaryKey => $id));
            $this->request->data = $this->Caixa->find('first', $options);
        }
        $pedidos = $this->Caixa->Pedido->find('list');
        $formasPagamentos = $this->Caixa->FormasPagamento->find('list');
        $this->set(compact('pedidos', 'formasPagamentos'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Caixa->id = $id;
        if (!$this->Caixa->exists()) {
            throw new NotFoundException(__('Invalid caixa'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Caixa->delete()) {
            $this->Session->setFlash(__('The caixa has been deleted.'));
        } else {
            $this->Session->setFlash(__('The caixa could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function pesquisar() {

        $permissao['permissao']['setor'] = 3;
        $this->permissao($permissao);

        $this->viewClass = 'Json';

        if ($this->request->query['pedido'] != '') {
            $verifica = $this->Caixa->Pedido->KitsPedido->find('list', array(
                'conditions' => array('KitsPedido.pedido_id' => $this->request->query['pedido']),
                'fields' => array('id', 'paga')
            ));
            if (in_array(FALSE, $verifica)) {
                $data['Pedido']['tipo'] = '';
                $data = $this->Caixa->Pedido->find('first', array(
                    'conditions' => array('Pedido.id' => $this->request->query['pedido']),
                    'fields' => array('id', 'desconto', 'observacao', 'tipo', 'unidade_id'),
                    'contain' => array(
                        'Cliente' => array('fields' => array('nome', 'cpf', 'cnpj')),
                        'KitsPedido' => array(
                            'fields' => array('placa', 'tarjeta', 'parcial', 'valor_parcial', 'valor', 'paga'),
                            'Kit' => array(
                                'fields' => 'nome'
                            )
                        )
                    )
                ));
            } else {
                $data['Pedido']['tipo'] = 'pago';
                $data['Pedido']['msg'] = 'Este pedido já estão quitado!';
            }
        } else {
            $verifica = $this->Caixa->Pedido->KitsPedido->find('first', array(
                'conditions' => array('KitsPedido.placa' => $this->request->query['placa']),
                'fields' => array('id', 'paga')
            ));
            if ($verifica['KitsPedido']['paga'] == '') {
                $data = $this->KitsPedido->find('first', array(
                    'conditions' => array('KitsPedido.placa' => $this->request->query['placa']),
                    'fields' => array('id', 'kit_id', 'pedido_id', 'placa', 'tarjeta', 'paga', 'valor', 'parcial', 'valor_parcial'),
                    'contain' => array(
                        'Kit' => array('fields' => array('nome')),
                        'Pedido' => array('fields' => array('id', 'tipo', 'situacao', 'observacao', 'desconto', 'unidade_id'),
                            'Cliente' => array(
                                'fields' => array('nome', 'cpf', 'cnpj')
                            )
                        )
                    )
                ));
                $data['Cliente'] = $data['Pedido']['Cliente'];
            } else {
                $data['Pedido']['tipo'] = 'pago';
                $data['Pedido']['msg'] = 'Esta placa já esta quitada!';
            }
        }

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function parcial() {

        $permissao['permissao']['setor'] = 3;
        $this->permissao($permissao);
    }

    public function pesquisaparcial() {
        $this->viewClass = 'Json';

        $verifica = $this->Caixa->Pedido->KitsPedido->find('first', array(
            'conditions' => array('KitsPedido.placa' => $this->request->query['placa']),
            'fields' => array('id', 'paga', 'parcial')
        ));
        if ($verifica['KitsPedido']['paga'] == 1) {
            $data['Pedido']['tipo'] = 'pago';
            $data['Pedido']['msg'] = 'Esta placa já esta quitada!';
        } elseif ($verifica['KitsPedido']['parcial'] == 1) {
            $data['Pedido']['tipo'] = 'pago';
            $data['Pedido']['msg'] = 'Esta placa já esta com baixa parcial!';
        } else {
            $data = $this->KitsPedido->find('first', array(
                'conditions' => array('KitsPedido.placa' => $this->request->query['placa'], 'paga = 0'),
                'fields' => array('id', 'kit_id', 'pedido_id', 'placa', 'tarjeta', 'paga', 'valor', 'parcial', 'valor_parcial'),
                'contain' => array(
                    'Kit' => array('fields' => array('nome')),
                    'Pedido' => array('fields' => array('id', 'tipo', 'situacao', 'observacao', 'unidade_id'),
                        'Cliente' => array(
                            'fields' => array('nome', 'cpf', 'cnpj')
                        )
                    )
                )
            ));
            $data['Cliente'] = $data['Pedido']['Cliente'];
        }

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function lote() {

        $permissao['permissao']['setor'] = 3;
        $this->permissao($permissao);

        $qu = NULL;
        if ($this->Session->read('Auth.User.nivel_id') == 1) {
            $unidades = $this->Caixa->Unidade->find('list');
        } else {
            $uniUser = $this->Caixa->Usuario->find('first', array(
                'conditions' => array('Usuario.id' => $this->Session->read('Auth.User.id')),
                'contain' => array(
                    'Unidade' => array('fields' => array('id', 'nome')),
                ),
                'fields' => array('id')
            ));

            foreach ($uniUser['Unidade'] as $uni) {
                $unidades[$uni['id']] = $uni['nome'];
            }
            $qu = count($unidades);

            if ($qu == 1) {
                $clientes = $this->Cliente->find('list', array(
                    'conditions' => array('Cliente.ativo' => 1, 'Cliente.prazo' => 1, 'Cliente.unidade_id' => $uniUser['Unidade'][0]['id']),
                    'recursive' => -1,
                    'fields' => array('id', 'nome')
                ));
                $unidades = $uniUser['Unidade'][0]['id'];
            }
        }

        $this->set(compact('usuarios', 'categorias', 'unidades', 'qu', 'clientes'));
    }

    public function prazo() {
        $this->viewClass = 'Json';

        if ($this->request->query['data']['Pesquisa']['dataInicial'] != '' AND $this->request->query['data']['Pesquisa']['dataFinal'] != '') {
            $this->request->query['data']['Pesquisa']['dataInicial'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->query['data']['Pesquisa']['dataInicial'])));
            $this->request->query['data']['Pesquisa']['dataFinal'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->query['data']['Pesquisa']['dataFinal'])));
        }

        $placas = $this->Caixa->Pedido->KitsPedido->find('all', array(
            'conditions' => array(
                "cast(Pedido.created as date) BETWEEN '{$this->request->query['data']['Pesquisa']['dataInicial']}' AND '{$this->request->query['data']['Pesquisa']['dataFinal']}'",
                'paga' => 0,
                'Pedido.tipo' => 1,
                'Pedido.situacao' => 0,
                'Pedido.unidade_id' => $this->request->query['data']['Pesquisa']['unidade_id'],
                'Pedido.cliente_id' => $this->request->query['data']['Pesquisa']['cliente_id']
            ),
            'fields' => array('id', 'placa', 'tarjeta', 'observacao', 'created', 'parcial', 'valor_parcial', 'valor', 'pedido_id', 'kit_id'),
            'contain' => array(
                'Pedido' => array('fields' => array('id')),
                'Kit' => array('fields' => array('id', 'nome')),
            ),
        ));

        $this->set('data', $placas);
        $this->set('_serialize', 'data');
    }

    public function quitar() {
        $this->viewClass = 'Json';

        if ($this->request->data['Quitar']['desconto']) {
            $this->request->data['Quitar']['desconto'] = str_replace('.', '', $this->request->data['Quitar']['desconto']);
            $this->request->data['Quitar']['desconto'] = str_replace(',', '.', $this->request->data['Quitar']['desconto']);
        }

        if ($this->request->data['Quitar']['dinheiro']) {
            $this->request->data['Quitar']['dinheiro'] = str_replace('.', '', $this->request->data['Quitar']['dinheiro']);
            $this->request->data['Quitar']['dinheiro'] = str_replace(',', '.', $this->request->data['Quitar']['dinheiro']);
        }

        if ($this->request->data['Quitar']['cartaoCredito']) {
            $this->request->data['Quitar']['cartaoCredito'] = str_replace('.', '', $this->request->data['Quitar']['cartaoCredito']);
            $this->request->data['Quitar']['cartaoCredito'] = str_replace(',', '.', $this->request->data['Quitar']['cartaoCredito']);
        }

        if ($this->request->data['Quitar']['cartaoDebito']) {
            $this->request->data['Quitar']['cartaoDebito'] = str_replace('.', '', $this->request->data['Quitar']['cartaoDebito']);
            $this->request->data['Quitar']['cartaoDebito'] = str_replace(',', '.', $this->request->data['Quitar']['cartaoDebito']);
        }

        if ($this->request->data['Quitar']['deposito']) {
            $this->request->data['Quitar']['deposito'] = str_replace('.', '', $this->request->data['Quitar']['deposito']);
            $this->request->data['Quitar']['deposito'] = str_replace(',', '.', $this->request->data['Quitar']['deposito']);
        }

        if ($this->request->data['Quitar']['cheque']) {
            $this->request->data['Quitar']['cheque'] = str_replace('.', '', $this->request->data['Quitar']['cheque']);
            $this->request->data['Quitar']['cheque'] = str_replace(',', '.', $this->request->data['Quitar']['cheque']);
        }
        $soma = $this->request->data['Quitar']['dinheiro'] + $this->request->data['Quitar']['cartaoCredito'] + $this->request->data['Quitar']['cartaoDebito'] + $this->request->data['Quitar']['deposito'] + $this->request->data['Quitar']['cheque'] + $this->request->data['Quitar']['desconto'];
        if ($soma == round($this->request->data['Quitar']['total'],2)) {
            $this->request->data['Quitar']['valor'] = $this->request->data['Quitar']['total'];

            $up = explode(',', $this->request->data['Quitar']['up']);
            $data = array();
            foreach ($up as $key => $id) {
                $data[$key]['KitsPedido']['id'] = $id;
                $data[$key]['KitsPedido']['paga'] = 1;
            }
            $this->KitsPedido->saveMany($data);

            $this->Caixa->create();
            $this->Caixa->save($this->request->data['Quitar']);
            $data['tipo'] = 0;
        } else {
            $data['tipo'] = 1;
            $data['soma'] = $soma;
            $data['total'] = $this->request->data['Quitar']['total'];
        }
        
        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function fechamento() {

        $permissao['permissao']['setor'] = 3;
        $this->permissao($permissao);
    }

    public function fechamentoR() {

        $this->viewClass = 'Json';

        $this->request->query['de'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->query['de'])));
        $this->request->query['ate'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->query['ate'])));
        $this->Session->write('Caixa.fechamento', $this->request->query);

        $data = $this->Caixa->find('all', array(
            'conditions' => array(
                "cast(Caixa.created as date) BETWEEN '{$this->request->query['de']}' AND '{$this->request->query['ate']}'",
                'Caixa.unidade_id' => $this->request->query['uni']
            ),
            'contain' => array(
                'KitsPedido' => array('fields' => array('Placa')),
            ),
            'order' => 'pedido_id ASC'
        ));

        $this->set('data', $data);
        $this->set('_serialize', 'data');
    }

    public function fimprimir() {

        $permissao['permissao']['setor'] = 3;
        $this->permissao($permissao);

        $this->layout = 'imprimir';

        $this->request->query['de'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Caixa.fechamento.de'))));
        $this->request->query['ate'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->Session->read('Caixa.fechamento.ate'))));

        $data = $this->Caixa->find('all', array(
            'conditions' => array(
                "cast(Caixa.created as date) BETWEEN '{$this->request->query['de']}' AND '{$this->request->query['ate']}'",
                'Caixa.unidade_id' => $this->Session->read('Caixa.fechamento.uni')
            ),
            'contain' => array(
                'KitsPedido' => array('fields' => array('Placa')),
            ),
            'order' => 'pedido_id ASC'
        ));
        $unidade = $this->Unidade->find('first', array('conditions' => array('id' => $this->Session->read('Caixa.fechamento.uni')), 'recursive' => -1));
        $titulo = 'Fechamento de Caixa';
        $this->set(compact('data', 'unidade', 'titulo'));
    }

}
