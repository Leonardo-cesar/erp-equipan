<?php

App::uses('AppModel', 'Model');

/**
 * Preco Model
 *
 * @property Categoria $Categoria
 * @property Kit $Kit
 */
class Producao extends AppModel {

    /**
     * Use database config
     *
     * @var string
     */
    public $useDbConfig = 'test';
    public $useTable = 'producao';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'valor';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'usuario_id',
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
