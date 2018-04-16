<?php
App::uses('Kit', 'Model');

/**
 * Kit Test Case
 *
 */
class KitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.kit',
		'app.preco',
		'app.pedido',
		'app.kits_pedido',
		'app.produto',
		'app.kits_produto',
		'app.unidade',
		'app.kits_unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Kit = ClassRegistry::init('Kit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Kit);

		parent::tearDown();
	}

}
