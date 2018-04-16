<?php

App::uses('AppController', 'Controller');

/**
 * Produtos Controller
 *
 * @property Produto $Produto
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProdutosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Produto', 'Unidade');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Produto->recursive = 0;
        $this->set('produtos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Produto->exists($id)) {
            throw new NotFoundException(__('Produto Inválido'));
        }
        $options = array('conditions' => array('Produto.' . $this->Produto->primaryKey => $id));
        $this->set('produto', $this->Produto->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Produto->create();
            if ($this->Produto->save($this->request->data)) {
                $unidades = $this->Unidade->find('list');
                foreach ($unidades as $key => $unidade) {
                    $this->request->data['Estoque'][] = array(
                        'produto_id' => $this->Produto->getLastInsertID(),
                        'quantidade' => 0,
                        'unidade_id' => $key,
                    );
                }
                $this->Unidade->Estoque->saveAll($this->request->data['Estoque']);
                $this->Session->setFlash(__('O produto foi salvo com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'produtos');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O produto não pode ser salvo, tente novamente'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'produtos');
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
        if (!$this->Produto->exists($id)) {
            throw new NotFoundException(__('Produto Inválido'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Produto->save($this->request->data)) {
                $this->Session->setFlash(__('O Produto foi editado com sucesso'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'produtos');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O produto não pode ser salvo, tente mais tarde'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'produtos');
            }
        } else {
            $options = array('conditions' => array('Produto.' . $this->Produto->primaryKey => $id));
            $this->request->data = $this->Produto->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Produto->id = $id;
        if (!$this->Produto->exists()) {
            throw new NotFoundException(__('Invalid produto'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Produto->delete()) {
            $this->Session->setFlash(__('O Produto foi deletado com sucesso'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'produtos');
        } else {
            $this->Session->setFlash(__('O produto não pode ser salvo, tente mais tarde'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'produtos');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
