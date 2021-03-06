<?php
/**
 * LogEstoqueFixture
 *
 */
class LogEstoqueFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quantidade' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tipo' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'observacoes' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'produto_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'unidade_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_log_estoques_produtos1_idx' => array('column' => 'produto_id', 'unique' => 0),
			'fk_log_estoques_usuarios1_idx' => array('column' => 'usuario_id', 'unique' => 0),
			'fk_log_estoques_unidades1_idx' => array('column' => 'unidade_id', 'unique' => 0)
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
			'quantidade' => 1,
			'tipo' => 1,
			'observacoes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2014-12-19 13:22:24',
			'modified' => '2014-12-19 13:22:24',
			'produto_id' => 1,
			'usuario_id' => 1,
			'unidade_id' => 1
		),
	);

}
