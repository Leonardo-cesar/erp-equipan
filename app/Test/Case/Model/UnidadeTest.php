<?php
App::uses('Unidade', 'Model');

/**
 * Unidade Test Case
 *
 */
class UnidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unidade',
		'app.caixa',
		'app.pedido',
		'app.usuario',
		'app.nivei',
		'app.cliente',
		'app.categoria',
		'app.preco',
		'app.kit',
		'app.kits_pedido',
		'app.produto',
		'app.estoque',
		'app.log_estoque',
		'app.perda',
		'app.kits_produto',
		'app.kits_unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.setore',
		'app.setores_usuario',
		'app.unidades_usuario',
		'app.entrega',
		'app.codigo',
		'app.usuarios',
		'app.unidades',
		'app.codigos_kits_pedido',
		'app.unidades_lancamento'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Unidade = ClassRegistry::init('Unidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Unidade);

		parent::tearDown();
	}

}
