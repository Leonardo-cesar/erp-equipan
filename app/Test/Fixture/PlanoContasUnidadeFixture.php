<?php
/**
 * PlanoContasUnidadeFixture
 *
 */
class PlanoContasUnidadeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'plano_conta_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'unidade_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_plano_contas_has_unidades_unidades1_idx' => array('column' => 'unidade_id', 'unique' => 0),
			'fk_plano_contas_has_unidades_plano_contas1_idx' => array('column' => 'plano_conta_id', 'unique' => 0)
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
			'plano_conta_id' => 1,
			'unidade_id' => 1
		),
	);

}
