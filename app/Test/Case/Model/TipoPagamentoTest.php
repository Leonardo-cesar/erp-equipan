<?php
App::uses('TipoPagamento', 'Model');

/**
 * TipoPagamento Test Case
 *
 */
class TipoPagamentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipo_pagamento',
		'app.lancamento',
		'app.plano_conta',
		'app.unidade',
		'app.plano_contas_unidade',
		'app.usuario',
		'app.unidade_geradora',
		'app.unidade_pagadora',
		'app.unidade_recebedora',
		'app.tipo_pagamentos_unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TipoPagamento = ClassRegistry::init('TipoPagamento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TipoPagamento);

		parent::tearDown();
	}

}
