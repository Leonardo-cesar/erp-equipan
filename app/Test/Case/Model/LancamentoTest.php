<?php
App::uses('Lancamento', 'Model');

/**
 * Lancamento Test Case
 *
 */
class LancamentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lancamento',
		'app.tipo_pagamento',
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
		'app.setore',
		'app.setores_usuario',
		'app.unidades_usuario',
		'app.entrega',
		'app.codigo',
		'app.usuarios',
		'app.unidades',
		'app.codigos_kits_pedido',
		'app.unidades_lancamento',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.tipo_pagamentos_unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lancamento = ClassRegistry::init('Lancamento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lancamento);

		parent::tearDown();
	}

}
