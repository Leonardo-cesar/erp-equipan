<?php
App::uses('Usuario', 'Model');

/**
 * Usuario Test Case
 *
 */
class UsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario',
		'app.nivel',
		'app.caixa',
		'app.pedido',
		'app.cliente',
		'app.categoria',
		'app.preco',
		'app.kit',
		'app.kits_pedido',
		'app.produto',
		'app.unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.perda',
		'app.kits_unidade',
		'app.estoque',
		'app.kits_produto',
		'app.formas_pagamento',
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
		$this->Usuario = ClassRegistry::init('Usuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usuario);

		parent::tearDown();
	}

}
