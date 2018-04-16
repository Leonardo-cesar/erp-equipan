<?php
App::uses('Pedidosexcluido', 'Model');

/**
 * Pedidosexcluido Test Case
 *
 */
class PedidosexcluidoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pedidosexcluido',
		'app.pedido',
		'app.usuario',
		'app.nivei',
		'app.caixa',
		'app.kits_pedido',
		'app.kit',
		'app.preco',
		'app.categoria',
		'app.cliente',
		'app.unidade',
		'app.codigo',
		'app.usuarios',
		'app.unidades',
		'app.codigos_kits_pedido',
		'app.entrega',
		'app.estoque',
		'app.produto',
		'app.log_estoque',
		'app.perda',
		'app.kits_produto',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.unidades_lancamento',
		'app.unidades_unidades_lancamento',
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
		$this->Pedidosexcluido = ClassRegistry::init('Pedidosexcluido');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pedidosexcluido);

		parent::tearDown();
	}

}
