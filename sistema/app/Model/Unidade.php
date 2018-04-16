<?php

App::uses('AppModel', 'Model');

/**
 * Unidade Model
 *
 * @property Caixa $Caixa
 * @property Cliente $Cliente
 * @property Codigo $Codigo
 * @property Entrega $Entrega
 * @property Estoque $Estoque
 * @property Lancamento $Lancamento
 * @property LogEstoque $LogEstoque
 * @property Pedido $Pedido
 * @property Perda $Perda
 * @property Preco $Preco
 * @property Kit $Kit
 * @property PlanoConta $PlanoConta
 * @property TipoPagamento $TipoPagamento
 * @property Lancamento $Lancamento
 * @property Usuario $Usuario
 */
class Unidade extends AppModel {

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
        'Caixa' => array(
            'className' => 'Caixa',
            'foreignKey' => 'unidade_id',
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
        'Cliente' => array(
            'className' => 'Cliente',
            'foreignKey' => 'unidade_id',
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
        'Codigo' => array(
            'className' => 'Codigo',
            'foreignKey' => 'unidade_id',
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
            'foreignKey' => 'unidade_id',
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
        'Estoque' => array(
            'className' => 'Estoque',
            'foreignKey' => 'unidade_id',
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
        'Lancamento' => array(
            'className' => 'Lancamento',
            'foreignKey' => 'unidade_id',
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
            'foreignKey' => 'unidade_id',
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
        'Pedido' => array(
            'className' => 'Pedido',
            'foreignKey' => 'unidade_id',
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
            'foreignKey' => 'unidade_id',
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
        'Preco' => array(
            'className' => 'Preco',
            'foreignKey' => 'unidade_id',
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
            'joinTable' => 'kits_unidades',
            'foreignKey' => 'unidade_id',
            'associationForeignKey' => 'kit_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'PlanoConta' => array(
            'className' => 'PlanoConta',
            'joinTable' => 'plano_contas_unidades',
            'foreignKey' => 'unidade_id',
            'associationForeignKey' => 'plano_conta_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'TipoPagamento' => array(
            'className' => 'TipoPagamento',
            'joinTable' => 'tipo_pagamentos_unidades',
            'foreignKey' => 'unidade_id',
            'associationForeignKey' => 'tipo_pagamento_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Lancamento' => array(
            'className' => 'Lancamento',
            'joinTable' => 'unidades_lancamentos',
            'foreignKey' => 'unidade_id',
            'associationForeignKey' => 'lancamento_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Usuario' => array(
            'className' => 'Usuario',
            'joinTable' => 'unidades_usuarios',
            'foreignKey' => 'unidade_id',
            'associationForeignKey' => 'usuario_id',
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
