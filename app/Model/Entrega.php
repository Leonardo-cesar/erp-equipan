<?php

App::uses('AppModel', 'Model');

/**
 * Entrega Model
 *
 * @property Unidade $Unidade
 * @property Usuario $Usuario
 * @property Pedido $Pedido
 */
class Entrega extends AppModel {

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
        'Unidade' => array(
            'className' => 'Unidade',
            'foreignKey' => 'unidade_id',
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
        ),
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Pedido' => array(
            'className' => 'Pedido',
            'foreignKey' => 'pedido_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
