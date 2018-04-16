<?php

App::uses('AppModel', 'Model');

/**
 * Codigo Model
 *
 * @property Usuarios $Usuarios
 * @property Unidades $Unidades
 * @property KitsPedido $KitsPedido
 */
class Codigo extends AppModel {

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
    public $displayField = 'codigo';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Usuarios' => array(
            'className' => 'Usuarios',
            'foreignKey' => 'usuarios_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Unidades' => array(
            'className' => 'Unidades',
            'foreignKey' => 'unidades_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'KitsPedido' => array(
            'className' => 'KitsPedido',
            'joinTable' => 'codigos_kits_pedidos',
            'foreignKey' => 'codigo_id',
            'associationForeignKey' => 'kits_pedido_id',
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
