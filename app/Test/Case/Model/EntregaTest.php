<?php
App::uses('Entrega', 'Model');

/**
 * Entrega Test Case
 *
 */
class EntregaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.entrega',
		'app.unidade',
		'app.cliente',
		'app.usuario',
		'app.nivei',
		'app.caixa',
		'app.pedido',
		'app.perda',
		'app.produto',
		'app.estoque',
		'app.log_estoque',
		'app.kit',
		'app.preco',
		'app.categoria',
		'app.kits_pedido',
		'app.kits_produto',
		'app.kits_unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.setore',
		'app.setores_usuario',
		'app.unidades_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Entrega = ClassRegistry::init('Entrega');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Entrega);

		parent::tearDown();
	}

}
