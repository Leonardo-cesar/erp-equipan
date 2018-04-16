<?php

App::uses('AppController', 'Controller');

/**
 * Precos Controller
 *
 * @property Preco $Preco
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PrecosController extends AppController {

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
        $categorias = $this->Preco->Categoria->find('list');
        $kits = $this->Preco->Kit->find('list');
        $unidades = $this->Preco->Unidade->find('list');
        $this->set(compact('categorias', 'kits', 'unidades'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Preco->exists($id)) {
            throw new NotFoundException(__('Invalid preco'));
        }
        $options = array('conditions' => array('Preco.' . $this->Preco->primaryKey => $id));
        $this->set('preco', $this->Preco->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $this->viewClass = 'Json';

        $this->Preco->deleteAll(array(
            'Preco.unidade_id' => $this->request->query['data']['Preco']['unidade_id'],
            'Preco.kit_id' => $this->request->query['data']['Preco']['kit_id']
                ), false);
        
        foreach ($this->request->query['data']['Categoria'] as $key => $valor) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
            $this->request->data[$key]['Preco']['valor'] = $valor;
            $this->request->data[$key]['Preco']['kit_id'] = $this->request->query['data']['Preco']['kit_id'];
            $this->request->data[$key]['Preco']['unidade_id'] = $this->request->query['data']['Preco']['unidade_id'];
            $this->request->data[$key]['Preco']['categoria_id'] = $key;
        }
        $this->Preco->saveAll($this->request->data);

        $this->set('data', $this->request->query);
        $this->set('_serialize', 'data');
    }

    public function selecionar() {

        $this->viewClass = 'Json';

        $preco = $this->Preco->find('list', array('fields' => array('categoria_id', 'valor'), 'conditions' => array('Preco.unidade_id' => $this->request->query['unidade'], 'Preco.kit_id' => $this->request->query['produto'])));

        $this->set('data', $preco);
        $this->set('_serialize', 'data');
    }

}
