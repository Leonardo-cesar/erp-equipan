<?php

App::uses('AppModel', 'Model');

/**
 * Usuario Model
 *
 * @property Nivel $Nivel
 * @property Caixa $Caixa
 * @property Cliente $Cliente
 * @property KitsPedido $KitsPedido
 * @property Lancamento $Lancamento
 * @property Pedido $Pedido
 * @property Perda $Perda
 * @property Setore $Setore
 * @property Unidade $Unidade
 */
class Usuario extends AppModel {

    public function beforeSave($options = array()) {
        if (isset($this->data['Usuario']['senha'])) {
            $this->data['Usuario']['senha'] = AuthComponent::password($this->data['Usuario']['senha']);
        }
        return true;
    }

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
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Nivei' => array(
            'className' => 'Nivei',
            'foreignKey' => 'nivel_id',
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
            'foreignKey' => 'usuario_id',
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
            'foreignKey' => 'usuario_id',
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
            'foreignKey' => 'usuario_id',
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
            'foreignKey' => 'usuario_id',
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
            'foreignKey' => 'usuario_id',
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
            'foreignKey' => 'usuario_id',
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
            'foreignKey' => 'usuario_id',
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
        'Setore' => array(
            'className' => 'Setore',
            'joinTable' => 'setores_usuarios',
            'foreignKey' => 'usuario_id',
            'associationForeignKey' => 'setor_id',
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
            'joinTable' => 'unidades_usuarios',
            'foreignKey' => 'usuario_id',
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
