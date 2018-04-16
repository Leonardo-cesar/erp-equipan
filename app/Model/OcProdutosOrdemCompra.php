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
class OcProdutosOrdemCompra extends AppModel {

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

    public $belongsTo = array(
        'OcProduto' => array(
            'className' => 'OcProduto',
            'foreignKey' => 'oc_produto_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'OrdemCompra' => array(
            'className' => 'OrdemCompra',
            'foreignKey' => 'ordem_compra_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
