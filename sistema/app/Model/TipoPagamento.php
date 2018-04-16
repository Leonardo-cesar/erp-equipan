<?php
App::uses('AppModel', 'Model');
/**
 * TipoPagamento Model
 *
 * @property Lancamento $Lancamento
 * @property Unidade $Unidade
 */
class TipoPagamento extends AppModel {

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
			'foreignKey' => 'tipo_pagamento_id',
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
			'joinTable' => 'tipo_pagamentos_unidades',
			'foreignKey' => 'tipo_pagamento_id',
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
