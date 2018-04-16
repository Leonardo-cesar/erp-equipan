<?php

App::uses('AppModel', 'Model');

/**
 * Produto Model
 *
 * @property Estoque $Estoque
 * @property LogEstoque $LogEstoque
 * @property Perda $Perda
 * @property Kit $Kit
 */
class Produto extends AppModel {

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


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Estoque' => array(
            'className' => 'Estoque',
            'foreignKey' => 'produto_id',
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
        'LogEstoque' => array(
            'className' => 'LogEstoque',
            'foreignKey' => 'produto_id',
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
            'foreignKey' => 'produto_id',
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
        'Kit' => array(
            'className' => 'Kit',
            'joinTable' => 'kits_produtos',
            'foreignKey' => 'produto_id',
            'associationForeignKey' => 'kit_id',
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
