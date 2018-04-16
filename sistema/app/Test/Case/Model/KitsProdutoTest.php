<?php
App::uses('KitsProduto', 'Model');

/**
 * KitsProduto Test Case
 *
 */
class KitsProdutoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.kits_produto',
		'app.kit',
		'app.preco',
		'app.pedido',
		'app.kits_pedido',
		'app.produto',
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
		$this->KitsProduto = ClassRegistry::init('KitsProduto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KitsProduto);

		parent::tearDown();
	}

}
