<?php
App::uses('AppModel', 'Model');
/**
 * UnidadesUnidadesLancamento Model
 *
 * @property Unidade $Unidade
 * @property UnidadesLancamento $UnidadesLancamento
 */
class UnidadesUnidadesLancamento extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'unidades_unidades_lancamento';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


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
		'UnidadesLancamento' => array(
			'className' => 'UnidadesLancamento',
			'foreignKey' => 'unidades_lancamento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
