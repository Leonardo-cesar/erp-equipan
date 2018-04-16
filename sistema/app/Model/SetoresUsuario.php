<?php

App::uses('AppModel', 'Model');

/**
 * SetoresUsuario Model
 *
 * @property Setor $Setor
 * @property Usuario $Usuario
 */
class SetoresUsuario extends AppModel {

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
        'Setore' => array(
            'className' => 'Setore',
            'foreignKey' => 'setor_id',
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
