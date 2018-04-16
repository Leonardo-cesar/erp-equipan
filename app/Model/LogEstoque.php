<?php

App::uses('AppModel', 'Model');

/**
 * LogEstoque Model
 *
 * @property Produto $Produto
 * @property Usuario $Usuario
 * @property Unidade $Unidade
 */
class LogEstoque extends AppModel {

    /**
     * Use database config
     *
     * @var string
     */
    public $useDbConfig = 'test';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'produto_id';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Produto' => array(
            'className' => 'Produto',
            'foreignKey' => 'produto_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Pedido' => array(
            'className' => 'Pedido',
            'foreignKey' => 'pedido_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Unidade' => array(
            'className' => 'Unidade',
            'foreignKey' => 'unidade_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'UnidadeOrigenDestino' => array(
            'className' => 'Unidade',
            'foreignKey' => 'unidade_origen_destino',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
