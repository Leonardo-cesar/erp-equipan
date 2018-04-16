<?php
App::uses('Codigo', 'Model');

/**
 * Codigo Test Case
 *
 */
class CodigoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.codigo',
		'app.usuarios',
		'app.unidades',
		'app.kits_pedido',
		'app.kit',
		'app.preco',
		'app.categoria',
		'app.cliente',
		'app.usuario',
		'app.nivei',
		'app.caixa',
		'app.pedido',
		'app.unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.perda',
		'app.produto',
		'app.estoque',
		'app.log_estoque',
		'app.kits_produto',
		'app.kits_unidade',
		'app.unidades_usuario',
		'app.entrega',
		'app.setore',
		'app.setores_usuario',
		'app.codigos_kits_pedido'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Codigo = ClassRegistry::init('Codigo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Codigo);

		parent::tearDown();
	}

}
