<?php
App::uses('LogEstoque', 'Model');

/**
 * LogEstoque Test Case
 *
 */
class LogEstoqueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.log_estoque',
		'app.produto',
		'app.estoque',
		'app.pedido',
		'app.usuario',
		'app.nivei',
		'app.caixa',
		'app.formas_pagamento',
		'app.cliente',
		'app.categoria',
		'app.preco',
		'app.kit',
		'app.kits_pedido',
		'app.kits_produto',
		'app.unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.perda',
		'app.kits_unidade',
		'app.unidades_usuario',
		'app.setore',
		'app.setores_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LogEstoque = ClassRegistry::init('LogEstoque');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LogEstoque);

		parent::tearDown();
	}

}
