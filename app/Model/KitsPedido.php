<?php

App::uses('AppModel', 'Model');

/**
 * KitsPedido Model
 *
 * @property Kit $Kit
 * @property Pedido $Pedido
 * @property Usuario $Usuario
 */
class KitsPedido extends AppModel {

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
    public $displayField = 'placa';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Kit' => array(
            'className' => 'Kit',
            'foreignKey' => 'kit_id',
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
            'foreignKey' => 'kits_pedido_id',
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
            'foreignKey' => 'kits_pedido_id',
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
        'Producao' => array(
            'className' => 'Producao',
            'foreignKey' => 'kits_pedido_id',
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
    );
    
    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Codigo' => array(
            'className' => 'Codigo',
            'joinTable' => 'codigos_kits_pedidos',
            'foreignKey' => 'kits_pedido_id',
            'associationForeignKey' => 'codigo_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

}
