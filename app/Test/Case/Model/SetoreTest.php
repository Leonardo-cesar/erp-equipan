<?php
App::uses('Setore', 'Model');

/**
 * Setore Test Case
 *
 */
class SetoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.setore',
		'app.usuario',
		'app.nivel',
		'app.unidade',
		'app.cliente',
		'app.categoria',
		'app.preco',
		'app.kit',
		'app.pedido',
		'app.caixa',
		'app.formas_pagamento',
		'app.estoque',
		'app.produto',
		'app.perda',
		'app.kits_produto',
		'app.kits_pedido',
		'app.kits_unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.setor',
		'app.setores_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Setore = ClassRegistry::init('Setore');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Setore);

		parent::tearDown();
	}

}
