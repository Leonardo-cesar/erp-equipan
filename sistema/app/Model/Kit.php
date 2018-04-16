<?php

App::uses('AppModel', 'Model');

/**
 * Kit Model
 *
 * @property Preco $Preco
 * @property Pedido $Pedido
 * @property Produto $Produto
 * @property Unidade $Unidade
 */
class Kit extends AppModel {

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
    public $displayField = 'nome';
    
    public $actsAs = array('Containable');


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Preco' => array(
            'className' => 'Preco',
            'foreignKey' => 'kit_id',
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

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Pedido' => array(
            'className' => 'Pedido',
            'joinTable' => 'kits_pedidos',
            'foreignKey' => 'kit_id',
            'associationForeignKey' => 'pedido_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Produto' => array(
            'className' => 'Produto',
            'joinTable' => 'kits_produtos',
            'foreignKey' => 'kit_id',
            'associationForeignKey' => 'produto_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Unidade' => array(
            'className' => 'Unidade',
            'joinTable' => 'kits_unidades',
            'foreignKey' => 'kit_id',
            'associationForeignKey' => 'unidade_id',
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
