<?php
App::uses('AppModel', 'Model');
/**
 * UnidadesLancamento Model
 *
 * @property UnidadesUnidadesLancamento $UnidadesUnidadesLancamento
 */
class UnidadesLancamento extends AppModel {

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
		'UnidadesUnidadesLancamento' => array(
			'className' => 'UnidadesUnidadesLancamento',
			'foreignKey' => 'unidades_lancamento_id',
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

}
