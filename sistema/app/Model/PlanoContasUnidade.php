<?php
App::uses('AppModel', 'Model');
/**
 * PlanoContasUnidade Model
 *
 * @property PlanoConta $PlanoConta
 * @property Unidade $Unidade
 */
class PlanoContasUnidade extends AppModel {

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
		)
	);
}
