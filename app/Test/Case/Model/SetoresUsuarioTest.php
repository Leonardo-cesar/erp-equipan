<?php
App::uses('SetoresUsuario', 'Model');

/**
 * SetoresUsuario Test Case
 *
 */
class SetoresUsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.setores_usuario',
		'app.setor',
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
		'app.plano_contas_unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SetoresUsuario = ClassRegistry::init('SetoresUsuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SetoresUsuario);

		parent::tearDown();
	}

}
