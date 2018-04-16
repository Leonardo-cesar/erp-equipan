<?php

App::uses('AppModel', 'Model');

/**
 * CodigosKitsPedido Model
 *
 * @property Codigo $Codigo
 * @property KitsPedido $KitsPedido
 */
class CodigosKitsPedido extends AppModel {

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
    public $displayField = 'codigo_id';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Codigo' => array(
            'className' => 'Codigo',
            'foreignKey' => 'codigo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'KitsPedido' => array(
            'className' => 'KitsPedido',
            'foreignKey' => 'kits_pedido_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
