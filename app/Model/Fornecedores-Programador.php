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
class Fornecedor extends AppModel {

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

/**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'OrdemCompra' => array(
            'className' => 'OrdemCompra',
            'foreignKey' => 'fornecedore_id',
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
