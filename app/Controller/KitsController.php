<?php

App::uses('AppController', 'Controller');

/**
 * Kits Controller
 *
 * @property Kit $Kit
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class KitsController extends AppController {

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
        $this->Kit->recursive = 0;
        $this->set('kits', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Kit->exists($id)) {
            throw new NotFoundException(__('Invalid kit'));
        }
        $options = array(
            'conditions' => array('Kit.' . $this->Kit->primaryKey => $id),
            'contain' => array(
                'Produto' => array('fields' => 'nome'),
                'Unidade' => array('fields' => array('id', 'nome')),
        ));
        $this->set('kit', $this->Kit->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Kit->create();
            if ($this->Kit->save($this->request->data)) {
                $this->Session->setFlash(__('O Kit foi salvo com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'kit');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O Kit não pode ser salvo, por favor tente novamente'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'kit');
            }
        }
        $pedidos = $this->Kit->Pedido->find('list');
        $produtos = $this->Kit->Produto->find('list');
        $unidades = $this->Kit->Unidade->find('list');
        $this->set(compact('pedidos', 'produtos', 'unidades'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Kit->exists($id)) {
            throw new NotFoundException(__('Invalid kit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Kit->save($this->request->data)) {
                $this->Session->setFlash(__('O Kit foi editado com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'kit');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O Kit não pode ser editado, por favor tente novamente'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'kit');
            }
        } else {
            $options = array(
                'conditions' => array('Kit.' . $this->Kit->primaryKey => $id),
                'contain' => array(
                    'Produto' => array('fields' => 'nome', 'id'),
                    'Unidade' => array('fields' => array('id', 'nome')),
            ));
            $this->request->data = $this->Kit->find('first', $options);
        }
        $pedidos = $this->Kit->Pedido->find('list');
        $produtos = $this->Kit->Produto->find('list');
        $unidades = $this->Kit->Unidade->find('list');
        $this->set(compact('pedidos', 'produtos', 'unidades'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Kit->id = $id;
        if (!$this->Kit->exists()) {
            throw new NotFoundException(__('Invalid kit'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Kit->delete()) {
            $this->Session->setFlash(__('O Kit foi deletado com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'kit');
        } else {
            $this->Session->setFlash(__('O Kit não pode ser deletado, por favor tente novamente'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'kit');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
