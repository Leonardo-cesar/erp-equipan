<?php
App::uses('PlanoContasUnidade', 'Model');

/**
 * PlanoContasUnidade Test Case
 *
 */
class PlanoContasUnidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.plano_contas_unidade',
		'app.plano_conta',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.unidade',
		'app.usuario',
		'app.unidade_geradora',
		'app.unidade_pagadora',
		'app.unidade_recebedora'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PlanoContasUnidade = ClassRegistry::init('PlanoContasUnidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PlanoContasUnidade);

		parent::tearDown();
	}

}
