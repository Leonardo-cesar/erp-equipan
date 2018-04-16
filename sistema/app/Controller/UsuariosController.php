<?php

App::uses('AppController', 'Controller');

/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsuariosController extends AppController {

    public function login() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('<div class="alert alert-danger">Usuário ou senha inválidos. Tente novamente.</div>'), null, null, 'auth'
                );
            }
        }
    }
    
    public function logout() {
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Usuario->recursive = 0;
        $this->Paginator->settings = array(
            'fields' => array('id', 'nome', 'ativo'),
            'contain' => array(
                'Nivei' => array('fields' => 'nome'),
                'Unidade' => array('fields' => array('id', 'nome')),
            )
        );
        $this->Usuario->contain = array('Unidade');
        $this->set('usuarios', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        $options = array(
            'conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id), 
            'contain' => array(
                'Nivei' => array('fields' => 'nome'), 
                'Unidade' => array('fields' => 'nome'), 
                'Setore' => array('fields' => 'nome'), 
                )
            );
        $this->set('usuario', $this->Usuario->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Usuario->create();
            $this->request->data['Usuario']['data_aniversario'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Usuario']['data_aniversario'])));
            if ($this->request->data['Usuario']['senha'] != $this->request->data['Usuario']['c_senha']) {
                $this->Session->setFlash(__('As senhas não conferem'), 'default', array('class' => 'alert alert-warning', 'role' => "alert"), 'usuario');
                return $this->redirect(array('action' => 'index'));
            }
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('O usuário foi cadastrado.'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'usuario');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O usuário não pode ser salvo. Por favor, tente de novo.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'usuario');
            }
        }
        $niveis = $this->Usuario->Nivei->find('list');
        $unidades = $this->Usuario->Unidade->find('list');
        $setores = $this->Usuario->Setore->find('list');
        $this->set(compact('niveis', 'unidades', 'setores'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        if ($this->request->is(array('post', 'put'))) {
            
            if ($this->request->data['Usuario']['senha'] == '') {
                unset($this->request->data['Usuario']['senha']);
            } else {
                if ($this->request->data['Usuario']['senha'] != $this->request->data['Usuario']['c_senha']) {
                    $this->Session->setFlash(__('As senhas não conferem'), 'default', array('class' => 'alert alert-warning', 'role' => "alert"), 'usuario');
                    return $this->redirect(array('action' => 'index'));
                }
            }

            $this->request->data['Usuario']['data_aniversario'] = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->data['Usuario']['data_aniversario'])));
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('O usuário foi editado, com sucesso'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'usuario');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O usuário não pode ser editado. Por favor, tente de novo.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'usuario');
            }
            
        } else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id), 'contain' => array('Nivei', 'Unidade', 'Setore'));
            $this->request->data = $this->Usuario->find('first', $options);
            $this->request->data['Usuario']['data_aniversario'] = date("d/m/Y", strtotime($this->request->data['Usuario']['data_aniversario']));
        }

        $niveis = $this->Usuario->Nivei->find('list');
        $unidades = $this->Usuario->Unidade->find('list');
        $setores = $this->Usuario->Setore->find('list');
        $this->set(compact('niveis', 'unidades', 'setores'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Usuario->delete()) {
            $this->Session->setFlash(__('O usuário foi deletado'), 'default', array('class' => 'alert alert-success', 'role' => "alert"), 'usuario');
        } else {
            $this->Session->setFlash(__('O usuário não pode ser deletado. Por favor, tente de novo.'), 'default', array('class' => 'alert alert-danger', 'role' => "alert"), 'usuario');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
