<?php

App::uses('AppModel', 'Model');

/**
 * Pedidosexcluido Model
 *
 * @property Pedido $Pedido
 */
class Pedidoscancelado extends AppModel {

    /**
     * Use database config
     *
     * @var string
     */
    public $useDbConfig = 'test';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Pedido' => array(
            'className' => 'Pedido',
            'foreignKey' => 'pedido_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
