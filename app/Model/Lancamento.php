<?php

App::uses('AppModel', 'Model');

/**
 * Lancamento Model
 *
 * @property TipoPagamento $TipoPagamento
 * @property PlanoConta $PlanoConta
 * @property Unidade $Unidade
 * @property Usuario $Usuario
 * @property Unidade $Unidade
 */
class Lancamento extends AppModel {

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
        'TipoPagamento' => array(
            'className' => 'TipoPagamento',
            'foreignKey' => 'tipo_pagamento_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'PlanoConta' => array(
            'className' => 'PlanoConta',
            'foreignKey' => 'plano_conta_id',
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
        'UnidadesLancamento' => array(
            'className' => 'UnidadesLancamento',
            'foreignKey' => 'unidade_geradora',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'UnidadesLancamento' => array(
            'className' => 'Unidade',
            'foreignKey' => 'unidade_recebedora',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'UnidadesLancamento' => array(
            'className' => 'UnidadesLancamento',
            'foreignKey' => 'unidade_pagadora',
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


}
