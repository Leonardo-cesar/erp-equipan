<?php
/**
 * UnidadesUnidadesLancamentoFixture
 *
 */
class UnidadesUnidadesLancamentoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'unidades_unidades_lancamento';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'unidade_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'unidades_lancamento_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_unidades_has_unidades_lancamento_unidades_lancamento1_idx' => array('column' => 'unidades_lancamento_id', 'unique' => 0),
			'fk_unidades_has_unidades_lancamento_unidades1_idx' => array('column' => 'unidade_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'unidade_id' => 1,
			'unidades_lancamento_id' => 1
		),
	);

}
