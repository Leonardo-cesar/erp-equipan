<?php

App::uses('AppModel', 'Model');

/**
 * Pedido Model
 *
 * @property UsuarioDesconto $UsuarioDesconto
 * @property Usuario $Usuario
 * @property Cliente $Cliente
 * @property Unidade $Unidade
 * @property Caixa $Caixa
 * @property Estoque $Estoque
 * @property Perda $Perda
 * @property Kit $Kit
 */
class Pedido extends AppModel {

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
    public $displayField = 'id';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'UsuarioDesconto' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_desconto_id',
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
        'Cliente' => array(
            'className' => 'Cliente',
            'foreignKey' => 'cliente_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Representante' => array(
            'className' => 'Cliente',
            'foreignKey' => 'representante_id',
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
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Caixa' => array(
            'className' => 'Caixa',
            'foreignKey' => 'pedido_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Entrega' => array(
            'className' => 'Entrega',
            'foreignKey' => 'pedido_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Perda' => array(
            'className' => 'Perda',
            'foreignKey' => 'pedido_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'KitsPedido' => array(
            'className' => 'KitsPedido',
            'foreignKey' => 'pedido_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'PedidosExcluido' => array(
            'className' => 'Pedidosexcluido',
            'foreignKey' => 'pedido_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'PedidosCancelado' => array(
            'className' => 'PedidosCancelado',
            'foreignKey' => 'pedido_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
