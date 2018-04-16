<?php
App::uses('KitsPedido', 'Model');

/**
 * KitsPedido Test Case
 *
 */
class KitsPedidoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.kits_pedido',
		'app.kit',
		'app.preco',
		'app.categoria',
		'app.cliente',
		'app.usuario',
		'app.nivel',
		'app.unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.unidade_geradora',
		'app.unidade_pagadora',
		'app.unidade_recebedora',
		'app.pedido',
		'app.usuario_desconto',
		'app.caixa',
		'app.formas_pagamento',
		'app.estoque',
		'app.produto',
		'app.perda',
		'app.kits_produto',
		'app.kits_unidade',
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
		$this->KitsPedido = ClassRegistry::init('KitsPedido');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->KitsPedido);

		parent::tearDown();
	}

}
