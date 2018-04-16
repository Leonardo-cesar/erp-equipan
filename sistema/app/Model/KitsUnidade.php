<?php
App::uses('AppModel', 'Model');
/**
 * KitsUnidade Model
 *
 * @property Kit $Kit
 * @property Unidade $Unidade
 */
class KitsUnidade extends AppModel {

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
		'Kit' => array(
			'className' => 'Kit',
			'foreignKey' => 'kit_id',
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
		)
	);
}
