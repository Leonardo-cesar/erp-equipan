<?php

App::uses('AppController', 'Controller');

/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ClientesController extends AppController {

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
        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        $a = $this->validaAdm();
        foreach ($a as $key => $b) {
            $c[] = $key;
        }
        $clientes = $this->Cliente->find('all', array(
            'conditions' => array("Cliente.unidade_id IN (" . implode(',', $c) . ")"),
            'limit' => '',
            'fields' => array('id', 'nome', 'categoria_id', 'cpf', 'cnpj'),
            'contain' => array(
                'Categoria' => array('fields' => array('nome')),
            ),
        ));
        $this->set('clientes', $clientes);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Cliente->exists($id)) {
            throw new NotFoundException(__('Invalid cliente'));
        }
        $options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
        $this->set('cliente', $this->Cliente->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        if ($this->request->is('post')) {
            $this->request->data['Cliente']['data_nascimento'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Cliente']['data_nascimento'])));
            $this->Cliente->create();
            if ($this->Cliente->save($this->request->data)) {
                $this->Session->setFlash(__('O Cliente foi cadastrado com Sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'clientes');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O Cliente não pode ser salvo, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'clientes');
            }
        }

        $categorias = $this->Cliente->Categoria->find('list');

        $this->set(compact('usuarios', 'categorias'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {

        $permissao['permissao']['setor'] = 1;
        $this->permissao($permissao);

        if (!$this->Cliente->exists($id)) {
            throw new NotFoundException(__('Invalid cliente'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Cliente']['data_nascimento'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Cliente']['data_nascimento'])));
            if ($this->Cliente->save($this->request->data)) {
                $this->Session->setFlash(__('O Cliente foi editado com Sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'clientes');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O Cliente não pode ser editado, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'clientes');
            }
        } else {
            $options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id),
                'contain' => array(
                    'Representante' => array('fields' => array('id', 'nome')),
                    'Usuario' => array('fields' => array('id', 'nome')),
                    'Categoria' => array('fields' => array('id', 'nome')),
                    'Unidade' => array('fields' => array('id', 'nome')),
            ));
            $this->request->data = $this->Cliente->find('first', $options);
            $this->request->data['tipo'] = 0;
            if ($this->request->data['Cliente']['cliente_id'] != '') {
                $options2 = array('conditions' => array('Cliente.id ' => $this->request->data['Cliente']['cliente_id']),
                    'fields' => array('id', 'nome'),
                    'recursive' => -1);
                $this->request->data['Representante'] = $this->Cliente->find('first', $options2);
                $this->request->data['Cliente']['cliente'] = $this->request->data['Representante']['Cliente']['nome'];
                $this->request->data['Cliente']['cliente_id'] = $this->request->data['Representante']['Cliente']['id'];
                $this->request->data['tipo'] = 1;
            }
            $this->request->data['Cliente']['data_nascimento'] = date("d/m/Y", strtotime($this->request->data['Cliente']['data_nascimento']));
        }

        $categorias = $this->Cliente->Categoria->find('list');
        $this->set(compact('usuarios', 'categorias', 'unidades'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {

        $this->permissao();

        $this->Cliente->id = $id;
        if (!$this->Cliente->exists()) {
            throw new NotFoundException(__('Invalid cliente'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Cliente->delete()) {
            $this->Session->setFlash(__('O Cliente foi deletado com Sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'clientes');
        } else {
            $this->Session->setFlash(__('O Cliente não pode ser deletado, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'clientes');
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function liberar() {
        $this->viewClass = 'Json';

        $this->request->query['data']['Liberar']['senha'] = AuthComponent::password($this->request->query['data']['Liberar']['senha']);
        $this->Cliente->Usuario->recursive = -1;
        $adm = $this->Cliente->Usuario->find('first', array('conditions' => array('usuario' => $this->request->query['data']['Liberar']['usuario'], 'senha' => $this->request->query['data']['Liberar']['senha'], 'nivel_id' => 1), 'fields' => array('id', 'nome')));

        $this->set('data', $adm);
        $this->set('_serialize', 'data');
    }

    public function lista() {
        $this->viewClass = 'Json';

        if ($this->Session->read('Auth.User.nivel_id') == 1) {
            $unidades = $this->Cliente->Unidade->find('list', array(
                'fields' => array('id'),
            ));
        } else {
            $unidades = $this->Cliente->Unidade->UnidadesUsuario->find('list', array(
                'conditions' => array('UnidadesUsuario.usuario_id' => $this->Session->read('Auth.User.id')),
                'fields' => array('unidade_id'),
            ));
        }

        $clientes = $this->Cliente->find('all', array(
            'conditions' => array(
                'or' => array(
                    'Cliente.id LIKE' => "%" . $this->request->query('term') . "%",
                    'Cliente.nome LIKE' => "%" . $this->request->query('term') . "%",
                ),
                'Cliente.cliente_id =' => null,
                'Cliente.unidade_id' => $unidades,
            ),
            'fields' => array('id', 'nome', 'telefone', 'email', 'cpf', 'cnpj', 'prazo'),
            'contain' => array(
                'Categoria' => array('fields' => array('id', 'nome')),
                'Representante' => array('fields' => array('id', 'nome', 'cpf')),
            )
        ));

        $this->set('data', $clientes);
        $this->set('_serialize', 'data');
    }

    public function select($unidade = NULL) {
        $this->viewClass = 'Json';

        $clientes = $this->Cliente->find('all', array(
            'conditions' => array(
                'Cliente.unidade_id' => $unidade,
                'Cliente.prazo' => 1,
            ),
            'order' => 'nome ASC',
            'recursive' => -1,
            'fields' => array('id', 'nome','categoria_id'),
        ));

        $this->set('data', $clientes);
        $this->set('_serialize', 'data');
    }
    
    public function selectV($unidade = NULL) {
        $this->viewClass = 'Json';

        $clientes = $this->Cliente->find('all', array(
            'conditions' => array(
                'Cliente.unidade_id' => $unidade,
                'Cliente.categoria_id <>' => 1,
            ),
            'order' => 'nome ASC',
            'recursive' => -1,
            'fields' => array('id', 'nome'),
        ));

        $this->set('data', $clientes);
        $this->set('_serialize', 'data');
    }

    public function todos($unidade = NULL) {
        $this->viewClass = 'Json';

        $clientes = $this->Cliente->find('all', array(
            'conditions' => array(
                'Cliente.unidade_id' => $unidade,
            ),
            'order' => 'nome ASC',
            'recursive' => -1,
            'fields' => array('id', 'nome'),
        ));

        $this->set('data', $clientes);
        $this->set('_serialize', 'data');
    }
    
    public function find() {
        $this->viewClass = 'Json';

        $clientes = $this->Cliente->find('first', array(
            'conditions' => array(
                'Cliente.id' => $this->request->query['cliente'],
            ),
            'recursive' => -1,
            'fields' => array('id', 'nome','categoria_id'),
        ));

        $this->set('data', $clientes);
        $this->set('_serialize', 'data');
    }

}
