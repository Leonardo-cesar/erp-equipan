<?php
App::uses('UnidadesLancamento', 'Model');

/**
 * UnidadesLancamento Test Case
 *
 */
class UnidadesLancamentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unidades_lancamento',
		'app.unidades_unidades_lancamento'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UnidadesLancamento = ClassRegistry::init('UnidadesLancamento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UnidadesLancamento);

		parent::tearDown();
	}

}
