<?php
/**
 * CodigosKitsPedidoFixture
 *
 */
class CodigosKitsPedidoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'codigo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'kits_pedido_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_codigos_has_kits_pedidos_kits_pedidos1_idx' => array('column' => 'kits_pedido_id', 'unique' => 0),
			'fk_codigos_has_kits_pedidos_codigos1_idx' => array('column' => 'codigo_id', 'unique' => 0)
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
			'codigo_id' => 1,
			'kits_pedido_id' => 1
		),
	);

}
