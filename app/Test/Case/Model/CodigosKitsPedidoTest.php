<?php
App::uses('CodigosKitsPedido', 'Model');

/**
 * CodigosKitsPedido Test Case
 *
 */
class CodigosKitsPedidoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.codigos_kits_pedido',
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
		'app.setores_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CodigosKitsPedido = ClassRegistry::init('CodigosKitsPedido');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CodigosKitsPedido);

		parent::tearDown();
	}

}
