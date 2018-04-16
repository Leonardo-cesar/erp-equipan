<?php
App::uses('Preco', 'Model');

/**
 * Preco Test Case
 *
 */
class PrecoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.preco',
		'app.categoria',
		'app.cliente',
		'app.usuario',
		'app.unidade',
		'app.pedido',
		'app.usuario_desconto',
		'app.caixa',
		'app.formas_pagamento',
		'app.estoque',
		'app.produto',
		'app.perda',
		'app.kit',
		'app.kits_pedido',
		'app.kits_produto',
		'app.kits_unidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Preco = ClassRegistry::init('Preco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Preco);

		parent::tearDown();
	}

}
