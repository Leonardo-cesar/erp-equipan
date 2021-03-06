<?php
App::uses('Caixa', 'Model');

/**
 * Caixa Test Case
 *
 */
class CaixaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.caixa',
		'app.pedido',
		'app.usuario_desconto',
		'app.usuario',
		'app.nivel',
		'app.unidade',
		'app.cliente',
		'app.categoria',
		'app.preco',
		'app.kit',
		'app.kits_pedido',
		'app.produto',
		'app.estoque',
		'app.perda',
		'app.kits_produto',
		'app.kits_unidade',
		'app.lancamento',
		'app.tipo_pagamento',
		'app.tipo_pagamentos_unidade',
		'app.plano_conta',
		'app.plano_contas_unidade',
		'app.unidade_geradora',
		'app.unidade_pagadora',
		'app.unidade_recebedora',
		'app.setore',
		'app.setores_usuario',
		'app.formas_pagamento'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Caixa = ClassRegistry::init('Caixa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Caixa);

		parent::tearDown();
	}

}
