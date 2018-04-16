<?php

App::uses('AppController', 'Controller');

/**
 * KitsPedidos Controller
 *
 * @property KitsPedido $KitsPedido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FornecedoresController extends AppController {

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
        $qu = array('1' => 'Hitórico de Fornecimento', '2'=>'Exclusivo no Mercado', '5' => 'Visita Técnica ou Amostra', '4' => 'Indicação por empresas idoneas/parceiras', '5' => 'Possue Pelo menos 3 indicações de clientes', '6' => 'Se o fornecedor possui ISO 9001, ISO 14001 ou outro');
        $fornecedores = $this->Fornecedore->find('all');
        $this->set('fornecedores', $fornecedores);
        $this->set('qu', $qu);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
         if (!$this->Fornecedore->exists($id)) {
            throw new NotFoundException(__('Invalid Fornecedore'));
        }
        $options = array('conditions' => array('id' => $id));
        $qu = array('1' => 'Hitórico de Fornecimento', '2'=>'Exclusivo no Mercado', '5' => 'Visita Técnica ou Amostra', '4' => 'Indicação por empresas idoneas/parceiras', '5' => 'Possue Pelo menos 3 indicações de clientes', '6' => 'Se o fornecedor possui ISO 9001, ISO 14001 ou outro');
        $this->set('qu', $qu);
        $this->set('fornecedore', $this->Fornecedore->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Fornecedore->create();
            if ($this->Fornecedore->save($this->request->data)) {
                $this->Session->setFlash(__('O Fornecedor foi salvo com sucesso!'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'Fornecedor');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O Fornecedor não pode ser salvo, por favor tente novamente'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'Fornecedor');
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
        if (!$this->Fornecedore->exists($id)) {
            throw new NotFoundException(__('Fornecedor inválida'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Fornecedore->save($this->request->data)) {
                $this->Session->setFlash(__('O Fornecedor foi editada com sucesso.'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'fornecedore');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Fornecedore não pode ser salva, tente novamente.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'fornecedore');
            }
        } else {
            $options = array('conditions' => array('id' => $id));
            $this->request->data = $this->Fornecedore->find('first', $options);
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
        
    }
    
    public function lista() {
        $this->viewClass = 'Json';

        $fornecedores = $this->Fornecedore->find('all', array(
            'conditions' => array(
                'or' => array(
                    'Fornecedore.id LIKE' => "%" . $this->request->query('term') . "%",
                    'Fornecedore.nome LIKE' => "%" . $this->request->query('term') . "%",
                ),
                'ativo' => 1,
            ),
            'fields' => array('id', 'nome', 'telefone', 'email', 'contato', 'cidade')
        ));

        $this->set('data', $fornecedores);
        $this->set('_serialize', 'data');
    }

}
