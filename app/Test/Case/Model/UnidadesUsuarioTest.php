<?php
App::uses('UnidadesUsuario', 'Model');

/**
 * UnidadesUsuario Test Case
 *
 */
class UnidadesUsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unidades_usuario',
		'app.unidade',
		'app.cliente',
		'app.usuario',
		'app.nivel',
		'app.caixa',
		'app.pedido',
		'app.estoque',
		'app.produto',
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
		'app.setores_usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UnidadesUsuario = ClassRegistry::init('UnidadesUsuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UnidadesUsuario);

		parent::tearDown();
	}

}
