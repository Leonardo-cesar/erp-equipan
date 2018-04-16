<?php
App::uses('TipoPagamentosUnidade', 'Model');

/**
 * TipoPagamentosUnidade Test Case
 *
 */
class TipoPagamentosUnidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipo_pagamentos_unidade',
		'app.tipo_pagamento',
		'app.lancamento',
		'app.plano_conta',
		'app.unidade',
		'app.plano_contas_unidade',
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
		$this->TipoPagamentosUnidade = ClassRegistry::init('TipoPagamentosUnidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TipoPagamentosUnidade);

		parent::tearDown();
	}

}
