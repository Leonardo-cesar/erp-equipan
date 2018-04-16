<?php
App::uses('Produto', 'Model');

/**
 * Produto Test Case
 *
 */
class ProdutoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.produto',
		'app.estoque',
		'app.unidade',
		'app.cliente',
		'app.usuario',
		'app.nivei',
		'app.caixa',
		'app.pedido',
		'app.perda',
		'app.kit',
		'app.preco',
		'app.categoria',
		'app.kits_pedido',
		'app.kits_produto',
		'app.kits_unidade',
		'app.formas_pagamento',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.setore',
		'app.setores_usuario',
		'app.unidades_usuario',
		'app.log_estoque'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Produto = ClassRegistry::init('Produto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Produto);

		parent::tearDown();
	}

}
