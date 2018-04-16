<?php
App::uses('PlanoConta', 'Model');

/**
 * PlanoConta Test Case
 *
 */
class PlanoContaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.plano_conta',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.unidade',
		'app.usuario',
		'app.unidade_geradora',
		'app.unidade_pagadora',
		'app.unidade_recebedora',
		'app.plano_contas_unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PlanoConta = ClassRegistry::init('PlanoConta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PlanoConta);

		parent::tearDown();
	}

}
