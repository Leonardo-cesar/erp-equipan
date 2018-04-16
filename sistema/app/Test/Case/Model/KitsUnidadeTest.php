<?php
App::uses('KitsUnidade', 'Model');

/**
 * KitsUnidade Test Case
 *
 */
class KitsUnidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.kits_unidade',
		'app.kit',
		'app.preco',
		'app.pedido',
		'app.kits_pedido',
		'app.produto',
		'app.kits_produto',
		'app.unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->KitsUnidade = ClassRegistry::init('KitsUnidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KitsUnidade);

		parent::tearDown();
	}

}
