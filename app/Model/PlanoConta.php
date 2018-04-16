<?php
App::uses('AppModel', 'Model');
/**
 * PlanoConta Model
 *
 * @property Lancamento $Lancamento
 * @property Unidade $Unidade
 */
class PlanoConta extends AppModel {

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


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Lancamento' => array(
			'className' => 'Lancamento',
			'foreignKey' => 'plano_conta_id',
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
		'Unidade' => array(
			'className' => 'Unidade',
			'joinTable' => 'plano_contas_unidades',
			'foreignKey' => 'plano_conta_id',
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
