<?php
App::uses('AppModel', 'Model');
/**
 * TipoPagamentosUnidade Model
 *
 * @property TipoPagamento $TipoPagamento
 * @property Unidade $Unidade
 */
class TipoPagamentosUnidade extends AppModel {

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
		'TipoPagamento' => array(
			'className' => 'TipoPagamento',
			'foreignKey' => 'tipo_pagamento_id',
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
